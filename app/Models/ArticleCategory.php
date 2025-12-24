<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description'
    ];


    public function articles() {
        return $this->hasMany(Article::class);
    }
    
}
