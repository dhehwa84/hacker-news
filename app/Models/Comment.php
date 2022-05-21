<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function children() {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function allChildren(){
        return $this->children()->with('allChildren');
    }

    public function getCommentItem($id)
    {
        return Comment::where('id', '=', $id)
                            ->first();
    }

    public function insertCommentItem($item)
    {
        return Comment::insert($item);
    }

    public function updateCommentItem($item)
    {
        Comment::where('id', $item['id'])
                            ->update($item);
    }
}
