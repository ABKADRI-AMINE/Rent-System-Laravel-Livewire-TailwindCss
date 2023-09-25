<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block;
        }

        .wishlisted {
            background-color: #F15412 !important;
            border: 1px solid transparent !important;
        }

        .wishlisted {
            color: #fff !important;
        }

        /* New CSS rule for user image */
        .user-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Mes Demandes
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We found <strong class="text-brand">{{ $totalDemandes }}</strong> items for you
                                    {{ auth()->user()->id }}!</p>
                            </div>

                        </div>
                        <div class="row product-grid-3">
                            @foreach ($demandes as $demande)
                                <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            {{-- <div class="product-img product-img-zoom">
                                            <a href="{{route('product.details',['slug'=>$annonce->slug])}}">
                                                <img class="default-img" src="{{asset('assets/imgs/shop/product-')}}{{$annonce->products_id}}-1.jpg" alt="{{$annonce->title}}">
                                                <img class="hover-img" src="{{asset('assets/imgs/shop/product-')}}{{$annonce->products_id}}-2.jpg" alt="{{$annonce->title}}">
                                            </a>
                                        </div> --}}
                                            <br><br>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">{{ $demande->title }}</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="#">Price : {{ $demande->sale_price }}</a>
                                            </div>
                                            <h2>
                                                <div class="user-image">
                                                    <img src="{{ asset('storage/'.$demande->image)}}" alt="User Image" />
                                                </div>
                                                Customer Name : {{ $demande->name }}
                                            </h2>
                                            <h2>Customer's first name : {{ $demande->prenom }}</h2>
                                            <span>
                                                <span>Beginning of reservation :
                                                    {{ $demande->reservation_Ddate }}</span><br>
                                                <span>End of reservation : {{ $demande->reservation_Fdate }}</span>
                                            </span>
                                            <br>
                                            <span>Product Description : {{ $demande->description }}</span>
                                       
</div>
                                        <br> <br> <br> <br>
                                        <div class="product-action-1 show">
                                            <a aria-label="cancel" class="action-btn hover-up" href="#" wire:click.prevent="cancel({{$demande->idD}})"><img src="assets/imgs/theme/icons/icon-cancel.svg" alt="Surfside Media"></a>
                                            <a aria-label="Confirmer" class="action-btn hover-up" href="#" wire:click.prevent="update({{$demande->idD}})"><img src="assets/imgs/theme/icons/icon-confirm.svg" alt="Surfside Media"></a>
                                        </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                <!--pagination-->
                <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                    {{ $demandes->links() }}
                </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="row">
                        <div class="col-lg-12 col-mg-6"></div>
                        <div class="col-lg-12 col-mg-6"></div>
                    </div>
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                        <ul class="categories">
                            @foreach ($categories as $category)
                                <li><a href="{{route('product.category',['slug'=>$category->slug])}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>