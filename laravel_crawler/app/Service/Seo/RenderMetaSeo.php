<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/4/21 .
 * Time: 12:23 AM .
 */

namespace App\Service\Seo;


use Illuminate\Support\Arr;

class RenderMetaSeo
{
    public static function init($options)
    {
        \SEOMeta::setTitle(Arr::get($options, 'title', 'Chưa cập nhật'));
        \SEOMeta::setDescription(Arr::get($options, 'description', 'Chưa cập nhật'));
        \SEOMeta::setCanonical(\Request::url());
        \SEOMeta::setKeywords(Arr::get($options, 'keyword', ''));
        \OpenGraph::addImage(Arr::get($options, 'avatar', ''), ['height' => 315, 'width' => 600]);
        \OpenGraph::setDescription(Arr::get($options, 'description', 'Chưa cập nhật'));
        \OpenGraph::setTitle(Arr::get($options, 'title', 'Chưa cập nhật'));

        \OpenGraph::addProperty('type', 'articles');

        \SEOMeta::setRobots(Arr::get($options, 'robots', 'NOINDEX, NOFOLLOW'));
    }
}
