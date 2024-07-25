<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

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

        <!-- Button in Top-Right Corner -->
        <div class=" mt-6 text-right">
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg" id="openModalButton" fdprocessedid="dzhofe">
                Add New
            </button>
        </div>

        <!-- Existing Form -->

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full border-collapse bg-white border-gray-200 rounded-lg overflow-hidden">
                <thead class="rounded-lg">
                    <tr>
                        <th rowspan="2" class="bg-purple-800 text-white text-xs p-2">Target Group</th>
                        <th rowspan="2" class="bg-purple-800 text-white text-xs p-2">Thematic area</th>
                        <th rowspan="2" class="bg-purple-800 text-white text-xs p-2">#</th>
                        <th rowspan="2" class="bg-purple-800 text-white text-xs p-2">Questions (based on MSNP III indicators)</th>
                        <th colspan="2" class="bg-purple-800 text-white text-xs p-2 w-32">Responses (%)</th>
                        <th rowspan="2" class="bg-purple-800 text-white text-xs p-2 justify-center">Priority for Y1</th>
                    </tr>
                    <tr>
                        <th class="bg-purple-800 text-white text-xs p-2 w-16">All</th>
                        <th class="bg-purple-800 text-white text-xs p-2 w-16">Underserved</th>
                    </tr>
                </thead>
                <tbody class="rounded-lg">
                    @php $index = 1; @endphp
                    @foreach ($priorities as $priority)
                    <tr>
                        <td class="border text-sm border-gray-200 p-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $priority->targetGroup->target_group }}</span>
                        </td>
                        <td class="border text-sm border-gray-200 p-2">
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $priority->thematicArea->thematic_area }}</span>
                        </td>
                        <td class="border text-sm border-gray-200 p-2">{{ $index++ }}</td>
                        <td class="border text-sm border-gray-200 p-2">{{ $priority->question->question }}</td>
                        <td class="border text-sm border-gray-200 p-2 status-cell justify-center" data-response="{{ $priority->response_all }}">
                            {{$priority->response_all}}
                        </td>
                        <td class="border text-sm border-gray-200 p-2 status-cell justify-center" data-response="{{ $priority->response_underserved }}">
                            {{$priority->response_underserved}}
                        </td>
                        <td class="border text-sm border-gray-200 p-2 justify-center">
                            {{$priority->priority}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div id="myModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
                <div class="flex justify-between items-center border-b pb-2 mb-4">
                    <h2 class="text-lg font-bold">Add New Priority</h2>
                    <button id="closeModalButton" class="text-gray-600 hover:text-gray-800">&times;</button>
                </div>
                <form id="priorityForm" action="{{ route('priority.store') }}" method="POST">
                    @csrf
                    <input type="number" name="province_id" vlaue="{{ $districtprofile->province->id }}" hidden>
                    <input type="number" name="district_id" value="{{ $districtprofile->id }}"  hidden>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="targetGroup" class="block text-sm font-medium text-gray-700">Target Group</label>
                            <select name="target_group_id" id="targetGroup" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="">Select Target Group</option>
                                @foreach ($targetgroups as $targetgroup)

                                <option value="{{$targetgroup->id}}">{{$targetgroup->target_group}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="thematicArea" class="block text-sm font-medium text-gray-700">Thematic Area</label>
                            <select name="thematic_area_id" id="thematicArea" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" disabled>
                                <option value="">Select Thematic Area</option>
                                <!-- Populate with thematic areas based on selected target group -->
                            </select>
                        </div>
                        <div>
                            <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                            <select name="question_id" id="question" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" disabled>
                                <option value="">Select Question</option>
                                <!-- Populate with questions based on selected thematic area -->
                            </select>
                        </div>
                        <div>
                            <label for="responseAll" class="block text-sm font-medium text-gray-700">Response (All)</label>
                            <input type="number" name="response_all" id="responseAll" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                        <div>
                            <label for="responseUnderserved" class="block text-sm font-medium text-gray-700">Response (Underserved)</label>
                            <input type="number" name="response_underserved" id="responseUnderserved" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                        </div>
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700">Priority for Y1</label>
                            <select name="priority" id="priority" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="">Priority</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <script>
        $(document).ready(function() {
            $('#openModalButton').click(function() {
                $('#myModal').removeClass('hidden');
            });

        });

        // Load thematic areas based on selected target group
        $('#targetGroup').on('change', function() {
            let targetGroupId = $(this).val();
            if (targetGroupId) {
                $.ajax({
                    url: '/api/thematicarea/' + targetGroupId, // Replace with your route
                    method: 'GET',
                    success: function(data) {
                        $('#thematicArea').html('<option value="">Select Thematic Area</option>').prop('disabled', false);
                        data.forEach(function(area) {
                            $('#thematicArea').append('<option value="' + area.id + '">' + area.thematic_area + '</option>');
                        });
                    }
                });
            } else {
                $('#thematicArea').html('<option value="">Select Thematic Area</option>').prop('disabled', true);
                $('#question').html('<option value="">Select Question</option>').prop('disabled', true);
            }
        });

        // Load questions based on selected thematic area
        $('#thematicArea').on('change', function() {
            let thematicAreaId = $(this).val();
            if (thematicAreaId) {
                $.ajax({
                    url: 'api/priorities/questions/' + thematicAreaId, // Replace with your route
                    method: 'GET',
                    success: function(data) {
                        $('#question').html('<option value="">Select Question</option>').prop('disabled', false);
                        data.forEach(function(question) {
                            $('#question').append('<option value="' + question.id + '">' + question.question + '</option>');
                        });
                    }
                });
            } else {
                $('#question').html('<option value="">Select Question</option>').prop('disabled', true);
            }
        });

        // Close modal button
        $('#closeModalButton').on('click', function() {
            $('#myModal').addClass('hidden');
        });


        $('#priorityForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Handle success (e.g., close modal, update UI)
                    $('#myModal').addClass('hidden');
                    alert('Priority added successfully!');
                },
                error: function(xhr) {
                    // Handle error
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.status-cell').forEach(function(cell) {
                let response = parseFloat(cell.dataset.response);
                if (response < 50) {
                    cell.classList.add('bg-red-500', 'text-white');
                } else if (response < 80) {
                    cell.classList.add('bg-orange-500', 'text-white');
                } else {
                    cell.classList.add('bg-green-500', 'text-white');
                }
            });
        });
    </script>

</x-app-layout>