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
                <p class="font-semibold text-[24px]">Step 6. Enabling Environment Activities
                </p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                <p class="font-semibold text-md text-blue-600">Instructions</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <p>1) Ask participants what barriers related to the enabling environment contribute to the indicators selected. Then identify platforms and how they can strengthen the platforms to help overcome the barriers.
                </p>
                <p class="mb-2">2) Once participants have identified activities for everyone in their district, consider how they might change for vulnerable populations. Given the year 1 implementation duration of 4-6 months, try to limit the number of activities to 5-7 for this IR.
                </p>
            </div>
        </div>
        <div class="flex gap-4">
            <!-- Province Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>

                    <p class="font-semibold text-md  ml-4">
                        <span class="text-blue-600"> Province: </span>
                        <span class="text-black">{{ $districtprofile->province->province }}</span>
                    </p>
                </div>
            </div>
            <!-- District Section -->
            <div class="bg-white p-4 mb-4 rounded-lg border border-[#D8DAE5] flex-1">
                <div class="flex items-center mb-4">
                    <p class="h-12 w-12 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">02</p>
                    <p class="font-semibold text-md  ml-4">
                        <span class="text-blue-600"> District: </span>
                        <span class="text-black">{{ $districtprofile->district }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg w-full mb-5 ">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">04</p>
                <p class="font-semibold text-md text-blue-600">District profile</p>
            </div>
            <div class="flex flex-wrap -mx-2">
                <!-- Column 1 -->
                <div class="w-1/3 px-2 mb-6">
                    <label for="municipality-count"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of
                        Municipality</label>
                    <input type="text" id="municipality-count" value="{{ count($districtprofile->locallevel) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" required="">
                </div>

                <!-- Column 2 -->
                <div class="w-1/3 px-2 mb-6">
                    <label for="vulnerable-municipality-count"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of Vulnerable
                        Municipality</label>
                    <input id="vulnerable-municipality-count" type="number"
                        value="{{ $districtprofile->vulnerable_municipality }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" required="">
                </div>

                <!-- Column 3  -->
                <div class="w-1/3 px-2 mb-6">
                    <label for="Ecological Zone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ecological Zone</label>
                    <input id="Ecological Zone" type="text" value="{{ $districtprofile->ecological_zone }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" required="">
                </div>

            </div>


            <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                <thead class="rounded-lg">

                    <tr>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                            style="line-height: 1.2;">
                            Municipality
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                            style="line-height: 1.2;">
                            Remote
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                            style="line-height: 1.2;">
                            Caste/Ethnicity
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                            style="line-height: 1.2;">
                            Geography (municipalities)
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                            style="line-height: 1.2;">
                            Food insecurity
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                            style="line-height: 1.2;">
                            Wealth
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                            style="line-height: 1.2;">
                            Climatic Change
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top"
                            style="line-height: 1.2;">
                            Remark
                        </th>

                    </tr>
                </thead>
                <tbody class="rounded-lg" id="priority-table-body">

                    @foreach ($districtVulnerability as $data)
                    <tr>
                        <td class="p-2 text-sm">
                            {{ $data->locallevel->lgname }}
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                value="1" {{ $data->remote_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                value="1" {{ $data->caste_ethnicity_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                value="1" {{ $data->geography_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                value="1" {{ $data->food_security_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                value="1" {{ $data->wealth_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                value="1" {{ $data->climatic_change_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $data->remarks }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form action="{{ route('prioritizedActivities.index') }}" method="post">
            @csrf
            <input type="number" name="province_id" value="{{ $districtprofile->province->id }}" hidden>
            <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
            <input type="number" name="stage_id" value="6" hidden>


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


                <div class="border border-gray-200 rounded-lg p-4 mb-4">

                    <div id="activities-container" class="space-y-4">
                        <!-- Initial activity section -->
                        <div class="activity-section border border-gray-300 rounded-lg p-4 bg-gray-50">
                            <div class="flex items-center gap-4 mb-2">
                                <div class="flex flex-col w-full">
                                    <label class="text-sm font-medium text-gray-700">Activity Details</label>
                                    <textarea name="proposed_activities[]" rows="3"
                                        class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Write your activity details here..."></textarea>
                                </div>

                                <div class="flex flex-col w-1/3">
                                    <label class="text-sm font-medium text-gray-700">Targetted For</label>
                                    <select name="targeted_for[]"
                                        class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                                        <option value="all">All</option>
                                        <option value="vulnerable">Vulnerable</option>
                                    </select>
                                </div>

                                <div class="flex flex-col w-1/3">
                                    <label class="text-sm font-medium text-gray-700">Platform</label>
                                    <select name="platforms_id[]"
                                        class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                                        <option value="">Select</option>
                                        @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}">{{ $platform->platforms }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex flex-col w-full">
                                    <label class="text-sm font-medium text-gray-700">Notes</label>
                                    <textarea name="remarks[]" rows="3"
                                        class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Write your notes here..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

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
        function addActivity() {
            // Get the container where activities will be added
            const container = document.getElementById('activities-container');

            // Create a new activity section
            const newActivity = document.createElement('div');
            newActivity.classList.add('activity-section', 'border', 'border-gray-300', 'rounded-lg', 'p-4', 'bg-gray-50');

            // Set the inner HTML for the new activity section
            newActivity.innerHTML = `
        <div class="flex items-center gap-4 mb-2">
            <div class="flex flex-col w-full">
                <label class="text-sm font-medium text-gray-700">Activity Details</label>
                <textarea name="proposed_activities[]" rows="3"
                    class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write your activity details here..."></textarea>
            </div>

            <div class="flex flex-col w-1/3">
                <label class="text-sm font-medium text-gray-700">Targetted For</label>
                <select name="targeted_for[]"
                    class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                    <option value="all">All</option>
                    <option value="vulnerable">Vulnerable</option>
                </select>
            </div>

            <div class="flex flex-col w-1/3">
                <label class="text-sm font-medium text-gray-700">Platform</label>
                <select name="platforms_id[]"
                    class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                    <option value="">Select</option>
                    @foreach ($platforms as $platform)
                    <option value="{{ $platform->id }}">{{ $platform->platforms }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col w-full">
                <label class="text-sm font-medium text-gray-700">Notes</label>
                <textarea name="remarks[]" rows="3"
                    class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write your notes here..."></textarea>
            </div>

            <!-- Remove button for the new section -->
            <button type="button" class="remove-activity bg-red-500 text-white p-2 rounded flex items-center justify-center mt-2" onclick="removeActivity(this)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Remove</span>
            </button>
        </div>
    `;

            // Append the new activity section to the container
            container.appendChild(newActivity);
        }

        function removeActivity(button) {
            // Remove the parent activity section
            const activitySection = button.closest('.activity-section');
            if (activitySection) {
                activitySection.remove();
            }
        }
    </script>








</x-app-layout>