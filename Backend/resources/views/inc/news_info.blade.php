{{-- @dd($posts[0]) --}}
<div class="container">
    <h3 class="fw-bold">{{$posts[0]->title}}</h3>
    <div class="d-flex">
        <div>
            <img src="{{asset('uploads/galleries/'.$posts[0]->thumbnail)}}" alt="" style="width: 300px;">
        </div>
        <div class="ms-2">
            <p class="p-2 rounded" style="background: #d35400">{{$posts[0]->category->name}}</p>
            <p class="view"><i class="fa fa-eye fs-5 me-1"></i>{{$posts[0]->viewer}} Views</p>
            <p class=""><i class="fa fa-user-circle fs-5 me-1"></i>{{$posts[0]->user->name}}</p>
            <p><i class="fa fa-clock fs-5 me-1"></i>{{$posts[0]->created_at}}</p>
        </div>
    </div>
    
    <div class="body_info mt-3">
        <div class="content_title">
            {!!$posts[0]->content!!}
        </div>
        <h5 class="fw-bold">RELATED IMAGE</h5>
        @foreach($posts[0]->galleries as $gallery)
                <div class="content_body text-center">
                    <img src="{{asset('uploads/galleries/'.$gallery->url)}}" alt="" class="w-75 mt-3">
                </div>
        @endforeach
    </div>

    <div class="tags mt-5 ">
        <div class="tags-content d-flex mt-3">
            @foreach ($posts[0]->tags as $tag)
            <div class="me-2 tags-name">
                <p>{{$tag->name}}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style scoped>
    .content_title p{
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        white-space: normal!important; 
    }
    .tags-name{
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        background: #d35400;
        padding: 5px;
        height: 5vh;
    } 
   
    /* .view:hover{
        color: #d35400;
    } */
</style>
