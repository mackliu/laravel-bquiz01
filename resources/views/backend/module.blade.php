@extends("layouts.layout")

@section("main")
@include("layouts.backend_sidebar",['total'=>$total])
<div class="main col-9 p-0 d-flex flex-wrap align-items-start">
    <div class="col-8 border py-3 text-center">後台管理區</div>
    <a href='/logout' class="col-4 btn btn-light border py-3 text-center">管理登出</a>
    <div class="border w-100 p-1" style="height:500px;overflow:auto">
    <h5 class="text-center border-bottom py-3">
    @if($module !='Total' && $module != 'Bottom')
    <button class="btn btn-sm btn-primary float-left" id="addRow">新增</button>
    @endif

    @isset($menu_id)
        <input type="hidden" name="menu_id" value="{{$menu_id}}">
    @endisset
    {{ $header }}
    </h5>
    <table class="table border-none text-center">
    <tr>
    @isset($cols)
      @if($module != 'Total' && $module !='Bottom')  
        @foreach($cols as $col)
            <td width="{{$col}}">{{ $col }}</td>
        @endforeach
      @endif  
    @endisset
    </tr>
    @isset($rows)
        @if($module != 'Total'  && $module != 'Bottom')
            @foreach($rows as $row)
            <tr>
                @foreach($row as $item)
                   <td>
                        @switch($item['tag'])
                            @case('img')
                                @include('layouts.img',$item)
                            @break
                            @case('button')
                                @include('layouts.button',$item)
                            @break
                            @case('embed')
                                @include('layouts.embed',$item)
                            @break
                            @case('textarea')
                                @include('layouts.textarea',$item)
                            @break
                            @default
                                {!! nl2br($item['text'])  !!}
                        @endswitch 
                   </td> 
                @endforeach
            </tr>
            @endforeach
        @else
            <tr>
                <td>{{ $cols[0] }}</td>
                <td>{{ $rows[0]['text'] }}</td>
                <td>@include("layouts.button",$rows[1])</td>
            </tr>
        @endif
    @endisset
    </table>
    
    @switch($module)
        @case('Image')
        @case('News')
            {!! $paginate !!}
        @break

    @endswitch
    </div>
</div>

@endsection

@section("script")
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#addRow").on("click",function(){

    @isset($menu_id)
        $.get("/modals/add{{ $module }}/{{$menu_id}}",function(modal){
            $("#modal").html(modal)
            $("#baseModal").modal("show")

            $("#baseModal").on("hidden.bs.modal",function(){
                $("#baseModal").modal("dispose")
                $("#modal").html("")
            })
        })
    @else
        $.get("/modals/add{{ $module }}",function(modal){
            $("#modal").html(modal)
            $("#baseModal").modal("show")

            $("#baseModal").on("hidden.bs.modal",function(){
                $("#baseModal").modal("dispose")
                $("#modal").html("")
            })
        })
    @endif
    
})


$(".edit").on("click",function(){
    let id=$(this).data('id')
    $.get(`/modals/{{ strtolower($module) }}/${id}`,function(modal){
        $("#modal").html(modal)
        $("#baseModal").modal("show")

        $("#baseModal").on("hidden.bs.modal",function(){
            $("#baseModal").modal("dispose")
            $("#modal").html("")
        })
    })
})

$(".delete").on("click",function(){
    let id=$(this).data('id')
    let _this=$(this)
    $.ajax({
        type:'delete',
        url:`/admin/{{ strtolower($module) }}/${id}`,
        success:function(){
            _this.parents('tr').remove()
        }
    })
})

$(".show").on("click",function(){
    let id=$(this).data('id')
    let _this=$(this)
    $.ajax({
        type:'patch',
        url:`/admin/{{ strtolower($module) }}/sh/${id}`,

        @if($module=='Title')
        success:function(img){

            if(_this.text()=="顯示"){
                $(".show").each((idx,dom)=>{
                    if($(dom).text()=='隱藏'){
                        $(dom).text("顯示")
                        return false;
                    }
                })
                _this.text('隱藏')
            }else{
                $(".show").text("隱藏")
                _this.text('顯示')
            }

            $(".header img").attr("src","http://quiz01.com/storage/"+img)
        }
        @else
        success:function(){
            if(_this.text()=="顯示"){
                _this.text('隱藏')
            }else{
                _this.text('顯示')
            }
        }
        @endif
    })
})


$(".sub").on("click",function(){
    let id=$(this).data("id")
    location.href=`/admin/submenu/${id}`

})
</script>
@endsection