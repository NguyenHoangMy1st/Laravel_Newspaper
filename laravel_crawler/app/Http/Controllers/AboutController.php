<?php

namespace App\Http\Controllers;

use App\Service\Seo\RenderMetaSeo;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        RenderMetaSeo::init([
            'title'       => "Giới thiệu",
            'description' => "Giới thiệu ",
        ]);

        return view('pages.about');
    }
}
