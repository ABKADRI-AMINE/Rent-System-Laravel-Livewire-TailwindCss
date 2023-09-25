<x-app-layout>
    <div class="mt-14 pt-5 bg-white">
        <div class="flex flex-col">
            <div id="recipients" class="p-8 mt-6 lg:mt-0 rounded shadow overflow-x-auto">
                <table id="example" class="table-auto w-full mb-4">
                    <thead>
                        <tr class="bg-gray-100 text-gray-800 text-sm font-normal h-14">
                            <th class="pl-6">Object</th>
                            <th class="pl-12">Category</th>
                            <th>Description</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-900">
                        @foreach ($products as $product)
                        <tr class="border-b border-gray-300 hover:bg-red-300 hover:bg-opacity-50">
                            <td class="w-32">
                                <div class="flex items-center">
                                    <span class="title-para w-64 px-2">{{ $product['title'] }}</span>
                                </div>
                            </td>
                            <td class="w-64">{{ $product->Category['name'] }}</td>
                            <td>{{ $product['description'] }}</td>
                            <td>{{ $product['created_at'] }}</td>
                            <td>
                                <div class="flex justify-between">
                                    <form method="POST" action="/listeObject/{{$product['id']}}" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md" onclick="deleteProduct(event)">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="/listeObject/{{$product->id}}/modifierObjet">
                                        <button type="submit" class="flex items-center justify-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                                            Modify
                                        </button>
                                    </a>
                                </div>  
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="ml-auto mr-auto flex items-center justify-center p-2 bg-blue-500 rounded-md hover:bg-blue-600 transition-colors duration-300 ease-in-out" onclick="showPopup(event)">
                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>    
        {{-- Start Ajouter Object  --}}
        <div id="popup" class="fixed top-0 left-0 w-full h-full flex items-center justify-center hidden z-50">
            <div class="absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="bg-white rounded-lg z-50 overflow-y-auto">
                <div class="p-4">
                    <h2 class="text-2xl font-bold mb-4">Add Object :</h2>
                    <form id="add-object" action="/addObject" method="POST" enctype= "multipart/form-data"> 
                        @csrf
                        <div class="flex flex-col mb-2">    
                            <label class="font-medium text-sm text-gray-700 mb-1">Category</label>
                            <div class="relative focus-within:text-gray-600 text-gray-400">
                            <select name="category_id" id="categorie" value ="{{ old('categorie_id') }}" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('category_id') == $categorie->id ? 'selected' : '' }}>{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label class="font-medium text-sm text-gray-700 mb-1">Title</label>
                            <div class="relative focus-within:text-gray-600 text-gray-400">
                            <input type="text" name="title" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" value = "{{ old('title') }}">
                            @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label class="font-medium text-sm text-gray-700 mb-1">Description</label>
                            <div class="relative focus-within:text-gray-600 text-gray-400">
                            <textarea name="description" rows="2" class="pr-4 pl-4 pt-2 pb-3 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 resize-none">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label class="font-medium text-sm text-gray-700 mb-1">Images</label>
                            <div class="relative focus-within:text-gray-600 text-gray-400">
                            <input type="file" name="images[]" multiple class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                            @error('images')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="button" onclick="updateObject()" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mr-2">Add</button>
                            <button type="button" onclick="hidePopup()" class="bg-gray-400 text-white font-bold py-2 px-4 rounded">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--End Ajouter Object  --}}
    <script src="{{ asset('assets/js/annonce.js') }}"></script> 
    <script>
        const popup = document.querySelector("#popup") ; 
        function updateObject() {
            // Show SweetAlert loading message
            Swal.fire({
              title: 'Adding Object...',
              text: 'Please wait',
              allowOutsideClick: false,
              showConfirmButton: false,
              onBeforeOpen: () => {
                Swal.showLoading()
              }
            });
          
            // Submit form data using AJAX
            $.ajax({
              url: '/addObject',
              type: 'POST',
              data: new FormData($('#add-object')[0]),
              processData: false,
              contentType: false,
              success: function(response) {
                // Hide SweetAlert and show success message
                Swal.fire({
                  title: 'Object Added',
                  icon: 'success'
                }).then(() => {
                    location.reload();
                });
              },
              error: function(xhr) {
                // Hide SweetAlert and show error message
                Swal.fire({
                  title: 'Error',
                  text: xhr.responseJSON.message,
                  icon: 'error'
                });
              }
            });
          }         
    </script>
    <script>
        function deleteProduct(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            })
        }
    </script>
</x-app-layout>