<?php
use Carbon\Carbon;
?>
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> {{ $product->category->name }}
                    <span></span> {{ $product->title }}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @foreach ($product->image as $image)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset('storage/' . $image->imageName) }}"
                                                         alt="product image">

                                                </figure>
                                            @endforeach
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails pl-15 pr-15">
                                            @foreach ($product->image as $image)
                                                <div><img src="{{ asset('storage/' . $image->imageName) }}"
                                                          alt="product image"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End Gallery -->

                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $product->title }}</h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <span> Category: <a
                                                        href="shop.html">{{ $product->category->name }}</a></span>
                                            </div>
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> ({{ $feedback }}
                                                    reviews)</span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <ins><span
                                                        class="text-brand"></span>&nbsp{{ $annonce->regular_price}} DH</ins>
                                            </div>
                                        </div>
                                        <div class="short-desc mb-30">
                                            <p>{{ $product->description }}</p>
                                        </div>
                                        <div class="product_sort_info font-xs mb-30">
                                            <ul>
                                                <li class="mb-10"><i class="fi-rs-crown mr-5"></i> Announcement City : {{ $annonce->city }}</li>
                                                <li class="mb-10"><i class="fi-rs-refresh mr-5"></i>Minimum Reservation days : {{ $annonce->minday }} </li>
                                                <li><i class="fi-rs-credit-card mr-5"></i>The announcement available from {{ $annonce->from }} to {{ $annonce->to }}</li>
                                            </ul>
                                            @if($annonce->premium =='1')
                                            <ul>
                                                <li>NB : The announcement available for the days: </li>
                                                @foreach ( $annonce->annonceParticuliere->getDisponibleDaysAttribute($annonce->annonceParticuliere->disponible_days) as $day )
                                                <li>{{  $day }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>
                                        <div class="detail-extralink">
                                            <div class="product-extra-link2">
                                                <button type="submit" class="" onclick="showPopup(event)">To book</button>
                                            </div>
                                        </div>
                                        {{-- pop up for reserve :  --}}
                                        <div id="popup" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden z-50">
                                            <div class="absolute w-full h-full bg-gray-900 opacity-50"></div>
                                            <div class="bg-white rounded-lg z-50 overflow-y-auto">
                                                <div class="p-4">
                                                    <h2 class="text-2xl font-bold mb-4">Make Reservation:</h2>
                                                    @if(session()->has('message'))
                                                        <p class="text-red-500 text-xs mt-1"> {{session('message')}}</p>
                                                    @endif
                                                    {{-- reservation particuliere --}}
                                                    @if ($annonce->premium == '1')
                                                    @if (session('available_days'))
                                                            @if (session('available_days') > 0)
                                                                <div class="bg-green-200 rounded p-4">
                                                                    <p class="font-semibold"> You reserved the object for{{ session('available_days') }} days:</p>
                                                                    <ul class="list-disc list-inside">
                                                                        @foreach (session('available_dates') as $date)
                                                                            <li>{{ $date }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @else
                                                                <div class="bg-red-200 rounded p-4">
                                                                    <p class="font-semibold">No days available in the selected period.</p>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                    {{-- End reservation particuliere --}}
                                                    <form method="POST" action="/product/{{ $annonce->id }}">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label class="block text-gray-700 font-bold mb-2" for="start-date">Start Date:</label>
                                                            <input class="border rounded-lg py-2 px-3 text-gray-700 w-full" type="date" id="start-date" name="start_date" value="{{ $annonce->from }}" required>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-gray-700 font-bold mb-2" for="end-date">End Date:</label>
                                                            <input class="border rounded-lg py-2 px-3 text-gray-700 w-full" type="date" id="end-date" name="end_date" value="{{ $annonce->to }}" required>
                                                        </div>
                                                        
                                                        <div class="mb-4">
                                                            <p class="text-gray-700 font-bold mb-2">Rental conditions:</p>
                                                            <ul class="list-disc ml-5">
                                                            <li>The rental duration must be determined with the start and end dates.</li>
                                                                <li>A security deposit may be required by the owner.</li>
                                                                <li>Rental fees must be paid in advance.</li>
                                                                <li>The tenant must take care of the rented object and return it in the same condition.</li>
                                                            </ul>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="flex items-center text-gray-700 font-bold text-sm">
                                                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" onclick="toggleButton()">
                                                                <span class="ml-2">I accept the conditions of rental of objects between individuals</span>
                                                            </label>
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <button type="submit" onclick="reserveObject(event)" id="reserve-button" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mr-2" style="display:none">To book</button>
                                                            <button type="button" onclick="hidePopup()" class="bg-gray-400 text-white font-bold py-2 px-4 rounded">Close</button>
                                                        </div>
                                                    </form>
                                    
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End pop up for reserve :  --}}

                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                           href="#Description">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                           href="#Reviews">Reviews ({{ $feedback }})</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            {{ $product->description }}
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">Client's reviews</h4>
                                                    @foreach ($feedback_info as $_feedback)
                                                        <div class="comment-list">
                                                            <div
                                                                class="single-comment justify-content-between d-flex">
                                                                <div class="user justify-content-between d-flex">

                                                                    <div class="thumb text-center">
                                                                        <img src="{{ asset('storage/' . $_feedback->user->image) }}"
                                                                             alt="">
                                                                        <h6><a
                                                                                href="#">{{ $_feedback->user->name }}</a>
                                                                        </h6>
                                                                        <p class="font-xxs">Since
                                                                            {{ $_feedback->updated_at }}</p>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div class="product-rate d-inline-block">
                                                                            <div class="product-rating"
                                                                                 style="width:90%">
                                                                            </div>
                                                                        </div>
                                                                        <p>{{ $_feedback->comment }}</p>
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="d-flex align-items-center">
                                                                                <p class="font-xs mr-30">
                                                                                    {{ Carbon::parse($_feedback->updated_at)->format('Y F d') }}
                                                                                </p>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--single-comment -->
                                                        </div>
                                                    @endforeach

                                                </div>
                                                <div class="col-lg-4">
                                                    <h4 class="mb-30">Client's reviews</h4>
                                                    <div class="d-flex mb-30">
                                                        <div class="product-rate d-inline-block mr-15">
                                                            <div class="product-rating" style="width:90%">
                                                            </div>
                                                        </div>
                                                        @if ($feedback > 0)
                                                            <h6>{{ number_format($stars_count / $feedback, 2) }}
                                                            </h6>
                                                        @else
                                                            <h6>N/A</h6>
                                                        @endif
                                                    </div>

                                                    <div class="progress">
                                                        <span>5 star</span>
                                                        @if ($feedback > 0)
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ number_format(($stars5 / $feedback) * 100, 2) }}%;"
                                                                 aria-valuenow="{{ number_format($stars5 / $feedback, 0) }}"
                                                                 aria-valuemin="0" aria-valuemax="100">
                                                                {{ number_format(($stars5 / $feedback) * 100, 0) }}%
                                                            </div>
                                                        @else
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: 0%;" aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                                N/A
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="progress">
                                                        <span>4 star</span>
                                                        @if ($feedback > 0)
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ number_format(($stars4 / $feedback) * 100, 2) }}%;"
                                                                 aria-valuenow="{{ number_format($stars4 / $feedback, 0) }}"
                                                                 aria-valuemin="0" aria-valuemax="100">
                                                                {{ number_format(($stars4 / $feedback) * 100, 0) }}%
                                                            </div>
                                                        @else
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: 0%;" aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                                N/A
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="progress">
                                                        <span>3 star</span>
                                                        @if ($feedback > 0)
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ number_format(($stars3 / $feedback) * 100, 2) }}%;"
                                                                 aria-valuenow="{{ number_format($stars3 / $feedback, 0) }}"
                                                                 aria-valuemin="0" aria-valuemax="100">
                                                                {{ number_format(($stars3 / $feedback) * 100, 0) }}%
                                                            </div>
                                                        @else
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: 0%;" aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                                N/A
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="progress">
                                                        <span>2 star</span>
                                                        @if ($feedback > 0)
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ number_format(($stars2 / $feedback) * 100, 2) }}%;"
                                                                 aria-valuenow="{{ number_format($stars2 / $feedback, 0) }}"
                                                                 aria-valuemin="0" aria-valuemax="100">
                                                                {{ number_format(($stars2 / $feedback) * 100, 0) }}%
                                                            </div>
                                                        @else
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: 0%;" aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                                N/A
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="progress mb-30">
                                                        <span>1 star</span>
                                                        @if ($feedback > 0)
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: {{ number_format(($stars1 / $feedback) * 100, 2) }}%;"
                                                                 aria-valuenow="{{ number_format($stars1 / $feedback, 0) }}"
                                                                 aria-valuemin="0" aria-valuemax="100">
                                                                {{ number_format(($stars1 / $feedback) * 100, 0) }}%
                                                            </div>
                                                        @else
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: 0%;" aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                                N/A
                                                            </div>
                                                        @endif

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('product.category', ['slug' => $category->slug]) }}"><i
                                                class="surfsidemedia-font-dress"></i>{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<script src="{{ asset('assets/js/annonce.js') }}"></script>
<script>
function reserveObject(event) {
    event.preventDefault();
  $.ajax({
    url: "/product/" + "{{ $annonce->id }}",
    type: "POST",
    data: $('form').serialize(),
    success: function (response) {
      if (response.success) {
        // If the reservation was successful, display a success message using SweetAlert
        Swal.fire({
          icon: 'success',
          title: 'Success',
          html: response.message
        });
      } else {
        // If the reservation failed, display an error message using SweetAlert
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: response.message
        });
      }
    },
    error: function (response) {
      // If there was an error making the reservation, display an error message using SweetAlert
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'There was an error making your reservation. Please try again later.'
      });
    }
  });
}
</script>