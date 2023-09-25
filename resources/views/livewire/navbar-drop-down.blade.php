<div class="categori-dropdown-wrap categori-dropdown-active-large">
    <ul>
        @foreach($categories as $category)
            <li class="has-children">
                <a href="{{route('product.category',['slug'=>$category->slug])}}"><i class="surfsidemedia-font-dress"></i>{{$category->name}}</a>
            </li>
        @endforeach
        <li>
            <ul class="more_slide_open" style="display: none;">
                @foreach($categorieslimit as $category)

                    <li><a href="{{route('product.category',['slug'=>$category->slug])}}"><i class="surfsidemedia-font-desktop"></i>{{$category->name}}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
    <div class="more_categories">Show more...</div>
</div>
