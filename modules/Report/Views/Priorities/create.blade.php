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

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">03</p>
                <p class="font-semibold text-md text-blue-600">Instructions</p>
            </div>

            <div class="space-y-2 text-xs italic">
                <p>1) Use the menu below to design community-level activities. To support women and caregivers to adopt
                    the selected behaviors, consider what barriers they would need to overcome. These barriers may be
                    individual (e.g., knowledge, self-confidence, time, cost) or social (family support, cultural
                    practices, gender norms), or structural (health system, food system). We will address health system
                    barriers under IR 2 and food system barriers under IR 3.</p>
                <p class="mb-2">2) For each platform/program determine what you would need to do: conduct IPC,
                    organize community events (e.g., street theater), refer or link with another program e.g., social
                    protection. Complete the who and how columns to determine further who needs to be involved and how.
                    Then describe your activity in as much detail as possible. Once you have completed identifying
                    activities for everyone in the district, consider how it might change for underserved populations.
                    Given the year 1 implementation duration of 4-6 months, try to limit the number of activities to 5-7
                    for this IR.</p>
            </div>
        </div>

        <div class="flex md:flex-row items-center gap-4 md:gap-x-4 justify-between flex-1 w-full md:w-auto">
            <div class="bg-white w-full rounded-lg mb-4">
                <div class="flex justify-between items-center cursor-pointer p-4">
                    <div class="flex gap-2 items-center">
                        <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">04
                        </p>
                        <p class="font-semibold text-md text-blue-600">District Profile</p>
                    </div>
                    <span class="text-4xl">
                        <!-- Optional icon or element here -->
                    </span>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p class="text-sm font-bold">WRA: <span class="font-normal">{{ $districtprofile->wra }}</span>
                        </p>
                        <p class="text-sm font-bold">Pregnant women: <span class="font-normal">{{ $districtprofile->pregnant_women }}</span></p>
                        <p class="text-sm font-bold">Adolescent girls: <span class="font-normal">{{ $districtprofile->adolescent_girls }}</span></p>
                        <p class="text-sm font-bold">Children under 5: <span class="font-normal">{{ $districtprofile->children_under_5 }}</span></p>
                        <p class="text-sm font-bold">Children 0 to 23 months: <span class="font-normal">{{ $districtprofile->children_0_to_23_months }}</span></p>
                        <p class="text-sm font-bold">Low equity quintile municipalities: <span class="font-normal">{{ $districtprofile->low_equity_quintile_municipalities }}</span>
                        </p>
                    </div>
                </div>

            </div>

            <div class="bg-white w-full rounded-lg mb-4">
                <div class="flex justify-between items-center cursor-pointer p-4">
                    <div class="flex gap-2 items-center">
                        <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">05
                        </p>
                        <p class="font-semibold text-md text-blue-600">Health Facilities</p>
                    </div>
                    <span class="text-4xl">
                        <!-- Optional icon or element here -->
                    </span>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p class="text-sm font-bold">Hospitals: <span class="font-normal">{{ $districtprofile->hospitals }}</span></p>
                        <p class="text-sm font-bold">PHCCs: <span class="font-normal">{{ $districtprofile->phccs }}</span></p>
                        <p class="text-sm font-bold">HPs: <span class="font-normal">{{ $districtprofile->hps }}</span>
                        </p>
                        <p class="text-sm font-bold">UHCs: <span class="font-normal">{{ $districtprofile->uhcs }}</span></p>
                        <p class="text-sm font-bold">CHUs: <span class="font-normal">{{ $districtprofile->chus }}</span></p>
                        <p class="text-sm font-bold">FCHVs: <span class="font-normal">{{ $districtprofile->fchvs }}</span></p>
                    </div>
                </div>

            </div>
        </div>

        <div class="overflow-x-auto mt-6">
            <form action="{{ route('priority.store') }}" method="POST">
                @csrf
                <input type="number" name="province_id" value="{{ $districtprofile->province->id }}" hidden>
                <input type="number" name="district_id" value="{{ $districtprofile->id }}" hidden>
                <p>Legend: red < 50%; orange 50%-79%; green>=80%</p>
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
                        </tr>

                    </thead>
                    <tbody class="rounded-lg" id="priority-table-body">
                        <!-- Existing rows rendered by server-side logic -->
                        @php $index = 1; @endphp
                        @foreach ($questions as $question)
                        <tr>
                            <td class="border text-sm border-gray-200 p-2">
                               {{ $question->targetGroup->target_group }}
                            </td>
                            <td class="border text-sm border-gray-200 p-2">
                                {{ $question->thematicArea->thematic_area }}
                            </td>
                            <td class="border text-sm border-gray-200 p-2">{{ $index++ }}</td>
                            <td class="border text-sm border-gray-200 p-2">{{$question->question}}
                            </td>
                            @php
                            $value = $question->indicator->provinceProfiles[0]->all_value;
                            $color = '';

                            if ($value < 50) { $color='bg-red-600 text-white' ; } elseif ($value>= 50 && $value < 80) { $color='bg-orange-700 text-white' ; } elseif ($value>= 80) {
                                    $color = 'bg-green-600 text-white';
                                    }
                                    @endphp

                                    <td class="border text-sm border-gray-200 text-center p-2 {{ $color }}" >
                                        {{ $value }}
                                    </td>
                                    <td class="border text-sm  border-gray-200 p-2 text-center">
                                        <select name="priority[]" required class="mt-1 block w-full text-sm border-gray-300 roundtext-smed-lg shadow-sm">
                                            <option value="">Priority</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                    <td class="border text-sm border-gray-200 p-2 text-center">

                                    </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="mt-4 p-2 bg-green-500 text-white rounded">Submit</button>
            </form>
        </div>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Delete Prioritize Behaviors </h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-gray-500">
                                        Are you sure you want to delete this prioritize behaviors?This action cannot be
                                        undone.
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

    <!-- Modal Structure -->
    <div id="edit-modal" class="hidden fixed z-10 inset-0 overflow-y-auto bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative w-full max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-lg">
                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-700">Edit Priority</h2>
                    <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeModal()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <div class="mb-4">
                            <label for="target-group" class="block text-sm font-medium text-gray-700">Target
                                Group</label>
                            <select name="target_group_id" required id="target-group" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm edit-context target-group">
                                <option value="">Select Target Group</option>

                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="thematic-area" class="block text-sm font-medium text-gray-700">Thematic
                                Area</label>
                            <select name="thematic_area_id" id="thematic-area" required class="mt-1 block text-sm w-full border-gray-300 text-sm rounded-lg edit-context shadow-sm thematic-area">
                                <option value="">Select Thematic Area</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                            <select name="question_id" id="question" required class="mt-1 block w-full text-sm border-gray-300 edit-context rounded-lg shadow-sm question">
                                <option value="">Select Question</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="response-all" class="block text-sm font-medium text-gray-700">Response
                                All</label>
                            <input type="number" id="response-all" name="response_all" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="response-underserved" class="block text-sm font-medium text-gray-700">Response
                                Underserved</label>
                            <input type="number" id="response-underserved" name="response_underserved" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                            <select name="priority" id="priority" required class="mt-1 block w-full text-sm border-gray-300 roundtext-smed-lg shadow-sm">
                                <option value="">Priority</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end pt-4 border-t border-gray-200">
                        <button type="button" class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function showEditModal(id, editRoute) {
            document.getElementById('edit-form').action = editRoute;
            $.ajax({
                url: '/priority/' + id, // Replace with your route
                method: 'GET',
                success: function(data) {
                    $('#priority-id').val(data.id);
                    $('#target-group').val(data.target_group_id).trigger('change', [data.thematic_area, data
                        .question
                    ]);
                    $('#thematic-area').val(data.thematic_area_id).trigger('change', [data.question]);
                    $('#question').val(data.question_id);
                    $('#response-all').val(data.response_all);
                    $('#response-underserved').val(data.response_underserved);
                    $('#priority').val(data.priority);
                    $('#edit-modal').removeClass('hidden');
                }
            });
            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('edit-modal').classList.add('hidden');
        }

        $(document).ready(function() {

            let rowIndex = {
                {
                    count($priorities) + 1
                }
            };

            $('#add-row-btn').click(function() {
                let newRow = `
             <tr>
                 <td class="border text-sm border-gray-200 p-2">
                     <select name="target_group_id[]" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm add-context target-group">
                         <option value="">Select Target Group</option>
                       
                     </select>
                 </td>
                 <td class="border text-sm border-gray-200 p-2">
                     <select name="thematic_area_id[]" required class="mt-1 block add-context text-sm w-full border-gray-300 text-sm rounded-lg shadow-sm thematic-area" disabled>
                         <option value="">Select Thematic Area</option>
                     </select>
                 </td>
                 <td class="border text-sm border-gray-200 p-2">${rowIndex++}</td>
                 <td class="border text-sm border-gray-200 p-2">
                     <select name="question_id[]" required class="mt-1 block w-full add-context text-sm border-gray-300 rounded-lg shadow-sm question" disabled>
                         <option value="">Select Question</option>
                     </select>
                 </td>
                 <td class="border text-sm border-gray-200 p-2">
                     <input type="number" required name="response_all[]" class="mt-1 block text-sm  w-full border-gray-300 rounded-lg shadow-sm">
                 </td>
                 <td class="border text-sm border-gray-200 p-2">
                     <input type="number" required name="response_underserved[]" class="mt-1 text-sm  block w-full border-gray-300 rounded-lg shadow-sm">
                 </td>
                 <td class="border text-sm border-gray-200 p-2">
                     <select name="priority[]" required class="mt-1 block w-full text-sm border-gray-300 roundtext-smed-lg shadow-sm">
                         <option value="">Priority</option>
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="4">4</option>
                         <option value="5">5</option>
                     </select>
                 </td>
                 <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                     <div class="flex space-x-4">
                         <button type="button" class="text-red-500 hover:text-red-700 delete-row">
                             <i class="fas fa-trash"></i>
                         </button>
                     </div>
                 </td>
             </tr>`;

                $('#priority-table-body').append(newRow);
            });

            $(document).on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
            });


            $(document).on('change', '.target-group', function(event, thematicAreaId, questionId) {
                let targetGroupId = $(this).val();
                let thematicAreaSelect, questionSelect;

                if ($(this).hasClass('add-context')) {
                    thematicAreaSelect = $(this).closest('tr').find('.thematic-area');
                    questionSelect = $(this).closest('tr').find('.question');
                } else if ($(this).hasClass('edit-context')) {
                    thematicAreaSelect = $('#thematic-area');
                    questionSelect = $('#question');
                }

                if (targetGroupId) {
                    $.ajax({
                        url: '/api/thematicarea/' + targetGroupId, // Replace with your route
                        method: 'GET',
                        success: function(data) {
                            thematicAreaSelect.html(
                                '<option value="">Select Thematic Area</option>').prop(
                                'disabled', false);
                            data.forEach(function(area) {
                                thematicAreaSelect.append('<option value="' + area.id +
                                    '">' + area.thematic_area + '</option>');
                            });

                            // Set the value if provided
                            if (thematicAreaId) {
                                thematicAreaSelect.val(thematicAreaId).trigger('change', [
                                    questionId
                                ]);
                            }
                        }
                    });
                } else {
                    thematicAreaSelect.html('<option value="">Select Thematic Area</option>').prop(
                        'disabled', true);
                    questionSelect.html('<option value="">Select Question</option>').prop('disabled', true);
                }
            });

            $(document).on('change', '.thematic-area', function(event, questionId) {
                let thematicAreaId = $(this).val();
                let questionSelect;

                if ($(this).hasClass('add-context')) {
                    questionSelect = $(this).closest('tr').find('.question');
                } else if ($(this).hasClass('edit-context')) {
                    questionSelect = $('#question');
                }

                if (thematicAreaId) {
                    $.ajax({
                        url: '/api/priorities/questions/' +
                            thematicAreaId, // Replace with your route
                        method: 'GET',
                        success: function(data) {
                            questionSelect.html('<option value="">Select Question</option>')
                                .prop('disabled', false);
                            data.forEach(function(question) {
                                questionSelect.append('<option value="' + question.id +
                                    '">' + question.question + '</option>');
                            });

                            // Set the value if provided
                            if (questionId) {
                                questionSelect.val(questionId);
                            }
                        }
                    });
                } else {
                    questionSelect.html('<option value="">Select Question</option>').prop('disabled', true);
                }
            });


        });

        function showDeleteModal(deleteRoute) {
            document.getElementById('delete-form').action = deleteRoute;
            document.getElementById('delete-modal').classList.remove('hidden');
        }
    </script>
</x-app-layout>