<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Step Header -->
        <div class="mb-8 rounded-lg w-full mb-5">
            <div class="flex items-center gap-4 text-2xl">
                <!-- First Arrow -->
                <div class="border bg-white p-2 rounded-full ml-2">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
                    </svg>
                </div>
                <!-- Step Description -->
                <p class="font-semibold text-[24px]">Step 6. Enabling Environment Activities (IR4)</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                <p class="font-semibold text-md text-blue-600">Instructions</p>
            </div>
            <div class="space-y-2 text-base italic">
                <p>1) Ask participants what barriers related to the enabling environment contribute to the indicators selected. Then identify platforms and how they can strengthen the platforms to help overcome the barriers.</p>
                <p class="mb-2">2) Once participants have identified activities for everyone in their district, consider how they might change for vulnerable populations. Given the year 1 implementation duration of 4-6 months, try to limit the number of activities to 5-7 for this IR.</p>
            </div>
        </div>

        <x-district-profile-card :districtprofile="$districtprofile" :districtVulnerability="$districtVulnerability" />

        <form action="{{ route('prioritizedActivities.index') }}" method="post">
            @csrf
            <input type="number" name="province_id" value="{{ $districtprofile->province->id }}" hidden>
            <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
            <input type="number" name="stage_id" value="6" hidden>

            <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05</p>
                    <p class="font-semibold text-md text-blue-600">Key Barriers</p>
                </div>
                <textarea id="key_barriers" required name="key_barriers" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Write your notes here..."></textarea>
            </div>

            <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">06</p>
                    <p class="font-semibold text-md text-blue-600">Activities</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 mb-4">
                    <div id="activities-container" class="space-y-4"></div>
                    <!-- Button to add more activity sections -->
                    <button type="button" class="mt-2 bg-blue-500 text-white p-2 rounded flex items-center gap-2" onclick="addActivity()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="sr-only">Add More</span>
                    </button>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">07</p>
                    <p class="font-semibold text-md text-blue-600">Notes</p>
                </div>
                <textarea id="notes" required name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" placeholder="Write your notes here..."></textarea>
            </div>

            <button type="submit" class="mt-4 p-2 bg-green-500 text-white rounded">Submit</button>
        </form>
    </div>

    <script>
        // Ensure correct JSON encoding and format
        const platformsOptions = @json($platforms->map(function($platform) {
            return ['id' => $platform->id, 'name' => $platform->platforms];
        }));
    
        function addActivity() {
            const container = document.getElementById('activities-container');
            const activityCount = container.children.length + 1;
            
            let platformOptionsHtml = '<option value="">Select</option>';
            platformsOptions.forEach(platform => {
                platformOptionsHtml += `<option value="${platform.id}">${platform.name}</option>`;
            });
    
            const activityDiv = document.createElement('div');
            activityDiv.className = 'border border-gray-300 rounded-lg p-4 bg-gray-50 mb-4';
            activityDiv.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                    <!-- First Row: Activities and Platform -->
                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700">Activities</label>
                        <select name="activity_id[]" class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                            <option value="">Select Activities</option>  
                            @foreach ($activities as $activity) 
                                <option value="{{ $activity->id }}">{{ $activity->activities }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700">Platform</label>
                        <select multiple name="platforms_id[${activityCount}][]" class="bg-white border border-gray-300 rounded-lg p-2 multipleselect text-sm w-full">
                            ${platformOptionsHtml}
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Second Row: Targetted For and Remarks -->
                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700">Targetted For</label>
                        <select name="targeted_for[]" class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                            <option value="all">All</option>
                            <option value="vulnerable">Vulnerable</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700">Remarks</label>
                        <textarea name="remarks[]" rows="1" class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300" placeholder="Write your notes here..."></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center mt-2">
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeActivity(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="sr-only">Remove Activity</span>
                    </button>
                </div>
            `;
             $(container.appendChild(activityDiv)).find('.multipleselect').select2();
        }
    
        function removeActivity(button) {
            button.closest('div').remove();
        }
    </script>
    
    
</x-app-layout>
