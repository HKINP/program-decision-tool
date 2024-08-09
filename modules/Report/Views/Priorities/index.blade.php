<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class=" p-4 rounded-lg w-full mb-5">

            <div class="flex items-center gap-2 text-2xl p-4">
                <div class="border bg-white p-2 rounded-full ml-2"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z">
                        </path>
                    </svg></div>
                <p class="font-semibold text-[24px]">Step1. Prioritize Behaviors</p>
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
                    <label for="municipality-count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of
                        Municipality</label>
                    <input type="text" id="municipality-count" value="{{ count($locallevel) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                </div>

                <!-- Column 2 -->
                <div class="w-1/3 px-2 mb-6">
                    <label for="vulnerable-municipality-count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"># of Vulnerable
                        Municipality</label>
                    <input type="number" value="{{ $districtprofile->vulnerable_municipality }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                </div>

                <!-- Column 3  -->
                <div class="w-1/3 px-2 mb-6">
                    <label for="Ecological Zone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ecological Zone</label>
                    <input type="text" value="{{ $districtprofile->ecological_zone }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                </div>

            </div>


            <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                <thead class="rounded-lg">

                    <tr>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                            Municipality
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                            Remote
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                            Caste/Ethnicity
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                            Geography (municipalities)
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                            Food insecurity
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                            Wealth
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
                            Climatic Change
                        </th>
                        <th class="bg-gray-500 text-white text-xs p-2 whitespace-normal align-top" style="line-height: 1.2;">
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
                            <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->remote_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->caste_ethnicity_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->geography_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->food_security_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->wealth_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" {{ $data->climatic_change_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="p-2 text-center">
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $data->remarks }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="overflow-x-auto mt-6">
            <p class="bg-white p-4 rounded-lg w-full mb-5">Legend: red < 50%; orange 50%-79%; green>=80%</p>
            <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                <thead class="rounded-lg">
                    <tr>
                        <th class="bg-gray-500 text-white text-xs p-2">Target Group</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Thematic area</th>
                        <th class="bg-gray-500 text-white text-xs p-2">#</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Questions (based on MSNP III
                            indicators)</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Responses (%)<br />Province / District</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Priority for Y1</th>
                        <th class="bg-gray-500 text-white text-xs p-2">Actions</th>
                    </tr>

                </thead>
                <tbody class="rounded-lg" id="priority-table-body">
                    <!-- Existing rows rendered by server-side logic -->
                    @php $index = 1; @endphp
                    @foreach ($priorities as $priority)



                    <tr>
                        <td class="border text-sm border-gray-200 px-2">
                            {{ $priority->targetGroup->target_group }}
                        </td>
                        <td class="border text-sm border-gray-200 px-2">
                            {{ $priority->thematicArea->thematic_area }}
                        </td>
                        <td class="border text-sm border-gray-200 p-2">{{ $index++ }}</td>
                        <td class="border text-sm border-gray-200 p-2">{{$priority->question->question}}
                        </td>
                        @php
                        $value = $priority->question->indicator->provinceProfiles[0]->all_value;
                        $color = '';

                        if ($value < 50) { $color='bg-red-600 text-white' ; } elseif ($value>= 50 && $value < 80) { $color='bg-orange-700 text-white' ; } elseif ($value>= 80) {
                                $color = 'bg-green-600 text-white';
                                }
                                @endphp

                                <td class="border text-sm border-gray-200 text-center px-2 {{ $color }}">
                                    {{ $value }}
                                </td>
                                <td class="border text-sm border-gray-200 p-2">
                                    @if ($priority->priority != 0)
                                    <!-- Solid Circular Tick -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="green" class="m-auto">
                                        <circle cx="12" cy="12" r="10" fill="none" stroke="green" stroke-width="2" />
                                        <path d="M7 12l3 3 7-7" stroke="green" stroke-width="2" fill="none" />
                                    </svg>
                                    @else
                                    <!-- Solid Circular Cross -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="red" class="m-auto">
                                        <circle cx="12" cy="12" r="10" fill="none" stroke="red" stroke-width="2" />
                                        <path d="M6 6l12 12M18 6L6 18" stroke="red" stroke-width="2" fill="none" />
                                    </svg>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
    <div class="flex space-x-4">
        <a href="#" onclick="showEditModal('{{ route('priority.update', $priority->id) }}', {{ $priority->priority }})" class="text-yellow-500 hover:text-yellow-700">
            <i class="fas fa-edit"></i>
        </a>
    </div>
</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div> 
    <div id="edit-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
            <form id="edit-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="priority" value="0"> <!-- Hidden input field for priority value -->
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Informational Icon -->
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h1v4zm0-6h-1V7h1v3z"/>
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
                        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 text-base leading-6 font-medium text-white shadow-sm focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            <!-- Button text will be set by JavaScript -->
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none transition ease-in-out duration-150 sm:text-sm sm:leading-5" onclick="closeEditModal()">
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
