<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/4/21 .
 * Time: 1:01 PM .
 */

namespace App\Traits\Crawler;


use App\HelpersClass\CliEcho;

trait ProcessItemStoryTrait
{
    /**
     * @param $data
     * @return mixed
     * Chi tiết chạp
     */
    protected function getContentChapter($data)
    {
        if (!empty($data['chappers'])) {
            foreach ($data['chappers'] as $key => $item) {
                $link = $item['link'];
                CliEcho::infonl("-- -- -- Chapter Content " . $link);
                $html    = file_get_html($link);
                $content = $html->find(".story-detail-content", 0)->outertext ?? null;

                $contentProcess                    = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
                $contentProcess                    = preg_replace('#<center(.*?)>(.*?)</center>#is', '', $contentProcess);
                $data['chappers'][$key]['content'] = $contentProcess;
            }
        }
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     * Lấy thông tin chi tiết truyện và chapter
     */
    protected function getDetail($data)
    {
        $link = $data['link_detail'];
        CliEcho::successnl("-- -- Detail " . $link);
        $html                = file_get_html($link);
        $desc                = $html->find("#tab-over", 0)->outertext ?? null;
        $data['description'] = preg_replace('/<img[^>]+\>/i', '', $desc);
        $data['description'] = preg_replace('#<a(.*?)>(.*?)</a>#is', '', $data['description']);
        $chappers            = [];
        foreach ($html->find("#tab-chapper ul li a") as $item) {
            $chappers[] = [
                'name' => $item->plaintext ?? null,
                'link' => 'https://thichtruyen.vn' . ($item->href ?? null)
            ];
            CliEcho::successnl("-- -- -- Chapter: " . ($item->href ?? null));
        }
        $data['chappers']      = $chappers;
        $data['total_chapter'] = count($chappers);
        return $data;
    }
}
