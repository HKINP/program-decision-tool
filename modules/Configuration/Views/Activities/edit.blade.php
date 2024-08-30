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
                <x-form-component 
                :action="route('activities.update', $activities->id)" 
                :method="'PUT'" 
                :values="$activities"
                :fields="[
                   [
                        'name' => 'ir_id',
                        'label' => 'IR Activities',
                        'type' => 'select',
                        'required' => true,
                        'width' => 'w-1/2',
                        'options' => $ir,
                    ],
                    [
                        'name' => 'outcomes_id',
                        'label' => 'Outcomes',
                        'type' => 'select',
                        'required' => false,
                        'width' => 'w-1/2',
                        'options' => $activitiesList,
                    ],
                    [
                        'name' => 'activities',
                        'label' => 'Activities',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-1/2',
                    ],
                    [
                        'name' => 'partner',
                        'label' => 'Responsible Partners',
                        'type' => 'select',
                        'required' => false,
                        'multiple' => true,
                        'width' => 'w-1/2',
                        'options' => $partners,
                    ],
                    [
                        'name' => 'unit',
                        'label' => 'Unit',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-1/2',
                    ],
                    
                ]" />
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const irSelect = document.getElementById('ir_id');
            const outcomesSelect = document.getElementById('outcomes_id');

            irSelect.addEventListener('change', function () {
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
