<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use App\Service\ProcessViewService;
use App\Service\Seo\RenderMetaSeo;
use Illuminate\Http\Request;

class ArticleController extends BaseBlogController
{
    public function getArticleById($id, Request $request)
    {
        $article = Article::with('menu:id,m_name,m_slug')->find($id);
        if (!$article) return abort(404);

        ProcessViewService::view('articles', 'a_view', 'ARTICLE', $id);

        $title       = $article->a_name;
        $description = $article->a_description;

        RenderMetaSeo::init([
            'title'       => $title,
            'description' => $description
            ]);

        $menusGlobal = Menu::all();

        $viewData = [
            'article'     => $article,
            'articlesHot' => $this->articlesHot(),
            'menusGlobal' => $menusGlobal,
        ];

        return view('blog_detail.index', $viewData);
    }
}
