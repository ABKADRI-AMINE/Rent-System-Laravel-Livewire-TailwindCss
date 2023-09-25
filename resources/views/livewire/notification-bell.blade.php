<div wire:poll.1s x-data="{ dropdownOpen: false }" class="relative">
    {{-- <button @click="dropdownOpen = !dropdownOpen"
        class=""><i
            class="fas fa-bell "></i></a>
    </button> --}}
    <img class="svgInject" alt="notification"
    src="{{asset('assets/imgs/theme/icons/icon-notification.svg')}}" width="30" height="25" @click="dropdownOpen = !dropdownOpen">
    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

    <div x-show="dropdownOpen" class="max-h-96 overflow-y-scroll absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20"
        style="width:20rem;">
        <div class="py-2">
            @forelse($notifications as $notification)
                <div class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                    <img class="h-8 w-8 rounded-full object-cover mx-1"
                        src="{{--{{ $notification->demande->annonces->product->images }}--}}{{ asset('assets/imgs/shop/product-16-1.jpg') }} " width="50" height="50" alt="avatar">
                    <p class="text-gray-600 text-sm mx-2">
                        <a class="font-bold" href="/article/{{ $notification->demande->annonces->product->id }}">
                            {{ $notification->demande->annonces->product->title }}</a>
                        {{ $notification->message }}
                    </p>
                </div>
            @empty
                <div class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                    <p class="uppercase text-red-500 text-center"> No notifications </p>
                </div>
            @endforelse



        </div>
    </div>
</div>