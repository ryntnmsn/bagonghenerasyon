<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'article_type_id',
        'article_category_id',
        'user_id',
        'image',
        'status'
    ];

    protected function casts()
    {
        return [
            'short_description' => PurifyHtmlOnGet::class,
            'description' => PurifyHtmlOnGet::class,
        ];
    }


    public function category() {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type() {
        return $this->belongsTo(ArticleType::class, 'article_type_id');
    }
}
