<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Add Threshold Value</h1>
            </div>

        </div>

        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div
                class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">
                <x-form-component :action="route('threshold.store')" :method="'POST'" :fields="[
                    [
                        'name' => 'min_value',
                        'label' => 'Minimum Value',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-1/3',
                         ],
                    [
                        'name' => 'max_value',
                        'label' => 'Maximum Value',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-1/3',
                    ],
                    [
                        'name' => 'color',
                        'label' => 'Color Name',
                        'type' => 'color',
                        'required' => true,
                        'width' => 'w-1/3',
                    ],
                    [
                        'name' => 'recommendation',
                        'label' => 'Recommendation Value',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-full',
                    ],
                    [
                        'name' => 'question_id',
                        'label' => 'Question Value',
                        'type' => 'invisible',
                        'required' => true,
                        'width' => 'full',
                    ],
                
                    [
                        'name' => 'stage_id',
                        'label' => 'stage Value',
                        'type' => 'invisible',
                        'required' => true,
                        'width' => 100,
                    ],
                   
                ]" />
            </div>
        </div>
         </div>

</x-app-layout>
