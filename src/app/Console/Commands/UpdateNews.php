<?php

namespace App\Console\Commands;

use App\Jobs\GetNewsComments;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Console\Command;

use GuzzleHttp\Client;
use URLHelper;

class UpdateNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs on a daily basis to to update the news';

    protected $name = 'update:news_items';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $endpoints = array(
            'top' => '/v0/topstories.json'
        );

        foreach($endpoints as $type => $endpoint){

            $response = (new URLHelper())->fetchItem($endpoint);
            $result = $response->getBody();

            $items = json_decode($result, true);
                    
            foreach($items as $id){
                $item_res = (new URLHelper())->fetchItem("/v0/item/" . $id . ".json");
                $item_data = json_decode($item_res->getBody(), true);

                if(!empty($item_data)){
        
                    $item = array(  
                        'id' => $id,
                        'title' => $item_data['title'],
                        'item_type' => $item_data['type'],
                        'username' => $item_data['by'],
                        'score' => $item_data['score'],
                        'time_stamp' => date('Y-m-d H:i:s', $item_data['time']),
                    );

                    $item['is_' . $type] = true;

                    if(!empty($item_data['text'])){
                        $item['description'] = strip_tags($item_data['text']);
                    }

                    if(!empty($item_data['url'])){
                        $item['url'] = $item_data['url'];
                    }
                    
                    $db_item = (new News())->getNewsItem($id);

                    if(empty($db_item)){

                        $newInsert = (new News())->insertNewsItem(($item));

                    }else{
                        
                        $updateResult = (new News())->updateNewsItem($item);
                    }

                    // store children
                    if(isset($item_data['kids'])) {
                        dispatch(new GetNewsComments($item_data['kids']));
                    }
                }
            }
        }
        $this->info('Done fetching');
        return 'ok';
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
