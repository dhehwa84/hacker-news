<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use  App\Classes\NewsItem;

class NewsController extends Controller
{
    private $types;
 
    public function __construct(){
        $this->types = array(
            'top',
            'best',
            'new'
        );
    }
    public function index($type = 'top'){

        $items = News::where('is_' . $type, true)
            ->orderBy('time_stamp', 'DESC')
            ->get()->map(function ($item) {
                return new NewsItem($item);
            });

        $page_data = array(
            'title' => $type,
            'types' => $this->types,
            'items' => $items
        );

        return view('home', $page_data);
    }
    public function show($id){

        $result = News::with('comments.children.allChildren')
            
            ->find($id);
        if($result) {
            $page_data = array(
                'news' => new NewsItem($result)
            );
    
            //return $page_data;
      
            return view('view-news', $page_data);
        }
    }
}
