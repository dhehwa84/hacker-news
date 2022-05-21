<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;

use DB;

use GuzzleHttp\Client;

class UpdateNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

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
        $client = new Client(array(
            'base_uri' => 'https://hacker-news.firebaseio.com'
        ));

        $endpoints = array(
            'top' => '/v0/topstories.json',
            'best' => '/v0/beststories.json',
            'new' => '/v0/newstories.json',
        );

        foreach($endpoints as $type => $endpoint){

            $response = $client->get($endpoint);
            $result = $response->getBody();

            $items = json_decode($result, true);
                    
            foreach($items as $id){
                $item_res = $client->get("/v0/item/" . $id . ".json");
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
                    
                    $db_item = News::where('id', '=', $id)
                            ->first();

                    if(empty($db_item)){

                        News::insert($item);

                    }else{
                        
                        News::where('id', $id)
                            ->update($item);
                    }
                }
            }
        }
        $this->info('Done fetching');
        return 'ok';
    }

}
