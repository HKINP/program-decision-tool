<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="mt-10">
            <div class="flex justify-between">
                <!-- Step 1 -->
                <div class="w-1/3 text-center pr-6 mb-6">
                    <a href="{{ route('steplist.create', ['did' => $districtprofile->id]) }}"
                        class="flex items-center justify-center border border-gray-200 transition duration-300">
                        <div class="w-1/3 bg-[#844a8a] flex items-center justify-center h-16 rounded-l-lg">
                            <i class="text-white fa-lg fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="w-2/3 bg-white h-16 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Step List</h2>
                            <p class="text-xs text-gray-600">{{ $districtprofile->district }} </p>
                        </div>
                    </a>
                </div>
                <!-- Step 1 End -->

                <!-- Step 3 -->
                <div class="w-1/3 text-center mb-6">
                    <a
                        @if ($prioritystatus==1)
                        href="{{ route('priority.index', ['stageId' => 2, 'did' => $districtprofile->id]) }}"
                        @else
                        href="{{ route('dataentrystage.create', ['stageId' => 2, 'did' => $districtprofile->id]) }}"
                        @endif
                        class="flex items-center justify-center border border-gray-200 transition duration-300">
                        <div class="w-1/3 bg-[#844a8a] flex items-center justify-center h-16 rounded-l-lg">
                            <i class="text-white fa-lg fa-solid fa-arrow-right"></i>
                        </div>
                        <div class="w-2/3 bg-white h-16 flex flex-col items-center justify-center px-2 rounded-r-lg">
                            <h2 class="font-bold text-sm">Step 2</h2>
                            <p class="text-xs text-gray-600">Prioritize Indicators for Year 1</p>
                        </div>
                    </a>

                </div>
                <!-- Step 3 End -->
            </div>
        </div>


        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">Step 1. District Context</h2>           
        </div>
        <div class="flex justify-end mb-4">
    <button
        class="btn bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg"
        data-modal-target="addModal"
        data-modal-toggle="addModal">
        Add Information
    </button>
</div>
       <x-district-profile-card :districtprofile="$districtprofile" :districtVulnerability="$districtVulnerability" />

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05</p>
                <p class="font-semibold text-md text-blue-600">Notes</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your notes here...">{{ $stepRemarks->notes ?? "" }}</textarea>
            </div>
        </div>
        <div id="addModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-3xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="addModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Add Information</h3>
                <form action="{{ route('districtvulnerability.create') }}" method="POST">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <tbody>
                                <tr>
                                    <!-- Municipality Select -->
                                    <td class="p-2 text-center">
                                        <select name="lgid[]" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 municipality-select">
                                            <option value="">Select Municipality</option>
                                            <!-- Add dynamic options here -->
                                          
                                        </select>
                                    </td>

                                    <!-- Remote Status Checkbox -->
                                    <td class="p-2 text-center">
                                        <input type="hidden" name="remote_status[]" value="0">
                                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" name="remote_status[]">
                                    </td>

                                    <!-- Caste/Ethnicity Status Checkbox -->
                                    <td class="p-2 text-center">
                                        <input type="hidden" name="caste_ethnicity_status[]" value="0">
                                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" name="caste_ethnicity_status[]">
                                    </td>

                                    <!-- Religion Status Checkbox -->
                                    <td class="p-2 text-center">
                                        <input type="hidden" name="religion_status[]" value="0">
                                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" name="religion_status[]">
                                    </td>

                                    <!-- Food Security Status Checkbox -->
                                    <td class="p-2 text-center">
                                        <input type="hidden" name="food_security_status[]" value="0">
                                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" name="food_security_status[]">
                                    </td>

                                    <!-- Wealth Status Checkbox -->
                                    <td class="p-2 text-center">
                                        <input type="hidden" name="wealth_status[]" value="0">
                                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" name="wealth_status[]">
                                    </td>

                                    <!-- Climatic Change Status Checkbox -->
                                    <td class="p-2 text-center">
                                        <input type="hidden" name="climatic_change_status[]" value="0">
                                        <input type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" value="1" name="climatic_change_status[]">
                                    </td>

                                    <!-- Remark Textarea -->
                                    <td class="p-2 text-center">
                                        <textarea id="remark" required name="remark[]" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your notes here..." style="resize: vertical;"></textarea>
                                    </td>

                                    <!-- Remove Row Button -->
                                    <td class="p-2 text-center">
                                        <button type="button" class="remove-row-btn text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Submit Button -->
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="btn bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    // Add row functionality
    $('#add-row-btn').click(function() {
        // Clone the first row and append it
        let newRow = $('tbody tr:first').clone();
        newRow.find('input, select, textarea').val(''); // Clear input values
        $('tbody').append(newRow);
    });

    // Remove row functionality
    $(document).on('click', '.remove-row-btn', function() {
        if ($('tbody tr').length > 1) {
            $(this).closest('tr').remove();
        } else {
            alert("At least one row is required.");
        }
    });
});

</script>
</x-app-layout>