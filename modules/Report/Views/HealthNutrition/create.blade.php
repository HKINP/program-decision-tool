<x-app-layout>
    <div class="px-4  sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="mb-8 rounded-lg w-full mb-5">
            <div class="flex items-center gap-4 text-2xl ">
                <!-- First Arrow -->
                <div class="border bg-white p-2 rounded-full ml-2">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
                    </svg>
                </div>

                <!-- Step Description -->
                <p class="font-semibold text-[24px]">Step 4. Health and Nutrition Service Activities</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                <p class="font-semibold text-md text-blue-600">Instructions</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <p>1) Ask participants what health systems-level barriers contribute to the indicators selected. Then identify platforms and how they can strengthen the platforms to help overcome the barriers.


                </p>
                <p class="mb-2">2) Once participants have identified activities for everyone in their district, 
                    consider how they might change for vulnerable populations. Given the year 1 implementation 
                    duration of 4-6 months, try to limit the number of activities to 5-7 for this IR. Select management-level activities as necessary.
                </p>
            </div>
        </div>
       
        <x-district-profile-card :districtprofile="$districtprofile" :districtVulnerability="$districtVulnerability" />

        <form action="{{ route('prioritizedActivities.index') }}" method="post">
            @csrf
            <input type="number" name="province_id" value="{{ $districtprofile->province->id }}" hidden>
            <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
            <input type="number" name="stage_id" value="4" hidden>

            <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05
                    </p>
                    <p class="font-semibold text-md text-blue-600">Key Barriers</p>
                </div>

                <div class="space-y-2 text-xs italic">
                    <textarea id="key_barriers" name="key_barriers" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your notes here..."></textarea>

                </div>
            </div>

            <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">06
                    </p>
                    <p class="font-semibold text-md text-blue-600">Activities</p>
                </div>

                @foreach ($priorities as $index =>$question)
                <div class="border border-gray-200 rounded-lg p-4 mb-4">
                    
                    <h2 class="text-md text-blue-600 font-semibold mb-2">{{$index+1}}. {{ $question->question->question }}</h2>

                    <div class="mb-4 flex items-center gap-4">
                        <input type="number" name="target_group_id" value="{{ $question->target_group_id }}"
                            hidden>
                        <p class="text-sm font-semibold text-gray-600">Target Group: <span
                                class="font-normal">{{ $question->targetGroup->target_group }}</span></p>
                        <p class="text-sm font-semibold text-gray-600">Thematic Area: <span
                                class="font-normal">{{ $question->thematicArea->thematic_area }}</span></p>
                        <input type="number" name="thematic_area_id" value="{{ $question->thematic_area_id }}"
                            hidden>
                    </div>

                    <div id="activities-container-{{ $question->question_id }}" class="space-y-4">
                        
                    </div>


                    <button type="button" class="mt-2 bg-blue-500 text-white p-2 rounded flex items-center gap-2"
                        onclick="addActivity({{$question->question_id }})">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="sr-only">Add More</span>
                    </button>
                </div>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg w-full mb-5">
                <div class="flex gap-2 items-center mb-4">
                    <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">07
                    </p>
                    <p class="font-semibold text-md text-blue-600">Notes</p>
                </div>

                <div class="space-y-2 text-xs italic">
                    <textarea id="notes" name="notes" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your notes here..."></textarea>
                </div>
            </div>
       
            <button type="submit" class="mt-4 p-2 bg-green-500 text-white rounded">Submit</button>
        </form>
    </div>
    <script>
        function addActivity(questionId) {
            
            const container = document.getElementById(`activities-container-${questionId}`);
            const activityCount = container.children.length + 1;

            const activityDiv = document.createElement('div');
            activityDiv.className = 'border border-gray-300 rounded-lg p-4 bg-gray-50';
            activityDiv.innerHTML = ` 
        <div class="grid grid-cols-1 gap-4 mb-2">
            <!-- Activity Details in one row -->
            <div class="flex flex-col w-full">
                <label for="activity-text-${questionId}-${activityCount}" class="text-sm font-medium text-gray-700">Activity Details</label>
                <textarea id="activity-text-${questionId}-${activityCount}" name="proposed_activities[]" rows="3"
                    class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write your activity details here..."></textarea>
            </div>
<input type="number" name="indicator_id[]" value="${questionId}" hidden>
            <!-- Other fields in a separate row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div class="flex flex-col w-full">
                    <label for="targetted-for-option-${questionId}-${activityCount}" class="text-sm font-medium text-gray-700">Targetted For</label>
                    <select id="targetted-for-option-${questionId}-${activityCount}" name="targeted_for[]"
                        class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                        <option value="all">All</option>
                        <option value="vulnerable">Vulnerable</option>
                    </select>
                </div>

                <div class="flex flex-col w-full">
                    <label for="platform-option-${questionId}-${activityCount}" class="text-sm font-medium text-gray-700">Platform</label>
                    <select id="platform-option-${questionId}-${activityCount}" multiple name="platforms_id[${questionId}-${activityCount}][]"
                        class="bg-white border border-gray-300 multipleselect rounded-lg p-2 text-sm w-full">
                        <option value="">Select</option>
                        @foreach ($platforms as $platform)
                        <option value="{{ $platform->id }}">{{ $platform->platforms }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col w-full">
                    <label for="notes-text-${questionId}-${activityCount}" class="text-sm font-medium text-gray-700">Remarks</label>
                    <textarea id="notes-text-${questionId}-${activityCount}" name="remarks[]" rows="1"
                        class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your notes here..."></textarea>
                </div>
            </div>

            <!-- Remove Button in right-center -->
            <div class="flex justify-end items-center">
                <button type="button" class="text-red-500 hover:text-red-700" onclick="removeActivity(this)">
                    <!-- Trash Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7H5M9 11v6m6-6v6M5 7h14M4 7h16M4 7l1 13h14L20 7M10 11v6m4-6v6m-8-6v6" />
                    </svg>
                </button>
            </div>

    `;

            $(container.appendChild(activityDiv)).find('.multipleselect').select2();

        }

        function removeActivity(button) {
            button.parentElement.parentElement.parentElement.remove();
        }
    </script>





</x-app-layout>