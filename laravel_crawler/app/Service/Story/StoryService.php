<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/3/21 .
 * Time: 2:31 AM .
 */

namespace App\Service\Story;

use App\Models\Story;
use Illuminate\Support\Arr;

class StoryService
{
    public function getList($request, $params = [])
    {
        $results = Story::with('category:id,c_name,c_slug','author:id,a_name')->where('s_status', Story::STATUS_SUCCESS);

        if (array_key_exists('category', $params))
            $results->where('s_category_id', Arr::get($params, 'category'));
        if(array_key_exists('name', $params))
            $results->where('s_name','like','%'.Arr::get($params,'name').'%');

//        if (array_key_exists('user_id', $params))
//            $results->where('s_user_id', Arr::get($params, 'user_id'));
//
//        if (array_key_exists('language', $params))
//            $results->where('s_language_id', Arr::get($params, 'language'));
//
//        if (array_key_exists('s_type_code', $params))
//            $results->where('s_type_code', Arr::get($params, 's_type_code'));


        $results = $results->orderByDesc('id');
        if (array_key_exists('paginate', $params)) {
            $results = $results->simplePaginate(Arr::get($params, 'limit'));
        } else {
            $results = $results->get();
        }

        return $results;
    }

    public function getRelateStory($category)
    {
        return Story::with('category:id,c_name,c_slug')
            ->where('s_status', Story::STATUS_SUCCESS)
            ->where('s_category_id', $category)
            ->orderByDesc('id')
            ->limit(5)
            ->select('id', 's_name', 's_slug', 's_avatar', 's_auth_id', 's_total_chapter')
            ->get();
    }
}
