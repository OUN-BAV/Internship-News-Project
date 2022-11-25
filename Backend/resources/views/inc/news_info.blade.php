{{-- @dd($posts[0]) --}}
<div class="container">
    <h3 class="fw-bold">{{$posts[0]->title}}</h3>
    <div class="d-flex">
        <div>
            <img src="{{asset('uploads/galleries/'.$posts[0]->thumbnail)}}" class="img-thumbnail" alt="" style="width: 300px;">
        </div>
        <div class="ms-2">
            <p class="p-2 bg-warning rounded">{{$posts[0]->category->name}}</p>
            <p class=""><i class="fa fa-user-circle fs-4 me-1"></i>{{$posts[0]->user->name}}</p>
            <p><i class="fa fa-clock fs-4 me-1"></i>{{$posts[0]->created_at}}</p>
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
</div>
<style scoped>
    .content_title p{
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        white-space: normal!important; 
    }
</style>