{{-- @dd($categories) --}}
<nav class="navbar p-0">
    <div class="main_logo">
     
        <img src=" {{ config('settings.logo')}}" style="height: 10vh" alt="">
    </div>
    <div class="navigation_category_items">
        <ul id="nav">
            <li >
              <a class="{{ Request::is('/') ? 'active' : 'text-black' }}"
               href="{{URL('/')}}"><i class="fa fa-home"></i> Home</a>
            </li>
            @foreach ($categories as $category)
              <li>
                  <a @if (Request::segment(2) == "$category->name")
                    class="active"
                    @else @class(['text-black'])
                  @endif href="{{URL("/category/$category->name")}}">{{$category->name}}
                  </a>
                </li>
            @endforeach
        </ul>
      </div>
</nav>
<style scoped>
  .text-black {
    color: #000;
  }
.active{
    color: #d35400;
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
  display: block;
  font-family: "bebasregular";
  font-size: 15px;
  font-weight: bold;
  text-decoration: none;
  text-transform: uppercase;
  padding: 15px 15.7px;
  border-right: 2px solid #d35400;

}
.navigation_category_items ul li a:hover{
    background: #d35400;
}
#nav li ul {
  transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -webkit-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
}
</style>