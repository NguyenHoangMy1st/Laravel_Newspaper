<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/3/21 .
 * Time: 2:43 PM .
 */

namespace App\Service\Story;


use App\Models\Chapter;
use App\Models\Crawler\CrawlerChapter;
use App\Models\Crawler\CrawlerStory;
use App\Models\Story;
use Carbon\Carbon;

class PushStoryCrawlerToDbService
{
    public static function init($idStory)
    {
        $storyCrawler = CrawlerStory::find($idStory);
        $story        = Story::create([
            's_name'          => $storyCrawler->s_name,
            's_slug'          => $storyCrawler->s_slug,
            's_avatar'        => $storyCrawler->s_avatar,
            's_link'          => $storyCrawler->s_link,
            's_domain'        => $storyCrawler->s_domain,
            's_description'   => $storyCrawler->s_description,
            's_auth_id'       => $storyCrawler->s_auth_id,
            's_content'       => $storyCrawler->s_content,
            's_total_chapter' => $storyCrawler->s_total_chapter,
            's_category_id'   => $storyCrawler->s_category_id,
            'created_at'      => Carbon::now(),
            's_status'        => Story::STATUS_SUCCESS
        ]);
        if ($story) {
            $chapters                 = CrawlerChapter::where('c_story_id', $idStory)->get();
            $storyCrawler->s_story_id = $story->id;
            $storyCrawler->save();

            foreach ($chapters as $item) {
                Chapter::create([
                    'c_name'     => $item->c_name,
                    'c_slug'     => $item->c_slug,
                    'c_link'     => $item->c_link,
                    'c_position' => $item->c_position,
                    'c_content'  => $item->c_content,
                    'c_story_id' => $story->id,
                    'created_at' => $item->created_at
                ]);
            }
        }
    }
}
