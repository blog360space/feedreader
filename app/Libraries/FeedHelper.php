<?php
/**
 * Created by PhpStorm.
 * User: hungtran
 * Date: 17/08/2019
 * Time: 18:07
 */

namespace App\Libraries;

use App\FeedItem;
use App\FeedCategory;
use Illuminate\Support\Facades\Log;

class FeedHelper
{
    /**
     * Grab feeds then save to DB.
     *
     * @param array $urls
     * @return array $errors
     */
    public static function grabFeeds($urls)
    {
        libxml_use_internal_errors(true);
        $errors = [];
        foreach ($urls as $url) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url
            ]);
            $result = curl_exec($ch);

            $feed = simplexml_load_string($result);
            $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($feed !== false && $info === 200) {
                curl_close($ch);

                foreach ($feed->channel->item as $article) {
                    $categoryId = 1; // Un-category
                    if (isset($article->category)) {
                        $categoryId = FeedCategory::getCategoryIdByName($article->category);
                    }

                    $item = new FeedItem();
                    $item->category_id = $categoryId;
                    $item->title = $article->title;
                    $item->description = $article->description;
                    $item->link = $article->link;
                    $item->comment = $article->comment;
                    $item->pub_date = strtotime($article->pubDate);
                    $item->save();
                }

            } else {
                $errors [$url] = 'Grab feed fail';
            }
        }

        return $errors;
    }
}