<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

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
            ->get();

        $page_data = array(
            'title' => $type,
            'types' => $this->types,
            'items' => $items
        );

        return view('home', $page_data);
    }
}
