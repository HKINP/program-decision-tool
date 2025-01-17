<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full mx-auto print-container">
        <!-- Heading and Edit Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold">USAID Integrated Nutrition Year One Workplan (July 2024-June 2025)
            </h2>
        </div>

        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <div class="flex gap-2 items-center mb-4 no-print">
                <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
                <p class="font-semibold text-md text-blue-600">Activities Attribute Mapping</p>
            </div>
            <!-- Add your table here -->
            <table id="myTable" class="min-w-full border-collapse border divide-y divide-gray-200 mt-8 border-gray-300">
                <!-- Header Section -->
                <thead>
                    <tr class="bg-purple-800 text-white">
                        <th class="text-xs border border-gray-300 p-2 text-center w-24">#</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Activities</th>
                        <th class="text-xs border border-gray-300 p-2 text-center">Actions</th>
                    </tr>
                </thead>
                <!-- Body Section -->
                <tbody class="divide-y divide-gray-200">

                    <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                        <td colspan="3" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Program Management
                        </td>

                    </tr>
                    @foreach ($programactivities as $index => $programactivity)
                    <tr class="text-black p-4">

                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td>

                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>

                        <td class="border border-gray-300 p-2 text-xs">
                            <div class="flex  space-x-4">
                                <a href="{{ route('activities.attributedata.create', $programactivity->id) }}" class="text-green-500 hover:text-green-700" title="Add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('activities.attributes.view', $programactivity->id) }}" class="text-gray-500 hover:text-gray-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-500 hover:text-indigo-700" title="Attendance">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </td>
                        @endforeach
                    </tr>

                    <tr class="bg-gray-100 text-white font-semibold">
                        <td colspan="3" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Finance and Operations
                        </td>

                    </tr>
                    @foreach ($financeandoperation as $index => $programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td>

                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>

                        <td class="border border-gray-300 p-2 text-xs">
                            <div class="flex  space-x-4">
                                <a href="{{ route('activities.attributedata.create', $programactivity->id) }}" class="text-green-500 hover:text-green-700" title="Add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('activities.attributes.view', $programactivity->id) }}" class="text-gray-500 hover:text-gray-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-500 hover:text-indigo-700" title="Attendance">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                    @php
                    // Initialize the overall total budget
                    $overallTotalBudget = 0;
                    @endphp
                    <!-- Iterate over Outcomes -->
                    @foreach ($irOutcomes as $irId => $irOutcomes)
                    <!-- Display IR Header -->
                    <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                        <td colspan="3" class="border text-black font-bold border-gray-300 text-xs p-2 text-left">
                            @if ($irId == 1)
                            IR 1. Improve household nutrition practices
                            @elseif ($irId == 2)
                            IR 2. Improved coverage and quality of nutrition
                            services
                            @elseif ($irId == 3)
                            IR 3. Improve access to safe, diverse, and
                            nutritious foods
                            @elseif ($irId == 4)
                            IR 4. Strengthen GON capacity for multi-sectoral
                            nutrition programming
                            @endif
                        </td>
                    </tr>
                    @foreach ($irOutcomes as $outcomeGroup)
                    @foreach ($outcomeGroup as $outcome)
                    <tr class="bg-gray-200 ">
                        <td colspan="3"
                            class="border border-gray-300 p-2 font-bold  text-black text-left text-xs"
                            style="background:#e5e7eb;font-weight:bold">
                            {{ $outcome['outcome']['outcome'] }}
                        </td>

                    </tr>

                    <!-- Iterate over Activities -->
                    @foreach ($outcome['outcome']['activities'] as $index => $activity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}
                        </td>

                        <td class="border border-gray-300 p-2 text-xs">
                            {{ $activity['activities'] ?? '' }}
                        </td>
                        <td class="border border-gray-300 p-2 text-xs">
                            <div class="flex  space-x-4">
                                <a href="{{ route('activities.attributedata.create', $activity['id']) }}" class="text-green-500 hover:text-green-700" title="Add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('activities.attributes.view', $activity['id']) }}" class="text-gray-500 hover:text-gray-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-500 hover:text-indigo-700" title="Attendance">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                    @endforeach
                    @endforeach
                    @endforeach
                    <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                        <td colspan="3" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Monitoring, Evaluation, Research and Learning
                        </td>

                    </tr>
                    @foreach ($merl as $index => $programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td>


                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>

                        <td class="border border-gray-300 p-2 text-xs">
                            <div class="flex  space-x-4">
                                <a href="{{ route('activities.attributedata.create', $programactivity->id) }}" class="text-green-500 hover:text-green-700" title="Add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('activities.attributes.view', $programactivity->id) }}" class="text-gray-500 hover:text-gray-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-500 hover:text-indigo-700" title="Attendance">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                        <td colspan="3" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Gender and Inclusive Development
                        </td>

                    </tr>
                    @foreach ($gid as $index => $programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>

                        <td class="border border-gray-300 p-2 text-xs">
                            <div class="flex  space-x-4">
                                <a href="{{ route('activities.attributedata.create', $programactivity->id) }}" class="text-green-500 hover:text-green-700" title="Add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('activities.attributes.view', $programactivity->id) }}" class="text-gray-500 hover:text-gray-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-500 hover:text-indigo-700" title="Attendance">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                        <td colspan="3" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Resilience and Shock Response
                        </td>

                    </tr>
                    @foreach ($eprr as $index => $programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td>

                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>

                        <td class="border border-gray-300 p-2 text-xs">
                            <div class="flex  space-x-4">
                                <a href="{{ route('activities.attributedata.create', $programactivity->id) }}" class="text-green-500 hover:text-green-700" title="Add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('activities.attributes.view', $programactivity->id) }}" class="text-gray-500 hover:text-gray-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-500 hover:text-indigo-700" title="Attendance">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                        <td colspan="3" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Diverse Partnersips (Private Sector, Academia, CSOs)
                        </td>

                    </tr>
                    @foreach ($diverse as $index => $programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td>

                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>

                        <td class="border border-gray-300 p-2 text-xs">
                            <div class="flex  space-x-4">
                                <a href="{{ route('activities.attributedata.create', $programactivity->id) }}" class="text-green-500 hover:text-green-700" title="Add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('activities.attributes.view', $programactivity->id) }}" class="text-gray-500 hover:text-gray-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-500 hover:text-indigo-700" title="Attendance">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    @endforeach

                    <tr class="bg-gray-100 text-white" style="background:#e5e7eb;font-weight:bold">
                        <td colspan="3" class="border border-gray-300  text-black text-xs p-2 text-left">
                            Social and Behaviour Change
                        </td>

                    </tr>
                    @foreach ($sbcc as $index => $programactivity)
                    <tr class="text-black">
                        <td class="border border-gray-300 p-2 text-center text-xs">{{ $index + 1 }}</td>

                        <td class="border border-gray-300 p-2 text-xs">{{ $programactivity->activities }}</td>

                        <td class="border border-gray-300 p-2 text-xs">
                            <div class="flex  space-x-4">
                                <a href="{{ route('activities.attributedata.create', $programactivity->id) }}" class="text-green-500 hover:text-green-700" title="Add">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('activities.attributes.view', $programactivity->id) }}" class="text-gray-500 hover:text-gray-700" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-indigo-500 hover:text-indigo-700" title="Attendance">
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.activities_attributes').select2({
                placeholder: 'Select Attributes',
                allowClear: true
            });

            $('.activities_attributes').on('change', function() {
                let selectedValues = $(this).val();
                let activityId = $(this).data('activity-id');


                if (selectedValues && selectedValues.length > 0) {
                    let csvValues = selectedValues.join(','); // Convert array to CSV

                    $.ajax({
                        url: "/activities/attributes/store",
                        type: "POST",
                        data: {
                            activity_id: activityId,
                            attributes: csvValues, // Store as CSV
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log("Saved successfully");
                        },
                        error: function(xhr, status, error) {
                            console.error("Error saving:", error);
                        }
                    });
                }
            });

        });
    </script>



</x-app-layout>