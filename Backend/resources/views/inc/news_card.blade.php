{{-- @dd($categories[0]->post) --}}

@foreach ($categories as $category )
    @if($category->post == [])
        <h1>hhhhhh</h1>
    @else
        <div class=" border-bottom border-3 border-info">
            <div class="bg-info shadow-sm category">{{$category->name}}</div>
        </div>
        <div class="w-100 d-flex" style="flex-wrap: wrap">
            @foreach ($category->post as $post)
                <a href="" class="card bg-light p-2 border-1 text-decoration-none m-1" style="width: 32%">
                    <div class="card_body">
                        <img src="{{asset('uploads/galleries/'.$post->thumbnail)}}" class="img-thumbnail" alt="" style="width: 240px;height:240px;">
                    </div>
                    <div class="card_footer">
                        <p class="text-secondary " style="font-size: 0.5rem;">{{$post->created_at}}</p>
                        <p class=" text-dark">{{$post->title}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endforeach
<style scoped>
    .category{
        clip-path: polygon(0 0, 72% 0, 100% 100%, 0% 100%);
        width: 170px;
        height: 40px;
        display: flex;
        padding: 2px;
        align-items: center;
    }
</style>