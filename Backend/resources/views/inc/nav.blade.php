{{-- @dd($categories) --}}
<nav class="navbar p-0">
    <div class="main_logo">
        <img src="{{asset('images/news.png')}}" style="height: 10vh" alt="">
    </div>
    <div class="navigation_category_items">
        <ul id="nav">
            <li><a class="active" href="{{URL('/')}}"><i class="fa fa-home"></i> Home</a></li>
            @foreach ($categories as $category)
                <li><a href="{{URL("/category/$category->name")}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
      </div>
</nav>
<style scoped>
.active{
    color: #FFD910;
}
.main_logo{
    width: 100%;
    background: black;
    text-align: center;
    padding: 3px;
}

.main_logo h2{
    text-align: center;
    color: #dededf;
}
.navigation_category_items {
    position: sticky;
  overflow: visible;
  background: #b8b8bb;
  width: 100%;
}
.navigation_category_items ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.navigation_category_items ul li {
  float: left;
  position: relative;
}
.navigation_category_items ul li a {
  color: rgb(3, 3, 3);
  display: block;
  font-family: "bebasregular";
  font-size: 15px;
  font-weight: bold;
  text-decoration: none;
  text-transform: uppercase;
  padding: 18px 18.7px;
  border-right: 2px solid #FFD910;

}
.navigation_category_items ul li a:hover{
    color: #FFD910;
}
#nav li ul {
  transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -webkit-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
}

</style>