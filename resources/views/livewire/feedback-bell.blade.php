<div x-data="{ dropdownOpen: false }" class="header-action-icon-2" wire:poll.5s>
    {{-- <button @click="dropdownOpen = !dropdownOpen" class="mini-cart-icon"><i class="fas fa-comment-alt"></i>
    </button> --}}
    <img class="mini-cart-icon" alt="message"
    src="{{asset('assets/imgs/theme/icons/icom-message.svg')}}" width="30" height="25" @click="dropdownOpen = !dropdownOpen">
    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
    
    @if(count($demandes) > 0)
            <span class="pro-count blue">{{count($demandes)}}</span>
    @endif
    {{-- <a class="mini-cart-icon" href="{{route('shop.cart')}}">
        <img alt="cart" src="{{asset('assets/imgs/theme/icons/icon-cart.svg')}}">
        @if(Cart::instance('cart')->count()>0)
        <span class="pro-count blue">{{Cart::instance('cart')->count()}}</span>
        @endif
    </a> --}}
    <div x-show="dropdownOpen" class=" max-h-96 overflow-y-scroll absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20" style="width:20rem;">
       
        @forelse($demandes as $demande)
        <div class="py-2">
            <div class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                 <div class="p-2 w-20"><img src="{{--{{$demande->images}}--}}assets/imgs/shop/product-1-1.jpg" alt="{{ $demande->title}}" width="50" height="50"></div>
                <div class="flex-auto text-sm text-black w-32">
                    <div class="font-bold text-xs">The rent has been complish</div>
                    <div class="text-gray-500 text-xs">{{ $demande->updated_at->diffForHumans() }}</div>
                    <a href="{{ route('feedback.details', ['demande_id' => $demande->id, 'id' => (auth()->user()->role == 1) ? $demande->user_id : $demande->annonces->product->id]) }}" class="truncate text-red-500 mt-2">Give us your feedback</a> 
                    {{-- <a href="{{ route('feedback.details', ['demande_id' => $demande->id, 'id' => (auth()->user()->role == 1) ? $demande->user_id : $demande->annonces->id]) }}"> --}}

                    {{-- {{route('product.details',['slug'=>$annonce->slug])}} --}}
                </div>
            </div>
        </div>
        @empty
        <div class="py-2">
            <p class="uppercase text-red-500 text-center"> Nothing to feedback</p>
        </div>
        @endforelse
    
    </div>
</div>