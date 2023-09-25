<?php
use Carbon\Carbon;
?>
<x-app-layout>
<body>
    @if(session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Alert!</strong>
        <span class="block sm:inline">{{ session()->get('message') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 6.066 4.652a1 1 0 00-1.414 1.414L8.586 10l-3.934 3.934a1 1 0 001.414 1.414L10 11.414l3.934 3.934a1 1 0 001.414-1.414L11.414 10l3.934-3.934a1 1 0 000-1.414z"/>
            </svg>
        </span>
    </div>
    @endif
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
                                        @foreach ($annonce->product->image as $img )
                                            <figure class="border-radius-10">
                                                <img src="{{ asset('storage/'.$img->imageName) }}" alt="product image">
                                            </figure>
                                        @endforeach
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @foreach ($annonce->product->image as $image)
                                            <div><img src="{{ asset('storage/' . $image->imageName) }}"
                                                    alt="product image"></div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{ $annonce->product->title }}</h2>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> Status: {{ $annonce->stat == 1 ? "En ligne" : ($annonce->stat == 0 ? "Offline" : "En attente") }}</span>
                                        </div>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ $feedback }} reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand">{{ $annonce->regular_price }} DH /j</span></ins>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p>{{ $annonce->product->description }}</p>
                                    </div>
                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            <li class="mb-10"><i class="fi-rs-crown mr-5"></i> {{ $annonce->city }}</li>
                                            <li class="mb-10"><i class="fi-rs-refresh mr-5"></i>Min days : {{ $annonce->minday }} </li>
                                            <li><i class="fi-rs-credit-card mr-5"></i> From {{ $annonce->from }} to {{ $annonce->to }}</li>
                                            @if($annonce->premium =='1')
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="product-extra-link2">
                                            <div class="flex">
                                              <button type="submit" class="mb-2 mr-2 hover-up" onclick="showPopup(event)">Modify</button>
                                              <form id="delete" method="POST" action="/mesAnnonces/{{$annonce->id}}" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn hover-up"><i class="fi-rs-trash"></i> Delete</button>
                                              </form>   
                                            </div>                                     
                                        </div>
                                    </div>
                                    {{-- Start Update Annonce  --}}
                                    <div id="popup" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden z-50">
                                        <div class="absolute w-full h-full bg-gray-900 opacity-50"></div>
                                        <div class="bg-white rounded-lg z-50 overflow-y-auto">
                                            <div class="p-4">
                                                <h2 class="text-2xl font-bold mb-4">Update The Announcement :</h2>
                                                <form id="update" method="POST" action="/mesAnnonces/{{$annonce->id}}"> 
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="flex flex-col mb-2">    
                                                        <label class="font-medium text-sm text-gray-700 mb-1">Object</label>
                                                        <div class="relative focus-within:text-gray-600 text-gray-400">
                                                        <select name="object_id" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                            @foreach ($objects as $object)
                                                                <option value="{{ $object->id }}" {{ $object->id == $annonce->products_id ? 'selected' : '' }}>{{ $object->title}}</option>    
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    </div>
                                                    <div class="flex flex-col mb-2">
                                                        <label class="font-medium text-sm text-gray-700 mb-1">City</label>
                                                        <div class="relative focus-within:text-gray-600 text-gray-400">
                                                        <input type="text" name="ville" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" value="{{ $annonce->city }}">
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center space-x-4 mb-2 justify-between">
                                                        <div class="flex flex-col">
                                                        <label class="font-medium text-sm text-gray-700 mb-1">Min days</label>
                                                        <div class="relative focus-within:text-gray-600 text-gray-400">
                                                            <input type="number" id="min-days" name="jours_min" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" min="1" value="{{ $annonce->minday }}">
                                                        </div>
                                                        </div>
                                                        <div class="flex flex-col">
                                                            <label class="font-medium text-sm text-gray-700 mb-1">Price per day</label>
                                                            <div class="relative focus-within:text-gray-600 text-gray-400">
                                                                <input type="number" name="price" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="prix en DH" min="0" value="{{ $annonce->regular_price }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="font-medium text-sm text-gray-700 mb-1">Availability date</label>
                                                    <div date-rangepicker class="flex items-center justify-between mb-3">
                                                      <div class="relative">
                                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                          <!-- Add icon or label here if needed -->
                                                        </div>
                                                        <input name="date_debut" id="start-date" type="date" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Select date start" onchange="validateDateRange()" value="{{ $annonce->from }}">
                                                      </div>
                                                      To
                                                      <div class="relative">
                                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                          <!-- Add icon or label here if needed -->
                                                        </div>
                                                        <input name="date_fin" id="end-date" type="date" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Select date end" onchange="validateDateRange()" value="{{ $annonce->to }}">
                                                      </div>
                                                    </div> 
                                                    <div class="inline-flex items-center">
                                                        <label for="particuliere" class="font-medium text-sm text-gray-700">Particular</label>
                                                        <input type="checkbox" name="particuliere" id="particuliere-checkbox" class="ml-2">
                                                    </div>
                                                    <div id="days-of-week-container" style="display:none">
                                                      <label class="block font-medium text-sm text-gray-700">Disponibility Days</label>
                                                        <div class="flex">
                                                            <label for="monday" class="inline-flex items-center mr-4">
                                                              <input type="checkbox" name="disponibility[]" id="monday" value="monday" class="form-checkbox">
                                                                <span class="ml-2 text-sm text-gray-600">Mon</span>
                                                            </label>
                                                            <label for="tuesday" class="inline-flex items-center mr-4">
                                                                <input type="checkbox" name="disponibility[]" id="tuesday" value="tuesday" class="form-checkbox">
                                                                <span class="ml-2 text-sm text-gray-600">Tue</span>
                                                            </label>
                                                            <label for="wednesday" class="inline-flex items-center mr-4">
                                                                <input type="checkbox" name="disponibility[]" id="wednesday" value="wednesday" class="form-checkbox">
                                                                <span class="ml-2 text-sm text-gray-600">Wed</span>
                                                            </label>
                                                            <label for="thursday" class="inline-flex items-center mr-4">
                                                                <input type="checkbox" name="disponibility[]" id="thursday" value="thursday" class="form-checkbox">
                                                                <span class="ml-2 text-sm text-gray-600">Thur</span>
                                                            </label>
                                                            <label for="friday" class="inline-flex items-center mr-4">
                                                                <input type="checkbox" name="disponibility[]" id="friday" value="friday" class="form-checkbox">
                                                                <span class="ml-2 text-sm text-gray-600">Fri</span>
                                                            </label>
                                                            <label for="saturday" class="inline-flex items-center mr-4">
                                                                <input type="checkbox" name="disponibility[]" id="saturday" value="saturday" class="form-checkbox">
                                                                <span class="ml-2 text-sm text-gray-600">Sat</span>
                                                            </label>
                                                            <label for="sunday" class="inline-flex items-center mr-4">
                                                                <input type="checkbox" name="disponibility[]" id="sunday" value="sunday" class="form-checkbox">
                                                                <span class="ml-2 text-sm text-gray-600">Sun</span>
                                                            </label>
                                                        </div>
                                                      </div>                            
                                                    <div class="flex justify-end mt-4">
                                                        <button type="submit" id="submit-btn" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mr-2">Update</button>
                                                        <button type="button" onclick="hidePopup()" class="bg-gray-400 text-white font-bold py-2 px-4 rounded">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{--End Update Annonce  --}}
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                        href="#Reviews">Reviews ({{ $feedback }})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
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
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/annonce.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('delete-btn').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this annonce!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete').submit();
                }
            })
        });
    </script>
<form id="update" method="POST" action="/mesAnnonces/{{$annonce->id}}">
    <!-- form fields go here -->
    <button type="submit" id="submit-btn">Submit</button>
  </form>
  
  <script>
    const form = document.getElementById('update');
    const submitButton = document.getElementById('submit-btn');
    form.addEventListener('submit', (event) => {
      event.preventDefault(); // prevent form from submitting
      submitButton.disabled = true; // disable submit button to prevent double submission
  
      // submit form using AJAX
      const formData = new FormData(form);
      fetch(form.action, {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok) {
          // show success message
          Swal.fire({
            title: 'Success!',
            text: 'Your annonce has been Updated.',
            icon: 'success'
          });
          location.reload();
        } else {
          // show error message
          Swal.fire({
            title: 'Error!',
            text: 'There was an error Updating your form.',
            icon: 'error'
          });
        }
      })
      .catch(error => {
        // show error message
        Swal.fire({
          title: 'Error!',
          text: 'There was an error Updating your form.',
          icon: 'error'
        });
      })
      .finally(() => {
        submitButton.disabled = false; // re-enable submit button
      });
    });
  </script>
</body>
</html>
</x-app-layout>