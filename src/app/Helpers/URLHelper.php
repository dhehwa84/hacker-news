<?php
use GuzzleHttp\Client;
class URLHelper {

    public static function getURL($id, $url = ''){
        if(!empty($url)){
            return $url;
        }
        return "https://news.ycombinator.com/item?id={$id}";
    }

    public function fetchItem($endpoint)
    {
        $client = new Client(array(
            'base_uri' => 'https://hacker-news.firebaseio.com'
        ));
        return $client->get($endpoint);
    }


}