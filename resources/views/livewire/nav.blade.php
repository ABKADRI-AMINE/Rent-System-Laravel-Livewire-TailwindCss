<div class="categori-dropdown-wrap categori-dropdown-active-small">
    <ul>
        @foreach($categories as $category)
            <li><a href="{{route('product.category',['slug'=>$category->slug])}}"><i class="surfsidemedia-font-dress"></i>{{$category->name}}</a></li>
        @endforeach
    </ul>
</div>
