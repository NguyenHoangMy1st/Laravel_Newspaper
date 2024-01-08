<?php

namespace App\Console\Commands\Crawler;

use App\HelpersClass\CliEcho;
use App\Service\Post\ArticleService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CrawlerBlogInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler blog';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $that        = new self();
        $arrayDomain = [
            'vnexpress.net',
            '123job.vn'
        ];

        foreach ($arrayDomain as $item) {
            CliEcho::warningnl('-- Domain: ' . $item);
            if ($item === 'vnexpress.net') {
                $this->switchDomainVnExpress($that);
            }

            if ($item === '123job.vn') {
                $url  = 'https://123job.vn/bai-viet/news';
                $html = file_get_html($url);
                $data = [];

                foreach ($html->find("#content > div:nth-child(1) > div > div.box-content__left > div > div.list-post .post-list") as $itemArticle) {
                    $heading     = $itemArticle->find("h3 a", 0);
                    $description = $itemArticle->find(".post-list__desc", 0);
                    $image       = $itemArticle->find("picture img", 0);
                    $category  = $itemArticle->find(".post-list__category a",0);
                    $data[]      = [
                        'link_detail' => $heading->href ?? null,
                        'name'        => $heading->plaintext ?? null,
                        "description" => $description->plaintext ?? null,
                        "image"       => $image->src ?? "",
                        'category' => $category->plaintext ?? null
                    ];
                }

                foreach ($data as $key => $itemChild) {
                    if (isset($itemChild['link_detail'])) {
                        $urlDetail = $itemChild['link_detail'];
                        CliEcho::info('-- URL: ' . $urlDetail);
                        $html                  = file_get_html($urlDetail);
                        $content               = $html->find("#blog-detail", 0);
                        $data[$key]['content'] = $content->innertext ?? null;

                        // check nếu có thì dừng tiến trình
                        CliEcho::warning('-- Check: ' . $itemChild['name']);
                        $check = $that->checkPost($itemChild['name']);
                        if (!$check) {
                            $article = $that->addPost($data[$key]);
                            if ($article) {
                                CliEcho::info('-- -- Create: ' . $article->a_name);
                            } else {
                                CliEcho::error('-- -- Create error: ' . $itemChild['name']);
                            }
                        } else {
                            CliEcho::error('-- Hoàn thành tiến trình: ');
                            return;
                        }

                    }
                }
            }
        }
        CliEcho::warningnl(' ------------- DONE ------------: ');
    }

    protected function addPost($data)
    {
        return ArticleService::save($data);
    }

    protected function checkPost($name)
    {
        $slug = Str::slug($name);
        return DB::table('articles')->where('a_slug', $slug)->first();
    }

    protected function switchDomainVnExpress($that)
    {
        $url = "https://vnexpress.net/tin-tuc-24h";
        CliEcho::warningnl('-- URL: ' . $url);

        $html = file_get_html($url);
        $data = [];

        foreach ($html->find("#automation_TV0 > div > article") as $item) {
            $heading     = $item->find("h3 a", 0);
            $description = $item->find("p.description a", 0);
            $image       = $item->find("picture img", 0);
            $data[]      = [
                'link_detail' => $heading->href ?? null,
                'name'        => $heading->plaintext ?? null,
                "description" => $description->plaintext ?? null,
                "image"       => $image->src ?? ""
            ];
        }

        foreach ($data as $key => $item) {
            if (isset($item['link_detail'])) {
                $urlDetail = $item['link_detail'];
                CliEcho::info('-- URL: ' . $urlDetail);
                $html                   = file_get_html($urlDetail);
                $content                = $html->find(".fck_detail", 0);
                $category               = $html->find(".page-detail.top-detail > div > div.sidebar-1 > div.header-content.width_common > ul > li > a", 0);
                $data[$key]['category'] = $category->plaintext ?? null;
                $data[$key]['content']  = $content->innertext ?? null;

                $img                  = $html->find("meta[property='og:image']", 0);
                // $data[$key]['avatar'] = $img->content ?? null;

                // check nếu có thì dừng tiến trình
                CliEcho::warning('-- Check: ' . $item['name']);
                $check = $that->checkPost($item['name']);
                if (!$check) {
                    $article = $that->addPost($data[$key]);
                    CliEcho::info('-- -- Create: ' . $article->a_name);
                } else {
                    CliEcho::error('-- Hoàn thành tiến trình: ');
                    return;
                }

            }
        }

        CliEcho::info('---------- DONE ------------ ' . $urlDetail);
    }
}
