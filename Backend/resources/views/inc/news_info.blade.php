<div>
    <div>
        <div>
            <h3>{{$posts[0]->title}}</h3>
        </div>
        <div>
            <img src="{{asset('uploads/galleries/'.$posts[0]->thumbnail)}}" alt="" style="width: 300px;">
        </div>
    </div>
    
    <div class="body_info mt-5 ms-3">
        <div class="content_title">
            {!!$posts[0]->content!!}
        </div>
        @foreach($posts[0]->galleries as $gallery)
                <div class="content_body">
                    <img src="{{asset('uploads/galleries/'.$gallery->url)}}" alt="" class="w-75 mt-2">
                </div>
        @endforeach
    </div>

    <div class="tags mt-5 ">
        <div class="tags-name">
            <h4>Ronaldo</h4>
        </div>
        <div class="tags-content d-flex mt-3">
            <div class="content-type">
                <p>Jobs</p>
            </div>
            <div class="content-type">
                <p>Study</p>
            </div>
            <div class="content-type">
                <p>Family</p>
            </div>
            <div class="content-type">
                <p>Social</p>
            </div>
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
        width: 15%;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        background: rgb(252, 241, 124);
        padding: 5px;
        height: 5vh;
    }
    .content-type{
        background: rgb(252, 241, 124);
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        padding: 5px;
        margin-left: 3px;
        height: 5vh;
    }
</style>
