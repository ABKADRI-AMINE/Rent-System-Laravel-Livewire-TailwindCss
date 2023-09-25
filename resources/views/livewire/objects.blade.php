<div>
    <div class="flex flex-col">
        <label class="font-medium text-sm text-gray-700 mb-1">Category</label>
        <select wire:model="categorieId" name="category_id" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
            <option value="">Choose category</option>
            @foreach ($categories as $categorie )
                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
            @endforeach
        </select>
    </div>
    <label class="font-medium text-sm text-gray-700 mb-1">Object</label>
    <div class="flex items-center">
        <select wire:model="objectId" name="object_id" class="ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
          <option value="">Choose Object</option>
          @foreach ($objects as $object )
          <option value="{{ $object->id }}">{{ $object->title }}</option>
          @endforeach
        </select>
        <button type="submit" class="ml-2 flex items-center justify-center p-2 bg-blue-500 rounded-md hover:bg-blue-600 transition-colors duration-300 ease-in-out" onclick="showPopup(event)">
            <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
          </button>
    </div>
    {{-- <script src="{{ asset('assets/js/annonce.js') }}"></script>           --}}
</div>
