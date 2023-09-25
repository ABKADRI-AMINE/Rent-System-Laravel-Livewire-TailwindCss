<x-app-layout>
    <div class="mt-14 pt-5 bg-white">
        <div class="flex flex-col">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow">
                <table id="example" class="w-full whitespace-nowrap mb-4" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                    <thead>
                        <tr class="h-14 text-sm leading-none text-gray-800 bg-gray-100 hover:bg-gray-100">
                            <th data-priority="1" class="font-normal text-left pl-6">Object</th>
                            <th data-priority="2" class="font-normal text-left pl-12">Category</th>
                            <th data-priority="3" class="text-left">description</th>
                            <th data-priority="4" class="text-left">created at</th>
                            <th data-priority="5" class="text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-900">
                        @foreach ($products as $product)
                            <tr class="hover:bg-red-300 hover:bg-opacity-50 border-gray-300 py-4">
                                <td class="flex justify-start items-center w-32">
                                    <div class="flex-shrink-0 m-2">
                                        <span class="title_para w-64 px-2">{{ $product['title'] }}</span>
                                    </div>
                                </td>
                                <td class="text-left w-64"><span class="title_para w-64 px-2">{{ $product->Category['name'] }}</span></td>
                                <td class="text-left">{{ $product['description'] }}</td>
                                <td class="text-left">{{ $product['created_at'] }}</td>
                                <td class="text-left">
                                    <div class="flex justify-between">
                                        <form method="POST" action="/listeObject/{{$product['id']}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md">
                                                delete
                                            </button>
                                        </form>
                                        <a href="/listeObject/{{$product->id}}/modifierObjet">
                                            <button type="submit" class="flex items-center justify-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                                                Edit
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
                            <label class="font-medium text-sm text-gray-700 mb-1">Categorie</label>
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
</x-app-layout>