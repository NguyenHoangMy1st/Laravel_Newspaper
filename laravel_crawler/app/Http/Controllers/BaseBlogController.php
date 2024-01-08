<?php

namespace App\Http\Controllers;

use App\Service\Post\ArticleService;
use Illuminate\Http\Request;

class BaseBlogController extends Controller
{
    public function articlesHot()
    {
        return $articles = ArticleService::getListArticles((new Request()), [
            'hot'   => 1,
            'limit' => 5
        ]);
    }

}
