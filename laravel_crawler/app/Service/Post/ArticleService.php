<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/9/21 .
 * Time: 2:16 PM .
 */

namespace App\Service\Post;

use App\HelpersClass\CliEcho;
use App\Models\Article;
use App\Models\Menu;
use App\Models\SeoBlog;
use App\Service\Seo\RenderUrlSeoBLogService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArticleService
{
    public static function getListArticles($request, $params = [])
    {
        $articles = Article::with('menu:id,m_name,m_slug')->whereRaw(1);
        if($menuID = Arr::get($params, 'menu'))
            $articles->where('a_menu_id', $menuID);

        if(Arr::get($params, 'hot'))
            $articles->where('a_hot',1);

        if (array_key_exists('paginate', $params)) {
            $articles = $articles->orderByDesc('id')->paginate(Arr::get($params, 'limit'));
        } else {
//            $articles = $articles->get();
            if(array_key_exists('limit', $params))
            {
                $articles = $articles->take(Arr::get($params,'limit'))->get();
            }else{
                $articles = $articles->get();
            }
        }

        return $articles;
    }

    public static function save($data)
    {
        try {
            $that = new self();
            $category = $that->createOrUpdateCategory($data['category']);

            $article = new Article();
            $article->a_name = $data['name'];
            $article->a_slug = Str::slug($data['name']);
            $article->a_description = $data['description'];
            $article->a_content = $data['content'];
            $article->a_menu_id = $category->id ?? 0;
            $article->save();

            RenderUrlSeoBLogService::init($article->a_slug, SeoBlog::TYPE_ARTICLE, $article->id);

            return $article;
        } catch (\Exception $e) {
            Log::info("-------- Error: ". json_encode($e->getMessage()));
            return null;
        }
    }

    public static function createOrUpdateCategory($category)
    {
        $slug = Str::slug($category);
        CliEcho::info('-- -- Slug: ' . $slug);   

        if (!$slug) return null;

        $menu = Menu::updateOrCreate([
            'm_slug' =>  $slug
        ], [
            'm_slug' =>  $slug,
            'm_name' => $category
        ]);

        RenderUrlSeoBLogService::init($slug, SeoBlog::TYPE_MENU, $menu->id);

        return $menu;
    }
}
