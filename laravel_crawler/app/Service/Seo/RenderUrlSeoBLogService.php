<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/8/21 .
 * Time: 3:57 PM .
 */

namespace App\Service\Seo;


use App\Models\SeoBlog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RenderUrlSeoBLogService
{
    const PREFIX_TAG = '-t';
    const PREFIX_MENU    = '-m';
    const PREFIX_ARTICLE = '-a';

    const TYPE_TAG = 1;
    const TYPE_MENU    = 2;
    const TYPE_ARTICLE = 3;

    public static function init($slug, $type, $id)
    {
        try {
            $that = new self();
            switch ($type) {
                case self::TYPE_TAG:
                    $prefix = self::PREFIX_TAG;
                    break;

                case self::TYPE_MENU:
                    $prefix = self::PREFIX_MENU;
                    break;

                case self::TYPE_ARTICLE:
                    $prefix = self::PREFIX_ARTICLE;
                    break;
            }
            $slug = Str::slug($slug . $prefix);

            $slugMd5 = md5($slug);
            $check   = $that->checkUrl($slugMd5);
            if ($check) {
                SeoBlog::insert([
                    'sb_md5'     => $slugMd5,
                    'sb_slug'    => $slug,
                    'sb_type'    => $type,
                    'sb_id'      => $id,
                    'created_at' => Carbon::now()
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("[RenderUrlSeoBLogService init :]" . $exception->getMessage());
        }
    }

    public static function deleteUrlSeo($type, $id)
    {
        try {
            SeoBlog::where([
                'sb_id'   => $id,
                'sb_type' => $type
            ])->delete();
        } catch (\Exception $exception) {
            Log::error("[deleteUrlSeoBlog init :]" . $exception->getMessage());
        }
    }

    protected function checkUrl($md5Slug)
    {
        $seo = SeoBlog::where([
            'sb_md5' => $md5Slug,
        ])->first();

        if ($seo) return false;
        return true;
    }
}
