<?php

namespace Tests\Feature;

use App\Classes\NewsItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * tests if the comments is an array
     *
     * @return void
     */
    public function testNewsComments()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $newsItem = new NewsItem((object)array(
            "id"=>31500939,
            "title"=>"Jasonette \u2013 Native App over HTTP",
            "description"=>null,
            "username"=>null,
            "item_type"=>"story",
            "url"=>"https=>\/\/jasonette.com\/",
            "time_stamp"=>"2022-05-25 05:32:55",
            "score"=>52,
            "is_top"=>1,
            "is_best"=>null,
            "is_new"=>null,
            "created_at"=>null,
            "updated_at"=>"2022-05-25T10:43:47.000000Z",
            "comments" => [
                    "id"=>31501467,
                    "user"=>"j4mie",
                    "parent_id"=>31500939,
                    "comment"=>"See also <a href=\"https:&#x2F;&#x2F;hyperview.org&#x2F;\" rel=\"nofollow\">https:&#x2F;&#x2F;hyperview.org&#x2F;<\/a>",
                    "item_type"=>"comment",
                    "created_at"=>null,
                    "updated_at"=>null,
                    "children"=> null
            ]
        ));
        $this->assertTrue($newsItem->hasComments());
        $this->assertTrue($newsItem->hasTitle());

        $response->assertSee('Alpha');
        $response->assertDontSee('Beta');

    }
}
