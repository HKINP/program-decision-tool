<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Add Activities</h1>
            </div>

        </div>

        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div
                class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">

                <form action="{{ route('activities.store') }}" method="POST">
                    @csrf

                    <div class="flex flex-wrap -mx-2">
                        <!-- Activity Type -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="activity_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activity Type *</label>
                            <select id="activity_type" name="activity_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Type</option>
                                @foreach ($activitytype as $value => $label)
                                <option value="{{ $value }}" {{ old('activity_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- IR Activities -->
                        <div id="ir-activities" class="w-1/2 px-2 mb-6" style="display: none;">
                            <label for="ir_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IR Activities *</label>
                            <select id="ir_id" name="ir_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Select Activities</option>
                                @foreach ($ir as $value => $label)
                                <option value="{{ $value }}" {{ old('ir_id') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Outcomes -->

                        <div id="outcomes-section" class="w-1/2 px-2 mb-6" style="display: none;">
                            <label for="outcomes_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Outcomes </label>
                            <select id="outcomes_id" name="outcomes_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Select Outcomes</option>
                                @foreach ($outcomes as $value => $label)
                                <option value="{{ $value }}" {{ old('outcomes_id') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Activities -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="activities" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activities *</label>
                            <input type="text" id="activities" name="activities" value="{{ old('activities') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <!-- Responsible Partners -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="partner" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Responsible Partners *</label>
                            <select id="partner" name="partner[]" class="multipleselect bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" multiple required>
                                @foreach ($partners as $value => $label)
                                <option value="{{ $value }}" {{ in_array($value, old('partner', [])) ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 px-2 mb-6">
                            <label for="targeted_for" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Targeted For *</label>
                            <select id="targeted_for" name="targeted_for" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Targeted For</option>
                                <option value="All" {{ old('targeted_for') == 'all' ? 'selected' : '' }}>All Municipalities</option>
                                <option value="Vulnerable" {{ old('targeted_for') == 'vulnerable' ? 'selected' : '' }}>Vulnerable Muncipalities</option>
                                <option value="Mixed" {{ old('targeted_for') == 'both' ? 'selected' : '' }}>Selected Municipalities</option>
                            </select>
                        </div>
                        <!-- Implemented By -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="implemented_by" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Implemented By *</label>
                            <select id="implemented_by" name="implemented_by" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select </option>
                                @foreach ($implementor as $value => $label)
                                <option value="{{ $value }}" {{ old('implemented_by') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Unit -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit *</label>
                            <input type="text" id="unit" name="unit" value="{{ old('unit') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <!-- Budget -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="total_budget" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Budget</label>
                            <input type="text" id="total_budget" name="total_budget" value="{{ old('total_budget') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <!-- Total Target -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="total_target" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Target</label>
                            <input type="text" id="total_target" name="total_target" value="{{ old('total_target') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <!-- Year -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Year *</label>
                            <select id="year" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Year</option>
                                @foreach ($year as $value => $label)
                                <option value="{{ $value }}" {{ old('year') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-1/2 px-2 mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Months</label>
                            <select id="months" name="months" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" multiple required>
                                <option value="">Select Months</option>
                                @foreach ($months as $key=>$month)
                                <option value="{{ $key }}" {{ old('months') == $value ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Province -->
                        <div id="provinceDiv" style="display: none;" class="w-1/2 px-2 mb-6">
                            <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Province *</label>
                            <select id="pid" name="province_id" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Province</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                    {{ $province->province }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- District -->
                        <div id="districtDiv" style="display: none;" class="w-1/2 px-2 mb-6">
                            <label for="district" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select District *</label>
                            <select id="did" name="district_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" multiple required>
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                    {{ $district->district }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="mt-0">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#did').select2({
                placeholder: 'Select District',
                allowClear: true
            });
            $('#pid').select2({
                placeholder: 'Select Province',
                allowClear: true
            });
            $('#months').select2({
                placeholder: 'Select Months',
                allowClear: true
            });
        });
        // Function to show/hide province and district divs based on implemented_by value
        function toggleVisibility() {
            const implementor = document.getElementById('implemented_by').value;
            const provinceDiv = document.getElementById('provinceDiv');
            const districtDiv = document.getElementById('districtDiv');

            // Reset visibility
            provinceDiv.style.display = 'block';
            districtDiv.style.display = 'block';

            if (implementor == '1') {
                // Hide both province and district
                provinceDiv.style.display = 'none';
                districtDiv.style.display = 'none';
            } else if (implementor == '2') {
                // Hide district only
                districtDiv.style.display = 'none';
            } else if (implementor == '3') {
                // Hide province only
                provinceDiv.style.display = 'none';
            }
        }

        // Add event listener to call toggleVisibility when implemented_by changes
        document.getElementById('implemented_by').addEventListener('change', toggleVisibility);

        // Call function on page load in case a value is pre-selected
        document.addEventListener('DOMContentLoaded', toggleVisibility);
        document.addEventListener('DOMContentLoaded', function() {

            const activityTypeSelect = document.getElementById('activity_type');
            const irActivitiesSection = document.getElementById('ir-activities');
            const outcomesSection = document.getElementById('outcomes-section');

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
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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