<div class="w-100">
    @if(Request::path() != '/')
        <h1 class="mb-4">{{request()->route()->parameters['category']}}</h1>
    @else
        <h1 class="mb-4">Daily News</h1>
    @endif
    @if(count($posts))
        @foreach ($posts as $post)
            <div  class="row mt-1 shadow-sm p-1 rounded card_zoom">
                <div class="text-center col-3 ">
                    <img src="{{asset('uploads/galleries/'.$post->thumbnail)}}" class="img-thumbnail" alt="" style="width: 100%;">
                </div>
                <div class="col-9 p-2 title">
                    <a id="show" href="{{URL("/article/$post->id")}}" onclick="show({{$post->id}})"><p class="text-dark m-0 p-0 fw-bold">{{$post->title}}</p></a>
                    <div class="content">
                        {!!$post->content!!}
                    </div>
                    <p class="text-secondary " style="font-size: 0.7rem;">{{$post->created_at}}</p>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-secondary">Don't have news right now</p>
    @endif
</div>

<style scoped>
    .card_zoom{
        transition: transform .3s;
    }
    .card_zoom:hover{
        -ms-transform: scale(1.02); /* IE 9 */
        -webkit-transform: scale(1.02); /* Safari 3-8 */
        transform: scale(1.02); 
        background: rgb(251, 248, 248);
    }
    .category{
        clip-path: polygon(0 0, 90% 0, 100% 100%, 0% 100%);
        width: 170px;
        height: 40px;
        display: flex;
        padding: 2px;
        align-items: center;
    }
    .content p{
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        white-space: normal!important;
    }
    .title a{
        text-decoration: none;
    }
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script>
    // viewer increment
    function show(param){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:'/post-view/'+param.toString(),
            type:   "PUT",
            processData: false,
            contentType: false,
            cache: false,
        })
        console.log($.ajax());
    }
</script>

