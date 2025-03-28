<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color', // For category badge color
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }
}
