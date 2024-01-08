<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Story;
use App\Service\Seo\RenderMetaSeo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('get.blog');
    }
    public function search(Request $request)
    {
        $articles = Article::whereRaw(1);
        
        if($request->k)
            $articles->where('a_name','like','%'.$request->k.'%');

        $articles = $articles->orderByDesc('id')->paginate(20);
        

        $viewData = [
            'articles'    => $articles
        ];
        return view('blog.index', $viewData);
    }
}
