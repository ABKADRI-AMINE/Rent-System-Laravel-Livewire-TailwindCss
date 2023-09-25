<x-app-layout>
    <body>
      <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
          @if(session()->has('message'))
          <p class="text-red-500 text-xs mt-1"> {{session('message')}}</p>
          @endif
          <div class="relative py-3 sm:max-w-xl sm:mx-auto w-510">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
              <div class="max-w-md mx-auto">
                <div class="flex items-center space-x-5">
                  <div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">i</div>
                  <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                    <h2 class="leading-relaxed">Post announcement</h2>
                    <p class="text-sm text-gray-500 font-normal leading-relaxed">Add announcement for your item</p>
                  </div>
                </div>
                <form id="myForm" action="/addAnnonce" method="POST">
                  @csrf
                  <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                          @livewire('objects')
                      <div class="flex flex-col">
                          <label class="font-medium text-sm text-gray-700 mb-1">City</label>
                          <div class="relative focus-within:text-gray-600 text-gray-400">
                          <input type="text" name="ville" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" >
                          </div>
                      </div>
                      <div class="flex items-center space-x-4">
                          <div class="flex flex-col">
                          <label class="font-medium text-sm text-gray-700 mb-1">Min days</label>
                          <div class="relative focus-within:text-gray-600 text-gray-400">
                              <input type="number" id="min-days" name="jours_min" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" min="1">
                          </div>
                          </div>
                          <div class="flex flex-col">
                              <label class="font-medium text-sm text-gray-700 mb-1">Price per day</label>
                              <div class="relative focus-within:text-gray-600 text-gray-400">
                                  <input type="number" name="price" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="prix en DH" min="0">
                              </div>
                          </div>
                        </div>
                      <label class="font-medium text-sm text-gray-700 mb-1">Availability date</label>
                          <div date-rangepicker class="flex items-center">
                              <div class="relative">
                                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    {{-- <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg> --}}
                                  </div>
                                  <input name="date_debut" id="start-date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" onchange="validateDateRange()">
                              </div>
                              <span class="mx-4 text-gray-500">to</span>
                              <div class="relative">
                                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                      {{-- <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg> --}}
                                    </div>
                                  <input name="date_fin" id="end-date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" onchange="validateDateRange()">
                              </div>
                          </div>              
                          {{-- start annonce particuliere --}}
                          
                          <div class="mt-2 inline-flex items-center">
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
                                  <label for="sunday" class="inline-flex items-center">
                                      <input type="checkbox" name="disponibility[]" id="sunday" value="sunday" class="form-checkbox">
                                      <span class="ml-2 text-sm text-gray-600">Sun</span>
                                  </label>
                              </div>
                            </div>
                          
                          {{-- end annonce particuliere --}}
                      </div>
                      <div class="mt-3 flex items-center space-x-4">
                          <button class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                          <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
                          </button>
                          {{-- <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Post</button> --}}
                          <button type="button" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none" onclick="submitForm()">Share</button>
                        </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @livewireScripts
  
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
                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
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
                        <input type="file" name="images[]" multiple class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>
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
          function submitForm() {
                      $.ajax({
                          type: 'POST',
                          url: '/addAnnonce',
                          data: $('#myForm').serialize(),
                          success: function(response) {
                              // Display success alert
                              Swal.fire({
                                  title: 'Success!',
                                  text: 'The form was submitted successfully.',
                                  icon: 'success'
                              }).then(function() {
                                  window.location.href = '/mesAnnonces'; // replace with the URL of the success page
                                  });
                          },
                          error: function(jqXHR, textStatus, errorThrown) {
                              // Display error alert
                              Swal.fire({
                                  title: 'Error!',
                                  text: 'An error occurred while submitting the form.',
                                  icon: 'error'
                              });
                          }
                      });
                  }
      </script>
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
                    popup.classList.add("hidden");
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
  </body>
  </html>
  
  </x-app-layout>