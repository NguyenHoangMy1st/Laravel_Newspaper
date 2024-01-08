<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/2/21 .
 * Time: 7:42 PM .
 */

namespace App\Traits;


use App\Models\Author;
use App\Models\Crawler\CrawlerCategory;
use App\Models\Crawler\CrawlerStory;
use Illuminate\Support\Str;

trait SpatieHelpersTrait
{
    /**
     * @return mixed
     * lất từng danh mục
     */
    protected function getFirstLinkCategory()
    {
        return CrawlerCategory::where('c_status', CrawlerCategory::STATUS_PROCESS)->first();
    }

    /**
     * @param $story
     * @return CrawlerStory
     * Lưu tạm dữ liệu khi crawler ở danh mục
     */
    protected function saveStory($story)
    {
        $storyCrawler = $this->checkExistsStory($story['title']);
        if ($storyCrawler) return $storyCrawler;

        $storyCrawler                = new CrawlerStory();
        $storyCrawler->s_name        = $story['title'];
        $storyCrawler->s_slug        = Str::slug($story['title']);
        $storyCrawler->s_avatar      = $story['avatar']['img'];
        $storyCrawler->s_link        = $story['link_detail'];
        $storyCrawler->s_domain      = $story['domain'];
        $storyCrawler->s_description = $story['desc'];
//        $storyCrawler->s_content     = $story['description'];
        $storyCrawler->s_status = CrawlerStory::STATUS_RUNNING;
        $storyCrawler->save();
        return $storyCrawler;
    }

    public function createOrUpdateAuthor($data)
    {
        $author = [];
        $slug   = $data['name'] ?? null;
        if ($slug) {
            $author = Author::where('a_slug', $slug)->first();
            if ($author) return $author;

            $author = Author::create([
                'a_name'   => $data['name'],
                'a_slug'   => $slug,
                'a_link'   => $data['link'] ?? null,
                'a_domain' => render_domain($data['link'] ?? null)
            ]);
        }
        return $author;
    }

    protected function checkExistsStory($name)
    {
        $story = CrawlerStory::where('s_slug', Str::slug($name))->first();
        if ($story) return $story;
        return false;
    }


    public function grab_image($url, $saveto)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $raw = curl_exec($ch);
        curl_close($ch);

        // thu muc goc de upload
        $path     = public_path() . '/uploads/' . date('Y/m/d/');
        $fileSave = $saveto;
        $this->warn("-- -- -- -- Avatar: " . $fileSave);

        if (!\File::exists($path))
            mkdir($path, 0777, true);

        $fp = fopen($path . $fileSave, 'w');
        fwrite($fp, $raw);
        fclose($fp);
    }
}
