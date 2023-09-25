<x-navbarAdmin>
    
</x-navbarAdmin>
<div>
    <br> <br>
    <div class="container mt-5">
        <div class="col-md-12 search-table-col">
            <div class="table-responsive table table-hover table-bordered results">
                <br>
                <button type="submit" class="ml-auto mr-auto flex items-center justify-center p-2 bg-blue-500 rounded-md hover:bg-blue-600 transition-colors duration-300 ease-in-out" onclick="showPopup(event)">
                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg> add
                </button>    
        <table id="categories-table" class='table table-hover table-bordered'>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Product Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Categ as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td><button onclick="showImage('{{ asset("storage/" . $category->image) }}')"
                            class="btn btn-primary">Voir Image</button>
                        {{-- <td><img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->image }}"></td> --}}
                        <td>{{ $category->products_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            </div>
        </div>
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categories-table').DataTable();
        });
    </script> --}}
    {{-- @foreach ($Categ as $category)
    {{$category->name}}   {{$category->products_count}}  <hr>
    @endforeach --}}
</div>
{{-- Start Ajouter Object  --}}
<div id="popup" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden z-50">
    <div class="absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="bg-white rounded-lg z-50 overflow-y-auto">
        <div class="p-4">
            <h2 class="text-2xl font-bold mb-4">Add Object :</h2>
            <form action="/addCategory" method="POST" enctype= "multipart/form-data"> 
                @csrf
                <div class="flex flex-col mb-2">
                    <label class="font-medium text-sm text-gray-700 mb-1">Title</label>
                    <div class="relative focus-within:text-gray-600 text-gray-400">
                    <input type="text" name="name" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" value = "{{ old('title') }}">
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    </div>
                </div>
                <div class="flex flex-col mb-2">
                    <label class="font-medium text-sm text-gray-700 mb-1">Image</label>
                    <div class="relative focus-within:text-gray-600 text-gray-400">
                    <input type="file" name="image" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                    @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" id="reserve-button" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mr-2">Update</button>
                <button type="button" onclick="hidePopup()" class="bg-gray-400 text-white font-bold py-2 px-4 rounded">Close</button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="{{ asset('assets/js/annonce.js') }}"></script> 
{{--End Ajouter Object  --}}
<script>
    function showImage(imagePath) {
        var modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.zIndex = '1';
        modal.style.left = '0';
        modal.style.top = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.overflow = 'auto';
        modal.style.backgroundColor = 'rgba(0,0,0,0.9)';
        modal.onclick = function() {
            modal.remove();
        };
        var img = document.createElement('img');
        img.src = imagePath;
        img.style.position = 'absolute';
        img.style.top = '50%';
        img.style.left = '50%';
        img.style.transform = 'translate(-50%, -50%)';
        img.style.maxWidth = '90%';
        img.style.maxHeight = '90%';
        img.onclick = function(event) {
            event.stopPropagation();
        };
        modal.appendChild(img);
        document.body.appendChild(modal);
    }
</script>
