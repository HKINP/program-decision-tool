<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Add actions</h1>
            </div>

        </div>

        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div
                class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">
                <x-form-component :action="route('activities.store')" :method="'POST'" :fields="[
                    [
                        'name' => 'ir_id',
                        'label' => 'IR Activities',
                        'type' => 'select',
                        'required' => true,
                        'width' => 'w-1/2',
                        'options' => $ir,
                    ],
                    [
                        'name' => 'parent_id',
                        'label' => 'Parent Activities',
                        'type' => 'select',
                        'required' => false,
                        'width' => 'w-1/2',
                        'options' => $activities,
                    ],
                    [
                        'name' => 'activities',
                        'label' => 'Activities',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-1/2',
                    ],
                    
                    
                ]" />
            </div>
        </div>
    </div>

</x-app-layout>
