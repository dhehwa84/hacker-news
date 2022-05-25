<?php
namespace App\Classes;
class NewsItem {

    public $id;
    public $title;
    public $description;
    public $username;
    public $item_type;
    public $url;
    public $time_stamp;
    public $score;
    public $is_top;
    public $is_best;
    public $is_new;
    public $created_at;
    public $updated_at;
    public $comments = [];

    public function __construct($news)
    {
        $this->id = $news->id;
        $this->title = $news->title;
        $this->description = $news->description;
        $this->item_type = $news->item_type;
        $this->time_stamp = $news->time_stamp;
        $this->score = $news->score;
        $this->is_top = $news->is_top;
        $this->is_best = $news->is_best;
        $this->is_new = $news->is_new;
        $this->created_at = $news->created_at;
        $this->updated_at = $news->updated_at;
        $this->comments = $news->comments !== null? 
                            $news->comments->map(function ($item) {
                            return new CommentItem($item);
                        }) : [];
    }

    public function hasComments()
    {
       return sizeof($this->comments) > 0;
    }

    public function hasTitle()
    {
       return $this->title !== '';
    }

}