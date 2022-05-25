<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_TITLE') }}</title>
    <link rel="stylesheet" href="{{ url('assets/css/hint.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>
<body>

    <div id="items-container">
        <h1>{{ $news->title }}</h1>
        <ul id="items">
            @foreach($news->comments as $comment)
                <li class="item">
                    <a href="#">
                        <span class="" >{!! $comment->comment !!}</span>
                        <span class="item-info"> by {{ $comment->user }}   
                            @if ($comment->hasComments())
                                 {{ sizeof($comment->children) }} | replies 
                            @endif
                        </span>
                    </a>
                    @if (sizeof($comment->children) > 0)
                        @include('comment', array('innerChild'=>$comment->children))
                    @endif
                  <hr>
                </li>
            @endforeach 
        </ul>
        @if (!$news->hasComments())
            <span> No Comments..</span>
        @endif
    </div>
</body>
</html>