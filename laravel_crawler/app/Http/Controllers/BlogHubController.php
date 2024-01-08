<?php

namespace App\Http\Controllers;

use App\Models\SeoBlog;
use Illuminate\Http\Request;

class BlogHubController extends Controller
{
    public function render(Request $request, $slug)
    {
        $slugMd5 = md5($slug);
        $urlSeo = SeoBlog::where('sb_md5', $slugMd5)->first();

        if($urlSeo) {
            $type = $urlSeo->sb_type;
            $id = $urlSeo->sb_id;
        
            switch ($type)
            {
                case SeoBlog::TYPE_TAG:
                    return (new TagController())->getArticleByTag($id, $request);

                case SeoBlog::TYPE_MENU:
                    return (new MenuController())->getArticleByMenu($id, $request);

                case SeoBlog::TYPE_ARTICLE:
                    return (new ArticleController())->getArticleById($id, $request);

            }
        }

        return  redirect()->route('get.blog');
    }
}
