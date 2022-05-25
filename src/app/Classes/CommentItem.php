<?php
namespace App\Classes;
class CommentItem {

    public $id;
    public $user;
    public $parent_id;
    public $comment;
    public $item_type;
    public $created_at;
    public $updated_at;
    public $children;

    public function __construct($comment)
    {
        $this->id = $comment->id;
        $this->parent_id = $comment->parent_id;
        $this->comment = $comment->comment;
        $this->user = $comment->user;
        $this->item_type = $comment->item_type;
        $this->created_at = $comment->created_at;
        $this->updated_at = $comment->updated_at;
        $this->children = $comment->children;
    }
    
    public function hasComments()
    {
       return sizeof($this->children) > 0;
    }


}