<div class="mt-2">
    <div class="ads-img">
        <img src="{{asset('images/ads.png')}}" alt="">
    </div>
    <div>
        <a href="https://www.ababank.com/km/fixed-deposit-with-insurance/?utm_source=local_publisher_khmerload&utm_medium=banner&utm_campaign=fixed_deposit_manulife">
            <img class="w-100 img-fluid cover" src="{{asset($ads[0]->image)}}" alt="Responsive image">
        </a>
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
    }
</style>
<script>
    // var count=1
    // setInterval(() => {
    //    console.log(count++);
    // }, 10000);
</script>
