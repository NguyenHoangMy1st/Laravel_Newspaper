<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Service\Post\ArticleService;
use App\Service\Seo\RenderMetaSeo;
use Illuminate\Http\Request;

class BlogController extends BaseBlogController
{
    public function index(Request $request)
    {
        $articles = ArticleService::getListArticles($request, [
            'paginate' => true,
            'limit'    => 10
        ]);

        $title       = "Bài viết";
        $description = "Bài viết";
        RenderMetaSeo::init([
            'title'       => $title,
            'description' => $description
        ]);

        $menusGlobal = Menu::all();
        $viewData = [
            'articles'    => $articles,
            'title'       => $title,
            'description' => $description,
            'menusGlobal' => $menusGlobal,
            'articlesHot' => $this->articlesHot(),
        ];

        return view('blog.index', $viewData);
    }
}
