<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FeedCategory extends Model
{
    public function feedItems() {
        return $this->hasMany('App\FeedItem', 'category_id');
    }

    /**
     * Get category by data, insert if not exits
     *
     * @param array $data
     */
    public static function getCategoryIdByName($name)
    {
        $cat = self::where('name', $name)->first(['id', 'name']);
        if (isset($cat->id)) {
            return $cat->id;
        }

        return DB::table('feed_categories')->insertGetId([
            'name' => $name,
            'created_at' => Carbon::now()
        ]);
    }
}
