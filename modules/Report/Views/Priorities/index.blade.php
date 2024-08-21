<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">


        <div class="mt-10">
            <div class="flex justify-between">
                <!-- Step 1 -->
                <div class="w-1/3 text-center pr-6 mb-6">
                    <a href="{{ route('districtvulnerability.index', ['stageId' => 1, 'did' => $districtprofile->id]) }}"
                        class="flex items-center justify-center border border-gray-200 transition duration-300">
                        <div class="w-1/3 bg-[#844a8a] flex items-center justify-center h-16 rounded-l-lg">
                            <i class="text-white fa-2x fa-solid fa-arrow-left"></i>
                        </div>
                        <div
                            class="w-2/3 bg-white h-16 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Step 1</h2>
                            <p class="text-xs text-gray-600">District Context</p>
                        </div>
                    </a>
                </div>
                <!-- Step 1 End -->


                <!-- Step 3 -->
                <div class="w-1/3 text-center pr-6 mb-6">
                    <a @if ($ir1status) href="{{ route('prioritizedActivities.index', ['stageId' => 3, 'did' => $districtprofile->id]) }}"
                        @else
                       href="{{ route('dataentrystage.create', ['stageId' => 3, 'did' => $districtprofile->id]) }}" @endif
                        class="flex items-center justify-center border border-gray-200 transition duration-300">
                        <div class="w-1/3 bg-[#844a8a] flex items-center justify-center h-16 rounded-l-lg">
                            <i class="text-white fa-2x fa-solid fa-arrow-right"></i>
                        </div>
                        <div
                            class="w-2/3 bg-white h-16 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Step 3.</h2>
                            <p class="text-xs text-gray-600">Social Behavior Change (SBC) Activities (IR1)</p>
                        </div>
                    </a>
                </div>
                <!-- Step 3 End -->
            </div>
        </div>
        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">Step 2. Prioritize Indicators for Year 1</h2>
            <form action="{{ route('stages.resetStatus') }}" method="Post">
                @csrf
                <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
                <input type="number" name="stage_id" value="2" hidden>
                <button type="submit"
                    class="btn bg-[#844a8a] text-gray-100 hover:bg-gray-800 dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white px-4 py-2 flex items-center space-x-2">
                    <i class="fas fa-edit"></i>
                    <span class="max-xs:sr-only">Edit</span>
                </button>
            </form>
        </div>
        <x-district-profile-card :districtprofile="$districtprofile" :districtVulnerability="$districtVulnerability" />


        <div class="overflow-x-auto mt-6">
            <p class="bg-white p-4 rounded-lg w-full mb-5">Legend: red < 50%; orange 50%-79%; green>=80%</p>
            <table class="min-w-full border-collapse bg-white border-gray-600 rounded-lg overflow-hidden">
                <thead class="rounded-lg">
                    <tr>
                        <th class="bg-gray-500 text-white text-xs p-2">Target Group</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Thematic area</th>
                        <th class="bg-gray-500 text-white text-xs p-2">#</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Priority Indicator Year 1</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Proportion (%)</th>
                    </tr>

                </thead>
                <tbody class="rounded-lg" id="priority-table-body">
                    <!-- Existing rows rendered by server-side logic -->
                    @php $index = 1; @endphp
                    @foreach ($priorities as $priority)
                        <tr>
                            <td class="border text-sm border-gray-600 text-black px-2">
                                {{ $priority->targetGroup->target_group }}
                            </td>
                            <td class="border text-sm border-gray-600 text-black px-2">
                                {{ $priority->thematicArea->thematic_area }}
                            </td>
                            <td class="border text-sm border-gray-600 text-black p-2">{{ $index++ }}</td>
                            <td class="border text-sm border-gray-600 text-black p-2">
                                {{ $priority->question->question }}
                            </td>
                            @php
                                $value = $priority->question->indicator->provinceProfiles[0]->all_value;
                                $color = '';

                                if ($value < 50) {
                            $color = 'bg-red-800 text-white';
                        } elseif ($value >= 50 && $value < 80) {
                            $color = 'bg-orange-400 text-white';
                        } elseif ($value >= 80) {
                            $color = 'bg-green-700 text-white';
                        }
                    
                            @endphp

                            <td class="border text-sm border-gray-600 text-black text-center px-2 {{ $color }}">
                                {{ $value }}
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05</p>
                <p class="font-semibold text-md text-blue-600">Notes</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <textarea id="notes" name="notes" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your notes here...">{{ $stepRemarks->notes ?? 'NA' }}</textarea>
            </div>
        </div>
    </div>
    <div id="edit-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
                <form id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="priority" value="0">
                    <!-- Hidden input field for priority value -->
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                <!-- Informational Icon -->
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h1v4zm0-6h-1V7h1v3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Priority Status
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-gray-500">
                                        <!-- Message will be set by JavaScript -->
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button type="submit"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium text-white shadow-sm focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                <!-- Button text will be set by JavaScript -->
                            </button>
                        </span>
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                            <button type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                onclick="closeEditModal()">
                                Cancel
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>



</x-app-layout>
<script>
    function showEditModal(route, priority) {
        // Set the form action URL
        const form = document.getElementById('edit-form');
        form.action = route;

        // Get the modal elements
        const modal = document.getElementById('edit-modal');
        const message = modal.querySelector('.text-gray-500');
        const button = modal.querySelector('button[type="submit"]');
        const priorityInput = form.querySelector('input[name="priority"]');

        // Set the message, button text, and priority value based on the current priority
        if (priority == 0) {
            message.textContent = 'Do you want to add this into the priority list?';
            button.textContent = 'Add to Priority';
            button.classList.remove('bg-red-600');
            button.classList.add('bg-blue-600');
            priorityInput.value = 1; // Set priority to 1 for adding
        } else {
            message.textContent = 'Do you want to remove this from the priority list?';
            button.textContent = 'Remove from Priority';
            button.classList.remove('bg-blue-600');
            button.classList.add('bg-red-600');
            priorityInput.value = 0; // Set priority to 0 for removing
        }

        // Show the modal
        modal.classList.remove('hidden');
    }

    // Function to close the modal
    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }
</script>
