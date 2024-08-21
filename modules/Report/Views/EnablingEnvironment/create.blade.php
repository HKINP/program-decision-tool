<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Step Header -->
        <div class="mb-8 rounded-lg w-full mb-5">
            <div class="flex items-center gap-4 text-2xl">
                <!-- First Arrow -->
                <div class="border bg-white p-2 rounded-full ml-2">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="24"
                        width="24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z">
                        </path>
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
                <p>1) Ask participants what barriers related to the enabling environment contribute to the indicators
                    selected. Then identify platforms and how they can strengthen the platforms to help overcome the
                    barriers.</p>
                <p class="mb-2">2) Once participants have identified activities for everyone in their district,
                    consider how they might change for vulnerable populations. Given the year 1 implementation duration
                    of 4-6 months, try to limit the number of activities to 5-7 for this IR.</p>
            </div>
        </div>

        <x-district-profile-card :districtprofile="$districtprofile" :districtVulnerability="$districtVulnerability" />
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05</p>
                <p class="font-semibold text-md text-blue-600">Indicators</p>
            </div>

            @foreach ($priorities as $index => $question)
            
                <form action="{{ route('prioritizedActivities.store') }}" method="post">
                    @csrf
                    <input type="number" name="province_id" value="{{ $districtprofile->province->id }}" hidden>
                    <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
                    <input type="number" name="stage_id" value="6" hidden>
                    <input type="number" name="indicator_id" value="{{ $question->indicator_id }}" hidden>
                    <div class="border border-gray-200 rounded-lg p-4 mb-4">
                        <h2 class="text-md text-blue-600 font-semibold mb-2">{{ $index + 1 }}.
                            {{ $question->question }}</h2>
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

                        <div class="mb-4 ">
                            <p class="font-semibold text-md text-black">{{ $index + 1 }}.1 Key Barriers * </p>
                            <textarea id="key_barriers" name="key_barriers" rows="4" required
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your notes here...">{{ $keybarriers->has($question->indicator_id) ? $keybarriers->get($question->indicator_id)->first()->key_barriers : '' }}</textarea>
                            @if ($keybarriers->has($question->indicator_id))
                                <input type="number" name="key_barriers_id"
                                    value="{{ $keybarriers->get($question->indicator_id)->first()->id }}" hidden>
                            @endif
                        </div>
                        <p class="font-semibold text-md text-black mb-4">{{ $index + 1 }}.2 Sub Activities</p>
                        <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                            <thead class="rounded-lg">
                                <tr>
                                    <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">
                                        Activities
                                    </th>
                                    <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Targetted
                                        for
                                    </th>
                                    <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Platforms
                                    </th>
                                    <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Remarks
                                    </th>
                                    <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (isset($subactivities[$question->indicator_id]))
                                    @foreach ($subactivities[$question->indicator_id] as $activity)
                                 
                                        <tr>
                                            <td class="border border-gray-300 p-2 text-sm">
                                                {{ $activity->activity->activities }}
                                            </td>
                                            <td class="border border-gray-300 p-2 text-sm">
                                                {{ $activity->targeted_for }}
                                            </td>
                                            <td class="border border-gray-300 p-2 text-sm">
                                                @foreach ($activity->platforms as $platform)
                                                    <li class="">
                                                        {{ $platform->platforms }}
                                                    </li>
                                                @endforeach
                                            </td>
                                            <td class="border border-gray-300 p-2 text-sm">
                                                {{ $activity->remarks }}
                                            </td>
                                            <td class="border border-gray-300 p-2 text-sm">
                                                <div class="flex space-x-4">

                                                    <!-- <a href="{{ route('activities.edit', $activity->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                                        <i class="fas fa-edit"></i>
                                                    </a> -->
                                                    <button type="button" class="text-red-500 hover:text-red-700"
                                                        onclick="showDeleteModal('{{ route('prioritizedActivities.destroy', $activity->id) }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table><div id="activities-container-{{ $question->id }}" class="space-y-4"></div>
                
                    <div class="flex items-center justify-between mt-4">
                        <!-- Left side: Text -->
                        <p class="italic text-sm hidden font-semibold" id="notessubmit">Submit or update before adding a
                            new
                            activities !!</p>

                        <!-- Right side: Buttons -->
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <button type="submit" class="p-2 bg-green-500 text-white rounded">
                                    @if ($keybarriers->has($question->id))
                                        Update
                                    @else
                                        Submit
                                    @endif
                                </button>
                            </div>

                            <button type="button" class="p-2 bg-blue-500 text-white rounded flex items-center gap-2"
                                onclick="addActivity({{ $question->id }})">
                                Add +
                            </button>
                        </div>
                    </div>

        </div>

        </form>
        @endforeach
    </div>
    <form action="{{ route('stepremarks.add') }}" method="post">
        @csrf
        <input type="number" name="province_id" value="{{ $districtprofile->province->id }}" hidden>
        <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
        <input type="number" name="stage_id" value="6" hidden>
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">06</p>
                <p class="font-semibold text-md text-blue-600">Notes *</p>
            </div>
            <div class="space-y-2 text-xs italic">
                <textarea id="notes" name="notes" rows="4" required
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your notes here...">{{ $stepRemarks->notes ?? '' }}</textarea>
            </div>
            <div class="text-right">

                <button type="submit" class="mt-4 p-2 bg-purple-900 text-white  rounded">Complete this step <i
                        class="text-white fa-md fa-solid fa-arrow-right"></i></button>
            </div>
    </form>
    </div>
    <!-- Delete Modal -->
    <div id="delete-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Delete Sub Activities
                                    <div class="mt-2">
                                        <p class="text-sm leading-5 text-gray-500">
                                            Are you sure you want to delete this sub activity? This action cannot be
                                            undone.
                                        </p>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button type="submit"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Delete
                            </button>
                        </span>
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                            <button type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                onclick="document.getElementById('delete-modal').classList.add('hidden')">
                                Cancel
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    <script>
        function showDeleteModal(deleteRoute) {
            document.getElementById('delete-form').action = deleteRoute;
            document.getElementById('delete-modal').classList.remove('hidden');
        }

         const platformsOptions = @json(
            $platforms->map(function ($platform) {
                return ['id' => $platform->id, 'name' => $platform->platforms];
            }));

        function addActivity(questionId) {
            const container = document.getElementById(`activities-container-${questionId}`);
            const activityCount = container.children.length + 1;
            if (activityCount > 0) {
                document.querySelector('#notessubmit').classList.remove('hidden');
            } else {
                document.querySelector('#notessubmit').classList.add('hidden');
            }

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
                        <select name="activity_id[]" required class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                            <option value="">Select Activities</option>  
                            @foreach ($activities as $activity) 
                                <option value="{{ $activity->id }}">{{ $activity->activities }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm font-medium text-gray-700">Platform</label>
                        <select multiple name="platforms_id[${activityCount}][]" required class="bg-white border border-gray-300 rounded-lg p-2 multipleselect text-sm w-full">
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
            $(container.appendChild(activityDiv)).find('.multipleselect').select2({
                placeholder: 'Select Platforms',
                allowClear: true
            });
        }

       function removeActivity(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
    </div>

</x-app-layout>
