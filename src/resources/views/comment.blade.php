
        <ul style="margin-left: 20px;" id="item">
            @foreach($innerChild as $child)
                <li class="item">
                    <a href="#">
                        <span class="" >{!! $child->comment !!}</span>
                        <span class="item-info"> by {{ $child->user }}</span>
                    </a>
                    @if ($child->all_children !== null)
                        @if (sizeof($child->all_children) > 0)
                            @include('comment', array('innerChild'=>$child->all_children))
                        @endif
                    @endif
                </li>
            @endforeach 
        </ul>