<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminArticleRequest;
use App\Models\Article;
use App\Models\Menu;
use App\Models\SeoBlog;
use App\Service\Seo\RenderUrlSeoBLogService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::whereRaw(1);
        if ($request->n)
            $articles->where('a_name', 'like', '%' . $request->n . '%');

        $articles = $articles->orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'articles' => $articles,
            'query'    => $request->all()
        ];
        return view('admin.article.index', $viewData);
    }

    public function create()
    {
        $menus    = Menu::all();
        $viewData = [
            'menus'   => $menus,
        ];

        return view('admin.article.create', $viewData);
    }

    public function store(AdminArticleRequest $request)
    {
        $data               = $request->except(['avatar', 'save', '_token']);
        $data['created_at'] = Carbon::now();
        $data['a_slug']     = Str::slug($request->a_name);
        if (!$request->a_title_seo) $data['a_title_seo'] = $request->a_name;
        if (!$request->a_description_seo) $data['a_description_seo'] = $request->a_name;
        

        $articleID = Article::insertGetId($data);

        if ($articleID) {
            $this->syncTags($request->tags, $articleID);
            RenderUrlSeoBLogService::init($request->a_slug, SeoBlog::TYPE_ARTICLE, $articleID);
            return redirect()->route('get_admin.article.index');
        }
        return redirect()->back();
    }

    protected function syncTags($tags, $articleID)
    {
        if (!empty($tags)) {
            \DB::table('articles_tags')->where('at_article_id', $articleID)->delete();
            foreach ($tags ?? [] as $item) {
                ArticleTag::insert([
                    'at_article_id' => $articleID,
                    'at_tag_id'     => $item
                ]);
            }
        }
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $menus   = Menu::all();


        $tagsOld = ArticleTag::where('at_article_id', $id)
            ->pluck('at_tag_id')->toArray() ?? [];

        $viewData = [
            'article' => $article,
            'menus'   => $menus,
        ];
        return view('admin.article.update', $viewData);
    }

   

    public function delete(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        if ($article) {
            $article->delete();
            RenderUrlSeoBLogService::deleteUrlSeo(SeoBlog::TYPE_ARTICLE, $id);
        }
        return redirect()->back();
    }
}
