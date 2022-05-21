<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function getNewsItem($id)
    {
        return News::where('id', '=', $id)
                            ->first();
    }

    public function insertNewsItem($item)
    {
        return News::insert($item);
    }

    public function updateNewsItem($item)
    {
        News::where('id', $item['id'])
                            ->update($item);
    }
}
