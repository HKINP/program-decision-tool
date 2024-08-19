    <div class="bg-white p-4 rounded-lg w-full mb-5">
        <div class="flex gap-2 items-center mb-4">
            <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05</p>
            <p class="font-semibold text-md text-blue-600">Indicators</p>
        </div>

        @foreach ($priorities as $index => $question)
            <form action="{{ route('prioritizedActivities.store') }}" method="post">
                @csrf
                <input type="number" name="province_id" value="{{ $districtProfile->province->id }}" hidden>
                <input type="number" name="district_id" value="{{ $districtProfile->id }}" hidden>
                <input type="number" name="stage_id" value="{{ $stageId }}" hidden>
                <input type="number" name="indicator_id" value="{{ $question->question_id }}" hidden>
                <div class="border border-gray-200 rounded-lg p-4 mb-4">
                    <h2 class="text-md text-blue-600 font-semibold mb-2">{{ $index + 1 }}.
                        {{ $question->question->question }}</h2>
                    <div class="mb-4 flex items-center gap-4">
                        <input type="number" name="target_group_id" value="{{ $question->target_group_id }}" hidden>
                        <p class="text-sm font-semibold text-gray-600">Target Group: <span
                                class="font-normal">{{ $question->targetGroup->target_group }}</span></p>
                        <p class="text-sm font-semibold text-gray-600">Thematic Area: <span
                                class="font-normal">{{ $question->thematicArea->thematic_area }}</span></p>
                        <input type="number" name="thematic_area_id" value="{{ $question->thematic_area_id }}" hidden>
                    </div>
                  
                    <div class="mb-4 ">
                        <p class="font-semibold text-md text-black">{{ $index + 1 }}.1 Key Barriers </p>
                        <textarea id="key_barriers" name="key_barriers" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your notes here...">{{ $keybarriers->has($question->question_id) ? $keybarriers->get($question->question_id)->first()->key_barriers : '' }}</textarea>
                        @if ($keybarriers->has($question->question_id))
                        <input type="number" name="key_barriers_id" value="{{ $keybarriers->get($question->question_id)->first()->id }}" hidden>
                        @endif
                    </div>
                    <p class="font-semibold text-md text-black mb-4">{{ $index + 1 }}.2 Sub Activities</p>
                    <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                        <thead class="rounded-lg">
                            <tr>
                                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Activities
                                </th>
                                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Targetted for
                                </th>
                                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Platforms
                                </th>
                                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Remarks</th>
                                <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($activities[$question->question_id]))
                                @foreach ($activities[$question->question_id] as $activity)
                             
                                    <tr>
                                        <td class="border border-gray-300 p-2 text-sm">
                                            {{ $activity->proposed_activities }}
                                        </td>
                                        <td class="border border-gray-300 p-2 text-sm">
                                            {{ $activity->targeted_for }}
                                        </td>
                                        <td class="border border-gray-300 p-2 text-sm">
                                            @foreach($activity->platforms as $platform)
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
                                              
                                                <a href="{{ route('activities.edit', $activity->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="text-red-500 hover:text-red-700" onclick="showDeleteModal('{{ route('prioritizedActivities.destroy', $activity->id) }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>


                    
                    <div id="activities-container-{{ $question->question_id }}" class="space-y-4">


                    </div>
                    <button type="button" class="mt-2 bg-blue-500 text-white p-2 rounded flex items-center gap-2"
                        onclick="addActivity({{ $question->question_id }})">
                        Add Activities
                    </button>
                    <div class="text-right">
                       
                        <button type="submit" class="mt-4 p-2 bg-green-500 text-white  rounded"> @if ($keybarriers->has($question->question_id)) Update @else Submit @endif</button>
                    </div>
                </div>

            </form>
        @endforeach
    </div>
    <form action="{{ route('stepremarks.add') }}" method="post">
        @csrf
        <input type="number" name="province_id" value="{{ $districtProfile->province->id }}" hidden>
        <input type="number" name="district_id" value="{{ $districtProfile->id }}" hidden>
        <input type="number" name="stage_id" value="{{ $stageId }}" hidden>
    <div class="bg-white p-4 rounded-lg w-full mb-5">
        <div class="flex gap-2 items-center mb-4">
            <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">06</p>
            <p class="font-semibold text-md text-blue-600">Notes</p>
        </div>

        <div class="space-y-2 text-xs italic">
            <textarea id="notes" name="notes" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Write your notes here..."></textarea>
        </div>
        <div class="text-right">
                       
            <button type="submit" class="mt-4 p-2 bg-purple-900 text-white  rounded">Save Notes and Next  </button>
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Delete Sub Activities
                            <div class="mt-2">
                                <p class="text-sm leading-5 text-gray-500">
                                    Are you sure you want to delete this sub activity? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Delete
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5" onclick="document.getElementById('delete-modal').classList.add('hidden')">
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
        function addActivity(questionId) {
            const container = document.getElementById(`activities-container-${questionId}`);
            const activityCount = container.children.length + 1;

            const platformsOptions = @json(
                $platforms->map(function ($platform) {
                    return [
                        'id' => $platform->id,
                        'name' => $platform->platforms,
                    ];
                }));

            let platformOptionsHtml = '<option value="">Select</option>';
            platformsOptions.forEach(platform => {
                platformOptionsHtml += `<option value="${platform.id}">${platform.name}</option>`;
            });

            const activityDiv = document.createElement('div');
            activityDiv.className = 'border border-gray-300 rounded-lg p-4 bg-gray-50';
            activityDiv.innerHTML = `
            <div class="grid grid-cols-1 gap-4 mb-2">
                <div class="flex flex-col w-full">
                    <label for="activity-text-${questionId}-${activityCount}" class="text-sm font-medium text-gray-700">Activity Details</label>
                    <textarea id="activity-text-${questionId}-${activityCount}" name="proposed_activities[]" rows="3"
                        class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your activity details here..."></textarea>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex flex-col w-full">
                        <label for="targetted-for-option-${questionId}-${activityCount}" class="text-sm font-medium text-gray-700">Targetted For</label>
                        <select id="targetted-for-option-${questionId}-${activityCount}" name="targeted_for[]"
                            class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                            <option value="All">All</option>
                            <option value="Vulnerable">Vulnerable</option>
                        </select>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="platform-option-${questionId}-${activityCount}" class="text-sm font-medium text-gray-700">Platform</label>
                        <select id="platform-option-${questionId}-${activityCount}" required multiple name="platforms_id[${questionId}-${activityCount}][]"
                            class="bg-white border border-gray-300 multipleselect rounded-lg p-2 text-sm w-full">
                            ${platformOptionsHtml}
                        </select>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="notes-text-${questionId}-${activityCount}" class="text-sm font-medium text-gray-700">Remarks</label>
                        <textarea id="notes-text-${questionId}-${activityCount}" name="remarks[]" rows="1"
                            class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Write your notes here..."></textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center">
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeActivity(this)">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        `;

            $(container.appendChild(activityDiv)).find('.multipleselect').select2(
                {
                placeholder: 'Select Platforms',
                allowClear: true
            }
            );


        }

        function removeActivity(button) {
            button.parentElement.parentElement.parentElement.remove();
        }
    </script>
