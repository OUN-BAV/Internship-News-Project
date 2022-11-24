<nav class="navbar">
    <div class="main_logo">
        <img src="{{asset('images/news.png')}}" style="height: 10vh" alt="">
    </div>
    <div class="navigation_category_items">
        <ul id="nav">
          <li><a href="#">worldnews</a>
          </li>
          <li><a href="#">sports</a></li>
          <li><a href="#">tech</a>
          </li>
          <li><a href="#">business</a></li>
          <li><a href="#">Movies</a>
          </li>
          <li><a href="#">entertainment</a></li>
          <li><a href="#">culture</a></li>
          <li><a href="#">Books</a>
          </li>
          <li><a href="#">classifieds</a></li>
          <li><a href="#">blogs</a></li>
        </ul>
      </div>
</nav>
<style scoped>
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
  border-right: 2px solid rgb(226, 86, 4);

}
.navigation_category_items ul li a:hover{
    color: rgb(226, 86, 4);
}
#nav li ul {
  transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -webkit-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
}
</style>