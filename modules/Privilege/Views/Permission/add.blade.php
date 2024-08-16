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
                <x-form-component :action="route('permission.store')" :method="'POST'" :fields="[
                   [
                        'name' => 'parent_id',
                        'label' => 'Parent Permission',
                        'type' => 'select',
                        'required' => true,
                        'width' => 'w-1/2',
                        'labelfirst'=>'Parent itself',
                        'valuefirst'=> 0,
                        'options' => $permissions, // Assumes $provinces is an array of options for the select field
                    ],
                    [
                        'name' => 'permission_name',
                        'label' => 'Permission Name',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-1/2',
                    ],
                    [
                        'name' => 'guard_name',
                        'label' => 'Guard Name',
                        'type' => 'text',
                        'required' => false, // Adjust based on your requirements
                        'width' => 'w-1/2',
                    ]
                    
                    
                ]" />
            </div>
        </div>
    </div>
   
</x-app-layout>
