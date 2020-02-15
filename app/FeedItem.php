<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedItem extends Model
{
    protected $fillable = [
        'title',
        'link',
        'description',
        'pub_date',
        'category_id',
        'comment'
    ];

    public function feedCategory() {
        return $this->belongsTo('App\FeedCategory', 'category_id');
    }

    /**
     * Search feed item
     * @param array $params
     */
    public static function search($params = []) {
        $query = self::orderBy('created_at','desc');

        if (isset($params['category_id']) && $params['category_id']) {
            $query->where('category_id', $params['category_id']);
        }

        return $query->paginate(10);
    }
}
