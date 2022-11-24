{{-- @dd($posts[0]->galleries) --}}
<div class="container">
    <div>
        <div>
            <h3>{{$posts[0]->title}}</h3>
        </div>
        <div>
            <img src="{{asset('uploads/galleries/'.$posts[0]->thumbnail)}}" class="img-thumbnail" alt="" style="width: 220px;">
        </div>
    </div>
    
    <div class="body_info mt-5">
        <div class="content_title">
            <p>{{$posts[0]->content}}</p>
        </div>
        @foreach($posts[0]->galleries as $gallery)
                <div class="content_body">
                    <img src="{{asset('uploads/galleries/'.$gallery->url)}}" alt="">
                </div>
        @endforeach
        </div>
</div>