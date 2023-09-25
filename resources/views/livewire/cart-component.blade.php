<div></div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if(Session::has('success_message'))
                                <div class="alert alert-success">
                                    <strong>Success {{Session::get('success_message')}}</strong>
                                </div>
                            @endif
                                @if (session()->has('error_message'))
                                    <div class="{{ session()->get('alert-class') }} alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>{{ session()->get('error_message') }}</strong>
                                    </div>
                                @endif



                            @if(Cart::instance('cart')->count()>0)

                            <table class="table shopping-summery text-center clean">
                                <thead>
                                <tr class="main-heading">
{{--                                    <th scope="col">Image</th>--}}
                                    <th scope="col">Name</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Price</th>
{{--                                    <th scope="col">Quantity</th>--}}
                                    {{-- <th scope="col">Subtotal</th> --}}
                                    <th scope="col">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::instance('cart')->content() as $item)
                                    <tr>
{{--                                        <td class="image product-thumbnail"><img src="{{asset('assets/imgs/shop/product-')}}{{$item->id}}-1.jpg" alt="#"></td>--}}
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="product-details.html">{{$item->name}}</a></h5>
                                        </td>
                                        @php
                                         $slug = Str::slug($item->name);
                                        @endphp
                                        <td>
                                            <button type="button"><a href="{{route('product.details',['slug'=>$slug,'id'=>$item->id])}}">Details</a> </button>
                                        </td>


                                        <td class="price" data-title="Price"><span>${{$item->price}} </span></td>
                                        {{-- <td class="text-right" data-title="Cart">
                                            <span>${{$item->subtotal}} </span>
                                        </td> --}}
                                        <td class="action" data-title="Remove"><a href="#" class="text-muted" wire:click.prevent="destroy('{{$item->rowId}}')"><i class="fi-rs-trash"></i></a></td>

                                    </tr>
                                @endforeach

                                <tr>

                                    <td colspan="6" class="text-end">
                                        <a href="#" class="text-muted" wire:click.prevent="clearAll()"> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                                        @else
                                            <p>No Item In Cart</p>
                                        @endif
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-12 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td class="cart_total_label">Cart Subtotal</td>
                                                <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{Cart::subtotal()}}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Tax</td>
                                                <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">${{Cart::tax()}}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Shipping</td>
                                                <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Free Shipping</td>
                                            </tr>
                                            <tr>
                                                <td class="cart_total_label">Total</td>
                                                <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">${{Cart::total()}}</span></strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="checkout.html" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
