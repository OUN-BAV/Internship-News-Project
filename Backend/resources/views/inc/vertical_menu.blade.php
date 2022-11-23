<nav class="p-2 mt-2">
    <ul class="list-unstyled">
        @foreach ($categories as $category)
            <li class="bg-light shadow-sm p-2 mt-2 text-start rounded"><a class="text-secondary text-decoration-none" href="">{{$category->name}}</a></li>
        @endforeach
    </ul>
</nav>