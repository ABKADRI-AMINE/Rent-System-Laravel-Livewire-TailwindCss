<div>
  {{-- end search  --}}
  <div class="antialiased bg-gray-100 text-gray-900 font-sans p-6">
    <form action="">
      <div class="relative m-4">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i class="fa fa-search text-gray-400"></i>
        </div>
        <input type="text" class="block w-full py-3 pl-10 pr-4 leading-5 rounded-lg bg-white border border-gray-300 placeholder-gray-400 focus:outline-none focus:bg-white focus:shadow-md focus:placeholder-gray-600" placeholder="Search" wire:model="searchTerm">
      </div>
    </form>    
    <div class="flex flex-wrap -mx-3">
      @foreach ($annonces as $annonce)
      <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
        <a href="/mesAnnonces/{{$annonce->id}}" class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
          <div class="relative pb-48 overflow-hidden">
            @if (count($annonce->product->image) > 0)
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('storage/'.$annonce->product->image[0]->imageName) }}" alt="test">
            @else
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('assets/imgs/login.png') }}" alt="Default Image">
            @endif
          </div>
          <div class="p-4">
            <span class="inline-block px-2 py-1 leading-none {{ $annonce->stat == 1 ? 'bg-green-200 text-green-800' : ($annonce->stat == 0 ? 'bg-orange-200 text-orange-800': 'bg-yellow-200 text-orange-800') }} rounded-full font-semibold uppercase tracking-wide text-xs">{{ $annonce->stat == 1 ? "En ligne" : ($annonce->stat == 0 ? "Offline" : "En attente") }}</span>
            <h2 class="mt-2 mb-2 font-bold">{{ $annonce->product->title }}</h2>
            <p class="text-sm">{{ $annonce->product->description }}</p>
            <div class="mt-3 flex items-center">
              <span class="text-sm font-semibold">Prix par jour</span>&nbsp;<span class="font-bold text-xl">{{ $annonce->regular_price }}</span>DH<span class="text-sm font-semibold"></span>
            </div>
          </div>
          <div class="flex justify-between items-center px-4 py-2 bg-gray-100 text-xs text-gray-700">
            <span class="flex items-center mb-1">
              <i class="far fa-clock fa-fw mr-2 text-gray-900"></i>{{ $annonce->updated_at }}
            </span>
            @if ($annonce->stat == 1)
            <form action="/mesAnnonces/{{$annonce->id}}/offline" method="POST" id="make-offline-form">
              @csrf
              @method('PUT')
              <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="confirmOffline(event)">Make Offline</button>
            </form>
            @endif
          </div>
        </a>
      </div>
      @endforeach
    </div>

        {{ $annonces->links() }}
      </div>
      @push('scripts')
        
      <script>
        var makeOfflineForm = document.getElementById('make-offline-form');    
        makeOfflineForm.addEventListener('submit', function(event) {
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once offline, you will not be able to view this annonce in public!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willOffline) => {
                if (willOffline) {
                    axios.put(this.action)
                    .then(function (response) {
                        swal("Success!", "Annonce offline now and an other annonce will be online!", "success")
                        .then((value) => {
                            document.getElementById('make-offline-form').submit();
                        });
                    })
                    .catch(function (error) {
                        swal("Oops!", "Something went wrong. Please try again later.", "error");
                    });
                } else {
                    swal("The annonce is still online!");
                }
            });
        });
    </script>              
      @endpush