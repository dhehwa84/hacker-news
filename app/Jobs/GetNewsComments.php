<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use URLHelper;

class GetNewsComments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $kids;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($children)
    {
        $this->kids = $children;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->recursivelyStoreChildren($this->kids);
    }

    
    public function recursivelyStoreChildren($kids)
    {
        foreach ($kids as  $id) {
            $response = (new URLHelper())->fetchItem("/v0/item/" . $id . ".json");
            $comment = json_decode($response->getBody(), true);

            $item = array(  
                'id' => $comment['id'],
                'user' => isset($comment['by']) ? $comment['by'] : '',
                'parent_id' => $comment['parent'],
                'comment' => isset($comment['text']) ? $comment['text'] : '',
                'item_type' => $comment['type']
            );

            $db_item = (new Comment())->getCommentItem($id);

            if(empty($db_item)){

                $newInsert = (new Comment())->insertCommentItem(($item));

            }else{
                
                $updateResult = (new Comment())->updateCommentItem($item);
            }

            if(isset($comment['kids'])){
                $this->recursivelyStoreChildren($comment['kids']);
            }
        }
    }
}
