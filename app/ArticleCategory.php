<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = [
        'article_id', 'category_id'
    ];

}
