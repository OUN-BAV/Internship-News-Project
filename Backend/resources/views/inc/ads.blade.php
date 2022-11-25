<div class="shadow-sm mt-2">
    <img class="w-100 img-fluid img-thumbnail cover" src="{{asset($ads[0]->image)}}" alt="Responsive image">
    <p class="ads_title">
        <marquee behavior="left" direction="right">{{$ads[0]->title}}</marquee>
    </p>
</div>
<style scoped>
    .ads_title{
        width: 90%;
        color: #fff;
        position: absolute;
        margin-top: -35px;
        margin-left: 10px;
    }
</style>
