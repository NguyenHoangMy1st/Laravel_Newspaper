<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/4/21 .
 * Time: 1:09 PM .
 */

namespace App\Traits\Crawler;


use App\Models\Crawler\CrawlerChapter;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait ProcessItemDataChapter
{
    public function createItemChapter($story, $storyCrawler)
    {
        foreach ($story['chappers'] as $key => $item) {
            CrawlerChapter::create([
                'c_name'     => $item['name'],
                'c_link'     => $item['link'],
                'c_position' => $key + 1,
                'c_slug'     => Str::slug($item['name']),
                'c_story_id' => $storyCrawler->id,
                'c_content'  => $item['content'],
                'created_at' => Carbon::now()
            ]);
        }
    }
}
