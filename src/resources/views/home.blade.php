<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_TITLE') }}</title>
    <link rel="stylesheet" href="{{ url('assets/css/hint.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>
<body>
    <div id="sidebar">
        <h3>{{ env('APP_TITLE') }}</h3>
        <ul id="types">
            @foreach($types as $type)
            <li>
                <a href="/{{ $type }}">{{ ucwords($type) }}</a>
            </li>
            @endforeach
        </ul>
    </div>

    <div id="items-container">
        <h1>{{ $title }}</h1>
        <ul id="items">
            @foreach($items as $item)
            <li class="item">
                <span class="item-score">{{ $item->score }}</span>
                <a  href="/get-news/{{ $item->id }}">
                    <span class="item-title hint--bottom" data-hint="{{ str_limit(strip_tags($item->description), 160) }}">{{ $item->hasTitle()? $item->title : '--'}}</span>
                    <span class="item-info">posted {{ \Carbon\Carbon::parse($item->time_stamp)->diffForHumans() }} by {{ $item->username }}</span>
                </a>
            </li>
            @endforeach 
        </ul>
    </div>
</body>
</html>