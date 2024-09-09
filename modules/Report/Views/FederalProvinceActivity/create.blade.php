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
            <h2 class="text-xl font-bold mb-4 px-4 py-2">{{ $prioritizedActivities->proposed_activities }}</h2>
            <form class="p-4" id="updateActivitiesForm" action="{{ route('activityMapping.add') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $prioritizedActivities->id }}" name="id" id="activityId">
                <input type="hidden" name="district_id" value="{{ $districtprofile->id }}">
                
                <!-- Work Plan Activity -->
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700">Work Plan Activity</label>
                    <select id="activitiesSelect" name="activity_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option>Select</option>
                        @foreach ($activities as $mactivity)
                        <option value="{{ $mactivity->id }}" 
                            @if($mactivity->id == $prioritizedActivities->activity_id) selected @endif>
                            {{ $mactivity->activities }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Select Year -->
                <div class="mb-4">
                    <label for="year" class="block text-sm font-medium text-gray-700">Select Year</label>
                    <select id="year" name="year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="1" @if($prioritizedActivities->year == "1") selected @endif>Year 1</option>
                        <option value="2" @if($prioritizedActivities->year == "2") selected @endif>Year 2</option>
                        <option value="3" @if($prioritizedActivities->year == "3") selected @endif>Year 3</option>
                        <option value="4" @if($prioritizedActivities->year == "4") selected @endif>Year 4</option>
                        <option value="5" @if($prioritizedActivities->year == "5") selected @endif>Year 5</option>
                    </select>
                </div>
                
                <!-- Select Months -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Select Months</label>
                    <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @php
                            $selectedMonths = json_decode($prioritizedActivities->months, true) ?: [];
                        @endphp
                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <div>
                            <input id="month-{{ strtolower($month) }}" name="months[]" type="checkbox" value="{{ $month }}" 
                                class="mr-2" @if(in_array($month, $selectedMonths)) checked @endif>
                            <label for="month-{{ strtolower($month) }}" class="text-sm">{{ $month }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Total Target -->
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-700">Total Target</label>
                    <input type="text" name="total_target" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                        value="{{ $prioritizedActivities->total_target }}">
                </div>
                
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
