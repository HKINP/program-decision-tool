<form action="{{ route('prioritizedActivities.index') }}" method="post">
    @csrf
    <input type="number" name="province_id" value="{{ $districtProfile->province->id }}" hidden>
    <input type="number" name="district_id" value="{{ $districtProfile->id }}" hidden>
    <input type="number" name="stage_id" value="{{ $stageId }}" hidden>

    <div class="bg-white p-4 rounded-lg w-full mb-5">
        <div class="flex gap-2 items-center mb-4">
            <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05</p>
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
            <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">06</p>
            <p class="font-semibold text-md text-blue-600">Activities</p>
        </div>

        @foreach ($priorities as $index => $question)
        <div class="border border-gray-200 rounded-lg p-4 mb-4">
            <h2 class="text-md text-blue-600 font-semibold mb-2">{{ $index + 1 }}. {{ $question->question->question }}</h2>
            <div class="mb-4 flex items-center gap-4">
                <input type="number" name="target_group_id" value="{{ $question->target_group_id }}" hidden>
                <p class="text-sm font-semibold text-gray-600">Target Group: <span class="font-normal">{{ $question->targetGroup->target_group }}</span></p>
                <p class="text-sm font-semibold text-gray-600">Thematic Area: <span class="font-normal">{{ $question->thematicArea->thematic_area }}</span></p>
                <input type="number" name="thematic_area_id" value="{{ $question->thematic_area_id }}" hidden>
            </div>
            <div id="activities-container-{{ $question->question_id }}" class="space-y-4"></div>
            <button type="button" class="mt-2 bg-blue-500 text-white p-2 rounded flex items-center gap-2" onclick="addActivity({{ $question->question_id }})">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="sr-only">Add More</span>
            </button>
        </div>
        @endforeach
    </div>

    <div class="bg-white p-4 rounded-lg w-full mb-5">
        <div class="flex gap-2 items-center mb-4">
            <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">07</p>
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

<script>
    function addActivity(questionId) {
        const container = document.getElementById(`activities-container-${questionId}`);
        const activityCount = container.children.length + 1;

        const platformsOptions = @json($platforms->map(function($platform) {
            return [
                'id' => $platform->id,
                'name' => $platform->platforms
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
                <input type="number" name="indicator_id[]" value="${questionId}" hidden>
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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7H5M9 11v6m6-6v6M5 7h14M4 7h16M4 7l1 13h14L20 7M10 11v6m4-6v6m-8-6v6" />
                        </svg>
                    </button>
                </div>
            </div>
        `;

        $(container.appendChild(activityDiv)).find('.multipleselect').select2();
    }

    function removeActivity(button) {
        button.parentElement.parentElement.parentElement.remove();
    }
</script>
