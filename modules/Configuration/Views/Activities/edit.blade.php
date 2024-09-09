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
                    @method('PUT') <!-- Specify PUT method for updating -->

                    <div class="flex flex-wrap -mx-2">
                        <!-- Activity Type -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="activity_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activity Type *</label>
                            <select id="activity_type" name="activity_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Type</option>
                                @foreach ($activitytype as $value => $label)
                                <option value="{{ $value }}" {{ $activity->activity_type == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- IR Activities -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="ir_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IR Activities *</label>
                            <select id="ir_id" name="ir_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Activities</option>
                                @foreach ($ir as $value => $label)
                                <option value="{{ $value }}" {{ $activity->ir_id == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Outcomes -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="outcomes_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Outcomes *</label>
                            <select id="outcomes_id" name="outcomes_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Outcomes</option>
                                @foreach ($outcomes as $value => $label)
                                <option value="{{ $value }}" {{ $activity->outcomes_id == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Activities -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="activities" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Activities *</label>
                            <input type="text" id="activities" name="activities" value="{{ $activity->activities }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <!-- Responsible Partners -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="partner" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Responsible Partners *</label>
                            <select id="partner" name="partner[]" class="multipleselect bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" multiple required>
                                @foreach ($partners as $value => $label)
                                <option value="{{ $value }}" {{ in_array($value, $activity->partner ?? []) ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
       
                        <!-- Implemented By -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="implemented_by" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Implemented By *</label>
                            <select id="implemented_by" name="implemented_by" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Implementor</option>
                                @foreach ($implementor as $value => $label)
                                <option value="{{ $value }}" {{ $activity->implemented_by == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Unit -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="unit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit *</label>
                            <input type="text" id="unit" name="unit" value="{{ $activity->unit }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <!-- Budget -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="total_budget" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Budget</label>
                            <input type="text" id="total_budget" name="total_budget" value="{{ $activity->total_budget }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <!-- Total Target -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="total_target" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Target</label>
                            <input type="text" id="total_target" name="total_target" value="{{ $activity->total_target }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        </div>

                        <!-- Year -->
                        <div class="w-1/2 px-2 mb-6">
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Year *</label>
                            <select id="year" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Year</option>
                                @foreach ($year as $value => $label)
                                <option value="{{ $value }}" {{ $activity->year == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Months -->
                        <div class="px-2 mb-6 w-full">
                            <label class="block text-sm font-medium text-gray-700">Select Months</label>
                            <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach ($months as $key=>$month)
                                <div class="p-4 border border-gray-300 rounded-lg">
                                    <input id="month_{{ $month }}" name="months[]" type="checkbox" value="{{ $key }}" {{ in_array($key, $activity->months ?? []) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    <label for="month_{{ $month }}" class="ml-3 text-sm text-gray-600">{{ $month }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex justify-end">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Update Activity</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
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
        });
    </script>
</x-app-layout>