<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto print-container">
        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">District Compiled Report</h2>
        </div>

        <div class="flex gap-4">
            <!-- Province Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                    <p class="font-semibold text-md ml-4">
                        <span class="text-blue-600">Province:</span>
                        <span class="text-black">{{ $districtprofile->province->province }}</span>
                    </p>
                </div>
            </div>
            <!-- District Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">02</p>
                    <p class="font-semibold text-md ml-4">
                        <span class="text-blue-600">District:</span>
                        <span class="text-black">{{ $districtprofile->district }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4 no-print">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">03</p>
                <h2 class="text-xl font-bold mb-4 px-4 py-2">Activity Mapping</h2>
            </div>
            <h2 class="text-xl font-bold mb-4 px-4 py-2">{{$prioritizedActivities->proposed_activities}}</h2>
            <form class="p-4" id="updateActivitiesForm" action="{{ route('activityMapping.add') }}"
                method="POST">
                @csrf
                <input type="hidden" value="{{ $prioritizedActivities->id }}" name="id" id="activityId">
                <input type="hidden" name="district_id" value="{{ $districtprofile->id }}">
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700">Work Plan Activity</label>
                    <select id="activitiesSelect" name="activity_id"
                        class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Select</option>
                        @foreach ($activities as $mactivity)
                        <option value="{{ $mactivity->id }}" class="w-1/2 max-w-1/2"
                            data-ir-id="{{ $mactivity->ir_id }}">
                            {{ $mactivity->activities }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="year" class="block text-sm font-medium text-gray-700">Select Year</label>
                    <select id="year" name="year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <!-- Year Options -->
                        <option selected value="1">Year 1</option>
                        <option value="2">Year 2</option>
                        <option value="3">Year 3</option>
                        <option value="4">Year 4</option>
                        <option value="5">Year 5</option>
                        <!-- Add more years as needed -->
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Select Months</label>
                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div>
                            <input id="month-jan"  name="months[]"  type="checkbox" value="January" class="mr-2">
                            <label for="month-jan" class="text-sm">January</label>
                        </div>
                        <div>
                            <input id="month-feb" name="months[]"  type="checkbox" value="February" class="mr-2">
                            <label for="month-feb" class="text-sm">February</label>
                        </div>
                        <div>
                            <input id="month-mar" name="months[]"  type="checkbox" value="March" class="mr-2">
                            <label for="month-mar" class="text-sm">March</label>
                        </div>
                        <div>
                            <input id="month-apr" name="months[]"  type="checkbox" value="April" class="mr-2">
                            <label for="month-apr" class="text-sm">April</label>
                        </div>
                        <div>
                            <input id="month-may" name="months[]"  type="checkbox" value="May" class="mr-2">
                            <label for="month-may" class="text-sm">May</label>
                        </div>
                        <div>
                            <input id="month-jun" name="months[]"  type="checkbox" value="June" class="mr-2">
                            <label for="month-jun" class="text-sm">June</label>
                        </div>
                        <div>
                            <input id="month-jul" name="months[]"  type="checkbox" value="July" class="mr-2">
                            <label for="month-jul" class="text-sm">July</label>
                        </div>
                        <div>
                            <input id="month-aug" name="months[]"  type="checkbox" value="August" class="mr-2">
                            <label for="month-aug" class="text-sm">August</label>
                        </div>
                        <div>
                            <input id="month-sep" name="months[]"  type="checkbox" value="September" class="mr-2">
                            <label for="month-sep" class="text-sm">September</label>
                        </div>
                        <div>
                            <input id="month-oct" name="months[]"  type="checkbox" value="October" class="mr-2">
                            <label for="month-oct" class="text-sm">October</label>
                        </div>
                        <div>
                            <input id="month-nov" name="months[]"  type="checkbox" value="November" class="mr-2">
                            <label for="month-nov" class="text-sm">November</label>
                        </div>
                        <div>
                            <input id="month-dec" name="months[]"  type="checkbox" value="December" class="mr-2">
                            <label for="month-dec" class="text-sm">December</label>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700">Total Target</label>
                    <input type="text" name="total_target" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                <button type="button" id="closeModal"
                    class="ml-2 bg-red-500 text-white px-4 py-2 rounded">Close</button>
            </form>

        </div>
    </div>
   </x-app-layout>
0