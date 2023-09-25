<div>
    <main class="main">
        <!-- Hero Slider Start -->
        <section class="home-slider position-relative pt-50">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Trade-in offer</h4>
                                    <h2 class="animated fw-900">Supper value deals</h2>
                                    <h1 class="animated fw-900 text-brand">On all products</h1>
                                    <p class="animated"></p>
                                    <a class="animated btn btn-brush btn-brush-3" href="{{route('shop')}}"> Shop Now </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-1" src="assets/imgs/slider/slider-1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Hot promotions</h4>
                                    <h2 class="animated fw-900">Great Collection</h2>
                                    <h1 class="animated fw-900 text-7">high quality</h1>
                                    <p class="animated"></p>
                                    <a class="animated btn btn-brush btn-brush-2" href="{{route('shop')}}"> Discover
                                        Now </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-2" src="assets/imgs/slider/slider-2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <!-- 6 dlmoraba3ar -->
        <section class="featured section-padding position-relative">
            <div class="container">
                <div class="row" >
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-1.png" alt="">
                            <h4 class="bg-1">Save time</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-2.png" alt="">
                            <h4 class="bg-3">Online Order</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-3.png" alt="">
                            <h4 class="bg-2">Save Money</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-4.png" alt="">
                            <h4 class="bg-4">Promotions</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-5.png" alt="">
                            <h4 class="bg-5">Happy Sell</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-6.png" alt="">
                            <h4 class="bg-6">24/7 Support</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                                    type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three"
                                    type="button" role="tab" aria-controls="tab-three" aria-selected="false">New added
                            </button>
                        </li>
                    </ul>
                    <a href="{{route('shop')}}" class="view-more d-none d-md-flex">View More<i
                            class="fi-rs-angle-double-small-right"></i></a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @foreach($annoncesFeatured as $annonce)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{route('product.details',['slug'=>$annonce->product->slug,'id'=>$annonce->id])}}">
                                                    <img class="default-img w-300 h-300 object-cover image-size" src="{{ asset('storage/'.$annonce->product->image->first()->imageName) }}" alt="">
                                                    <img class="hover-img w-300 h-300 object-cover image-size" src="{{asset('storage/'.$annonce->product->image->first()->imageName)}}" alt="" >
                                                </a>
                                            </div>
                                            
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                                {{-- <span>
                                                    <span style="color: black">{{$annonce->id}}</span>
                                                </span> --}}
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{route('product.category',['slug'=>$annonce->product->category->slug])}}">{{$annonce->product->category->name}}</a>
                                                                        
                                            </div>
                                            <h2><a href="{{route('product.details',['slug'=>$annonce->product->slug,'id'=>$annonce->id])}}">{{$annonce->product->title}}</a></h2>
                                            <div>
                                            <span>
                                                <span></span>
                                            </span>
                                            </div>
                                            <div class="product-price">
                                                <span>{{$annonce->sale_price}}</span>
                                                {{-- <span class="old-price">{{$annonce->regular_price}}</span> --}}
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up" href="#" wire:click.prevent="store({{$annonce->id}},'{{$annonce->product->title}}',{{$annonce->regular_price}},'{{$annonce->from}}','{{$annonce->to}}')"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!--End product-grid-4-->
                    </div>
                    
                    <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                        <div class="row product-grid-4">
                            @foreach($annoncesDate as $annonce)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{route('product.details',['slug'=>$annonce->product->slug,'id'=>$annonce->id])}}">
                                                    <img class="default-img" src="{{ asset('storage/' . $annonce->product->image->first()->imageName) }}" alt="" width="200" height="200">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal"
                                                   data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i
                                                        class="fi-rs-heart"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">New</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{route('product.category',['slug'=>$annonce->product->category->slug])}}">{{$annonce->product->category->name}}</a>
                                            </div>
                                            <h2><a href="{{route('product.details',['slug'=>$annonce->product->slug,'id'=>$annonce->id])}}">{{$annonce->product->title}}</a></h2>
                                            <div class="rating-result" title="90%">
                                            <span>
                                                <span>90%</span>
                                            </span>
                                            
                                            </div>
                                            <div class="product-price">
                                                <span>{{$annonce->sale_price}}</span>
                                                {{-- <span class="old-price">{{$annonce->regular_price}}</span> --}}
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up" href="#" wire:click.prevent="store({{$annonce->id}},'{{$annonce->product->title}}',{{$annonce->regular_price}},'{{$annonce->from}}','{{$annonce->to}}')"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab three (New added)-->
                </div>
                <!--End tab-content-->
            </div>
        </section>

        <section class="popular-categories section-padding mt-15 mb-25">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach($categories as $category)
                            <div class="card-1">
                                <figure class=" img-hover-scale overflow-hidden">
                                    <a href="{{route('product.category',['slug'=>$category->slug])}}"><img class="object-cover image-size-catecory" src="{{ asset('storage/' . $category->image) }}" alt=""></a>
                                </figure>
                                <h5><a href="{{route('product.category',['slug'=>$category->slug])}}">{{$category->name}} </a></h5>
                            </div>
                        @endforeach
                    </div>    
                </div>

    </main>
</div>
<script>
    function showSweetAlert() {
      Swal.fire({
        title: 'Unauthorized',
        text: 'You are not authorized to perform this action.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
    </script>