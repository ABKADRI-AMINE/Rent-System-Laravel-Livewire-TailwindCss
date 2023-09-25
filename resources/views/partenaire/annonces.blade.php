<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.ico" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
            @livewireStyles
    <title>Mes Annonce</title>
</head>

<body class="antialiased bg-gray-200 text-gray-900 font-sans p-6">
  {{-- search --}}
  <form action="">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i
                class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
            ></i>
        </div>
        <input
            type="text"
            name="search"
            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
            placeholder="Chercher annonce"
        />
        <div class="absolute top-2 right-2">
            <button
                type="submit"
                class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">
                Search
            </button>
        </div>
    </div>
</form>
  {{-- end search  --}}
  <div class="container mx-auto">
    <div class="flex flex-wrap -mx-3">
      @foreach ($annonces as $annonce)
      <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
        <a href="/mesAnnonces/{{$annonce->id}}" class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-48 overflow-hidden">
          @if (count($annonce->product->image) > 0)
          <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('storage/'.$annonce->product->image[0]->imageName) }}" alt="test">
          @else
          <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('assets/imgs/login.png') }}" alt="Default Image">
        @endif        </div>
        <div class="p-4">
          <span class="inline-block px-2 py-1 leading-none {{ $annonce->stat == 1 ? 'bg-green-200 text-green-800' : ($annonce->stat == 0 ? 'bg-orange-200 text-orange-800': 'bg-yellow-200 text-orange-800') }} rounded-full font-semibold uppercase tracking-wide text-xs">{{ $annonce->stat == 1 ? "En ligne" : ($annonce->stat == 0 ? "Offline" : "En attente") }}</span>
          <h2 class="mt-2 mb-2  font-bold">{{ $annonce->product->title }}</h2>
          <p class="text-sm">{{ $annonce->product->description }}</p>
          <div class="mt-3 flex items-center">
            <span class="text-sm font-semibold">Price per day</span>&nbsp;<span class="font-bold text-xl">{{ $annonce->regular_price }}</span>DH<span class="text-sm font-semibold"></span>
          </div>
        </div>
        <div class="p-4 border-t border-b text-xs text-gray-700">
          <span class="flex items-center mb-1">
            <i class="far fa-clock fa-fw mr-2 text-gray-900"></i>{{ $annonce->updated_at }}
          </span>
        </div>
        </a>
    </div>        
      @endforeach
  </div>
</body>

</html>