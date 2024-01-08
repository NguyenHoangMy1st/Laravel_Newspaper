<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Service\Post\ArticleService;
use App\Service\Seo\RenderMetaSeo;

class MenuController extends BaseBlogController
{
    public function getArticleByMenu($menuID, $request)
    {
        $menu     = Menu::find($menuID);
        $articles = ArticleService::getListArticles($request, [
            'menu' => $menu->id,
            'paginate' => 10
        ]);

        $title       = $menu->m_name;
        $description = $menu->m_name;

    
        RenderMetaSeo::init([
            'title'       => $title,
            'description' => $description
        ]);

        $viewData = [
            'title'       => $title,
            'description' => $description,
            'menu'        => $menu,
            'articlesHot' => $this->articlesHot(),
            'articles'    => $articles
        ];
        return view('blog.index', $viewData);
    }
}
