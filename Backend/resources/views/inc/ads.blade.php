<div class="mt-2">
    <div class="ads-img">
        <img src="{{asset('images/ads.png')}}" alt="">
    </div>
    <div>
        <img class="w-100 img-fluid cover" src="{{asset($ads[0]->image)}}" alt="Responsive image">
        <p class="ads_title">
            <marquee behavior="left" direction="right">{{$ads[0]->title}}</marquee>
        </p>
    </div>
</div>
<style scoped>
    .ads_title{
        width: 90%;
        color: #fff;
        position: absolute;
        margin-top: -35px;
        margin-left: 10px;
    }
    .ads-img img{
        position: absolute;
        width: 20px;
        height: 20px;
        justify-content: flex-end;
        z-index: 0;
    }
</style>
