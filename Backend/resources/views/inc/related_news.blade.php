<div class="row shadow-sm mt-3">
    <div class="card-body">
        <div class="container">
            <div class="ads-img">
                <img src="{{asset('images/ads.png')}}" alt="">            
            </div>
            <div class="img">
                <img src="{{asset($ads[0]->image)}}" style="width:100%" alt="" />
            </div>
        </div>
        <div class="card-title text-center">
            <h6>{{$ads[0]->title}}</h6>
        </div>
    </div>
    
    <div class="article-related">
        @if(!empty($related_info))
        <h3>Related</h3>
            @foreach($related_info as $related)
                @if($related->id != $posts[0]->id)
                    <div class="row">
                        <div class="col-12">
                    <div class="article-list small">
                        <img src="{{asset('uploads/galleries/'.$related->thumbnail)}}" style="width: 100%" alt="">
                        <div class="article-list-item-detail">
                            <a onclick="show({{$related->id}})" href="{{URL("/article/$related->id")}}">
                                <h5 class="article-list-item-detail-title">{{$related->title}}</h5>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <div class="single_sidebar mb-3">
        <div class="ads-img">
            <img src="{{asset('images/ads.png')}}" alt="">
        </div>
        <div class="ads">
            <img src="https://ads.groupincorp.com/www/images/7fd3aa408a78a78501a71f732b4dba59.jpg" width="300" height="450" alt="" title="" border="0">
        </div>
    </div>
</div>
<style scoped>
    h3{
        font-weight: bold;
    }
    .article-related {
        padding: 1rem;
        font-size: 3px;
    }
    .ads img{
        width: 100%;
    }
    .ads-img img{
        position: absolute;
        width: 20px;
        height: 20px;
        justify-content: flex-end;
        z-index: 0;
    }
    .article-list a{
        text-decoration: none;
        color: black;
    }
    .article-list-item-detail-title, .card-title{
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        white-space: normal!important;
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
