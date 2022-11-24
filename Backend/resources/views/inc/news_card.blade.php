{{-- @dd($categories[0]->post) --}}

@foreach ($categories as $category )
   
        <div class=" border-bottom border-2 border-dark">
            <div class="bg-dark shadow-sm category text-light rounded-top">{{Str::upper($category->name)}}</div>
        </div>
        <div class="w-100 d-flex" style="flex-wrap: wrap">
            @foreach ($category->post as $post)
                <div class="card bg-light p-2 border-1 text-decoration-none m-1" style="width: 32%">
                    <div class="card_body text-center">
                        <img src="{{asset('uploads/galleries/'.$post->thumbnail)}}" class="img-thumbnail" alt="" style="width: 220px;">
                    </div>
                    <a href="{{URL("/post/$post->id")}}"><p class=" text-dark">{{$post->title}}</p></a>
                    <div class="card_footer">
                        <p class="text-secondary " style="font-size: 0.5rem;">{{$post->created_at}}</p>
                        <p class="text-secondary" style="font-size: 0.9rem">{{Str::limit($post->content,60)}}</p>
                    </div>
                </div>
            @endforeach
        </div>
@endforeach
<style scoped>
    .card a{
        text-decoration: none;
    }
    .category{
        clip-path: polygon(0 0, 90% 0, 100% 100%, 0% 100%);
        width: 170px;
        height: 40px;
        display: flex;
        padding: 2px;
        align-items: center;
    }
</style>