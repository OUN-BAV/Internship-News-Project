<div class="container">
    <div>
        <div>
            <h3>{{$posts[0]->title}}</h3>
        </div>
        <div>
            <img src="{{asset('uploads/galleries/'.$posts[0]->thumbnail)}}" class="img-thumbnail" alt="" style="width: 300px;">
        </div>
    </div>
    
    <div class="body_info mt-5">
        <div class="content_title">
            {!!$posts[0]->content!!}
        </div>
        @foreach($posts[0]->galleries as $gallery)
                <div class="content_body text-center">
                    <img src="{{asset('uploads/galleries/'.$gallery->url)}}" alt="" class="w-75 img-thumbnail mt-2">
                </div>
        @endforeach
        </div>
</div>