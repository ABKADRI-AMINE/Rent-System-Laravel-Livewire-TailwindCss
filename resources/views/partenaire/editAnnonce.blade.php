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
    <title>Ajouter Annonce</title>
</head>
<body>
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto w-510">
          <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
              <div class="flex items-center space-x-5">
                <div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">i</div>
                <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                  <h2 class="leading-relaxed">Post announcement</h2>
                  <p class="text-sm text-gray-500 font-normal leading-relaxed">add an announcement for your item</p>
                </div>
              </div>
              <form action="/mesAnnonce/{{ $annonce->id }}" method = "POST">
                @csrf
                @method('PUT')
                <div class="divide-y divide-gray-200">
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        @livewire('objects') 
                    ou : <a href="{{ route('object.add') }}" class="text-blue-500 hover:text-blue-700 font-bold">Add an item</a>
                    <div class="flex flex-col">
                        <label class="font-medium text-sm text-gray-700 mb-1">City</label>
                        <div class="relative focus-within:text-gray-600 text-gray-400">
                        <input type="text" name="ville" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" value="{{ $annonce->city }}">
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex flex-col">
                        <label class="font-medium text-sm text-gray-700 mb-1">Min days</label>
                        <div class="relative focus-within:text-gray-600 text-gray-400">
                            <input type="number" name="jours_min" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" value="{{ $annonce->minday }}">
                        </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-medium text-sm text-gray-700 mb-1">Price per day</label>
                            <div class="relative focus-within:text-gray-600 text-gray-400">
                                <input type="number" name="price" class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="prix en DH" value="{{ $annonce->regular_price }}">
                            </div>
                        </div>
                    </div>
                    <label class="font-medium text-sm text-gray-700 mb-1">Availability date</label>
                        <div date-rangepicker class="flex items-center">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input name="date_debut" id="start_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" value="{{ $annonce->from }}">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input name="date_fin" id="end_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" value="{{ $annonce->to }}">
                            </div>
                        </div>              
                        {{-- start annonce particuliere --}}
    
                        <div class="mt-4 inline-flex items-center">
                            <label for="particuliere" class="font-medium text-sm text-gray-700">Particular</label>
                            <input type="checkbox" name="particuliere" id="particuliere" class="ml-2">
                        </div>
                        <div class="mt-4" id="days-of-week-container" style="display:none">
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
                        
                        {{-- end annonce particuliere --}}
                    </div>
                    <div class="pt-4 flex items-center space-x-4">
                        <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Update</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      @livewireScripts

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Moment.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

      <script>
        $(document).ready(function() {
        // Show/hide the days of the week selector based on the "particuliere" checkbox
        $('#particuliere').change(function() {
            if ($(this).is(':checked')) {
                $('#days-of-week-container').show();
                generateDaysOfWeek();
            } else {
                $('#days-of-week-container').hide();
            }
        });
        });
        // Generate a list of days of the week that

        function generateDaysOfWeek() {
    
    // Get the start and end dates from the form
    var startDate = moment($('#start_date').val());
    var endDate = moment($('#end_date').val());

    // Generate a list of all the days of the week that fall within the interval
    var daysOfWeek = [];
    while (startDate.isSameOrBefore(endDate)) {
        var dayOfWeek = startDate.format('dddd').toLowerCase();
        daysOfWeek.push(dayOfWeek);
        startDate.add(1, 'days');
    }
    
    // Check the checkboxes for the days of the week that fall within the interval
    $.each(daysOfWeek, function(index, dayOfWeek) {
        $('#' + dayOfWeek).prop('checked', true);
    });
};
      </script>
</body>
</html>
