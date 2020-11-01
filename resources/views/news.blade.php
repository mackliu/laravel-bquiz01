@extends('home')

@section("center")
<h5 class="text-center py-2 border-bottom">更多最新消息</h5>
<ul class="list-group mt-2" >
    @foreach($news as $key => $new)
    <li class="list-group-item list-group-item-action p-1 new" >
        {{ $key+1 }}. {{ mb_substr($new->text,0,20,'utf8') }}...
        <div style="border:1px solid orange;box-shadow:1px 1px 5px #ccc;background:yellow;width:75%;position:absolute;top:0;right:0;display:none;white-space:pre-wrap;font-size:87%;padding:10px;">{{ $new->text }}</div>    
    </li>
    @endforeach
</ul>
{{ $news->links() }}
@endsection