<div class="row">
    <div class="col-md-8">
        <div class="container-grid">
                <div class="d-flex">
                    <div>
                        <img src="{{ asset('uploads/galleries/' . $posts[0]->thumbnail) }}" class="img-thumbnail"
                            alt="" style="width: 220px;">
                    </div>
                    <div class="mt-3 ms-3">
                        <div>
                            <h3>{{ $posts[0]->title }}</h3>
                        </div>
                        <p>{{$posts[0]->created_at}}</p>
                        <p>{{$posts[0]->user->name}}</p>
                    </div>
                </div>
            <div class="body_info mt-3 ms-3">
                <div class="content_title">
                    <p>{{ $posts[0]->content }}</p>
                </div>
                @foreach ($posts[0]->galleries as $gallery)
                    <div class="content_body mt-3">
                        <img src="{{ asset('uploads/galleries/' . $gallery->url) }}" style="width: 130%" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<style>
    .single_left_coloum_wrapper {
        position: relative;
        margin-bottom: 30px;
    }

    .title {
        border-bottom: 4px solid #cf0000;
        font-family: "bebasregular";
        font-size: 20px;
        word-spacing: 2px;
    }

    .more {
        background: url("images/plus.png") no-repeat scroll 57px 9px #cf0000;
        color: #fff;
        display: block;
        font-size: 10px;
        font-weight: bold;
        padding: 4px 20px;
        position: absolute;
        right: 0;
        text-transform: uppercase;
        top: 10px;
    }

    .popular_more {
        background: url("images/plus.png") no-repeat scroll 57px 12px #cf0000;
        color: #fff;
        display: block;
        font-size: 10px;
        font-weight: bold;
        padding: 7px 20px;
        text-transform: uppercase;
        width: 74px;
        margin-top: 10px;
    }

    .single_left_coloum {
        margin-left: 10px;
        width: 143px;
    }

    .readmore,
    .single_cat_right_content_meta span {
        color: #cf0000;
        font-size: 10px;
        text-transform: uppercase;
        font-weight: bold;
        margin-right: 20px;
    }

    .readmore:hover,
    .single_cat_right_content_meta span:hover {
        color: #cf0000;
        text-decoration: underline;
    }

    .gallery img {
        margin-bottom: 10px;
        margin-left: 10px;
        width: 141px;
    }

    .single_cat_left_content {
        border-bottom: 1px dotted #000;
        margin-left: 10px;
        width: 220px;
    }

    .single_cat_left_content h3 {
        font-size: 15px;
    }

    .single_cat_left_content_meta {
        font-size: 11px;
    }

    .single_cat_left_content_meta span {
        color: #cf0000;
    }

    .right_coloum {
        width: 190px;
        margin-left: 20px;
    }

    .single_right_coloum {
        margin-bottom: 20px;
    }

    .single_right_coloum ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .single_right_coloum ul li {
        border-bottom: 1px dotted #ddd;
    }

    .single_right_coloum ul li:last-child {
        border-bottom: none;
    }

    .single_cat_right_content {
        padding-bottom: 10px;
    }

    .single_cat_right_content h3 {
        margin-top: 10px;
    }

    .single_cat_right_content_meta {}

    .editorial {}

    .editorial h3 {
        color: #cf0000;
    }

    .sidebar {
        width: 250px;
    }

    .single_sidebar {
        margin-bottom: 20px;
        padding: 5px;
    }

    .news-letter {
        padding: 10px;
        background: #e4e4e4;
    }

    .news-letter h2 {
        font-family: bebasregular;
        font-size: 20px;
        margin-bottom: 5px;
        word-spacing: 2px;
    }

    .news-letter p {}

    .news-letter form input#name {
        border: 1px solid #999;
        margin-bottom: 10px;
        width: 100%;
    }

    .news-letter form input#email {
        border: 1px solid #999;
        margin-bottom: 10px;
        width: 100%;
    }

    .news-letter form input#form-submit {
        background: none repeat scroll 0 0 #cf0000;
        border: medium none;
        color: #fff;
        font-weight: bold;
        padding: 8px 20px;
        font-size: 13px;
    }

    .news-letter-privacy {
        color: #cf0000;
        margin-top: 10px;
    }

    .popular {}

    .popular ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .popular ul li {
        border-bottom: 1px dotted #000;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .popular ul li:last-child {
        border-bottom: none;
    }

    .single_popular {}

    .single_popular p {
        margin-bottom: 0;
    }

    .single_popular h3 {
        line-height: 17px;
        margin-top: 0;
    }
</style>
