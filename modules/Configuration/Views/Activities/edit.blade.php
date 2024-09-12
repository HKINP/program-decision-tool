<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Edit Activities</h1>
            </div>

        </div>

        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div
                class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">

                <form action="{{ route('activities.update', $activity->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-wrap -mx-2">
                        <!-- Activity Type -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="activity_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Activity Type *
                            </label>
                            <select id="activity_type" name="activity_type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="">Select Type</option>
                                @foreach ($activitytype as $value => $label)
                                <option value="{{ $value }}" {{ old('activity_type', $activity->activity_type) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- IR Activities -->
                        <div id="ir-activities" class="w-1/2 px-2 mb-6 hidden">
                            <label for="ir_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                IR Activities *
                            </label>
                            <select id="ir_id" name="ir_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select Activities</option>
                                @foreach ($ir as $value => $label)
                                <option value="{{ $value }}" {{ old('ir_id', $activity->ir_id) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Outcomes -->
                        <div id="outcomes-section" class="w-1/2 px-2 mb-6 hidden">
                            <label for="outcomes_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Outcomes
                            </label>
                            <select id="outcomes_id" name="outcomes_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select Outcomes</option>
                                @foreach ($outcomes as $value => $label)
                                <option value="{{ $value }}" {{ old('outcomes_id', $activity->outcomes_id) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Activities -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="activities" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Activities *
                            </label>
                            <input type="text" id="activities" name="activities" value="{{ old('activities', $activity->activities) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required />
                        </div>

                        <!-- Responsible Partners -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="partner" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Responsible Partners *
                            </label>
                            <select id="partner" name="partner[]" class="multipleselect bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                multiple required>
                                @foreach ($partners as $value => $label)
                                <option value="{{ $value }}" {{ in_array($value, old('partner', $activity->partner)) ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Implemented By -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="implemented_by" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Implementation at *
                            </label>
                            <select id="implemented_by" name="implemented_by[]" multiple
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                @foreach ($implementor as $value => $label)
                                <option value="{{ $value }}" {{ in_array($value, old('implemented_by', $activity->implemented_by)) ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 px-2 mb-6">
                            <label for="targeted_for" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Targeted For *</label>
                            <select id="targeted_for" name="targeted_for"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Select Targeted For</option>
                                <option value="All" {{ old('targeted_for', $activity->targeted_for) == 'All' ? 'selected' : '' }}>All Municipalities</option>
                                <option value="Vulnerable" {{ old('targeted_for', $activity->targeted_for) == 'Vulnerable' ? 'selected' : '' }}>Vulnerable Municipalities</option>
                                <option value="Selected" {{ old('targeted_for', $activity->targeted_for) == 'Selected' ? 'selected' : '' }}>Selected Municipalities</option>
                            </select>
                        </div>
                        <!-- Unit -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit *</label>
                            <input type="text" id="unit" name="unit"
                                value="{{ old('unit', $activity->unit) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>

                        <!-- Budget -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="total_budget" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Budget</label>
                            <input type="text" id="total_budget" name="total_budget"
                                value="{{ old('total_budget', $activity->total_budget) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>
                        <!-- Total Target -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="total_target" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Target</label>
                            <input type="text" id="total_target" name="total_target"
                                value="{{ old('total_target', $activity->total_target) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <!-- Year -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Year *</label>
                            <select id="year" name="year"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Select Year</option>
                                @foreach ($year as $value => $label)
                                <option value="{{ $value }}" {{ old('year', $activity->year) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Months -->
                        <div class="w-1/2 px-2 mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Months</label>
                            <select id="months" name="months[]" multiple
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Select Months</option>
                                @foreach ($months as $key => $month)
                                <option value="{{ $key }}" {{ in_array($key, old('months', $activity->months)) ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Province -->
                        <div id="provinceDiv" style="display:none" class="w-1/2 px-2 mb-6">
                            <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Province *</label>
                            <select id="pid" name="province_ids[]" multiple
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" {{ in_array($province->id, old('province_ids', $activity->province_ids)) ? 'selected' : '' }}>{{ $province->province }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- District -->
                        <div id="districtDiv" style="display:none" class="w-1/2 px-2 mb-6">
                            <label for="district" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select District *</label>
                            <select id="did" name="district_ids[]" multiple
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ in_array($district->id, old('district_ids', $activity->district_ids)) ? 'selected' : '' }}>{{ $district->district }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Update Button -->
                    <div class="mt-0">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update
                        </button>
                    </div>
            </div>
            </form>



        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#did').select2({
                placeholder: 'Select District',
                allowClear: true,
                width: 'resolve'
            });
            $('#pid').select2({
                placeholder: 'Select Province',
                allowClear: true,
                width: 'resolve'
            });
            $('#months').select2({
                placeholder: 'Select Months',
                allowClear: true,
                width: 'resolve'
            });
            $('#months').select2({
                placeholder: 'Select Months',
                allowClear: true,
                width: 'resolve'
            });
            $('#implemented_by').select2({
                placeholder: 'Select ',
                allowClear: true,
                width: 'resolve',
            });
        });

        function toggleVisibility() {
            const implementors = $('#implemented_by').val(); // Get selected values as an array
            const provinceDiv = document.getElementById('provinceDiv');
            const districtDiv = document.getElementById('districtDiv');

            // Set initial visibility to hidden
            provinceDiv.style.display = 'none';
            districtDiv.style.display = 'none';

            // Logic for showing or hiding the divs based on selected values
            if (implementors.includes('1')) {
                // If '1' is selected, hide both province and district regardless of other selections
                provinceDiv.style.display = 'none';
                districtDiv.style.display = 'none';
            }
            // If '1' is not selected, show province and district based on other selections
            if (implementors.includes('2')) {
                // Show district when '2' is selected
                provinceDiv.style.display = 'block';
            }
            if (implementors.includes('3')) {
                // Show province when '3' is selected
                districtDiv.style.display = 'block';
            }

        }

        // Add event listener to call toggleVisibility when implemented_by changes
        $('#implemented_by').on('change', toggleVisibility);


        // Call function on page load in case a value is pre-selected
        document.addEventListener('DOMContentLoaded', toggleVisibility);
        document.addEventListener('DOMContentLoaded', function() {

            const activityTypeSelect = document.getElementById('activity_type');
            const irActivitiesSection = document.getElementById('ir-activities');
            const outcomesSection = document.getElementById('outcomes-section');
            // Set initial visibility to hidden
            irActivitiesSection.style.display = 'none';
            outcomesSection.style.display = 'none';
            // Function to show/hide IR activities and outcomes
            function toggleSections() {
                const selectedActivityType = activityTypeSelect.value;
                if (selectedActivityType == '3') {
                    irActivitiesSection.style.display = 'block';
                    outcomesSection.style.display = 'block';
                } else {
                    irActivitiesSection.style.display = 'none';
                    outcomesSection.style.display = 'none';
                }
            }

            // Run on page load in case of old input value
            toggleSections();

            // Listen for changes on activity type
            activityTypeSelect.addEventListener('change', toggleSections);



            const irSelect = document.getElementById('ir_id');
            const outcomesSelect = document.getElementById('outcomes_id');

            irSelect.addEventListener('change', function() {
                const irId = this.value;

                // Clear current options
                outcomesSelect.innerHTML = '<option value="">Select an outcome</option>';

                if (irId) {
                    fetch(`/api/outcomes/ir/${irId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(outcome => {
                                const option = document.createElement('option');
                                option.value = outcome.id;
                                option.textContent = outcome.outcome;
                                outcomesSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching outcomes:', error));
                }
            });

            const provinceSelect = document.getElementById('pid');
            const districtSelect = document.getElementById('did');

            provinceSelect.addEventListener('change', function() {
                const provinceId = this.value;
                if (provinceId) {
                    fetch('/api/province/district', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                provinceIds: [provinceId]
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            districtSelect.innerHTML = '<option value="">Select District</option>';
                            data.districts.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.district;
                                districtSelect.appendChild(option);
                            });

                            // Re-select the district if already selected in the request
                            const selectedDistrict = "{{ request('did') }}";
                            if (selectedDistrict) {
                                districtSelect.value = selectedDistrict;
                            }
                        })
                        .catch(error => console.error('Error fetching districts:', error));
                } else {
                    districtSelect.innerHTML = '<option value="">Select District</option>';
                }
            });

            // Trigger the change event to load districts if a province was selected
            if (provinceSelect.value) {

                provinceSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>