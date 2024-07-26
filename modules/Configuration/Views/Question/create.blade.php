<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Add Question</h1>
            </div>

        </div>

        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">
                <x-form-component :action="route('question.store')" :method="'POST'" :fields="[
                  [
                      'name' => 'question',
                      'label' => 'Question Name',
                      'type' => 'text',
                      'required' => true,
                      'width' => 'w-1/2',
                  ],
                [
                    'name' => 'stage_id',
                    'label' => 'Stage',
                    'type' => 'select',
                    'required' => true,
                    'width' => 'w-1/2',
                    'options' => $stages,
                    'multiple' => false,
                ],
                [
                    'name' => 'thematic_area_id',
                    'label' => 'Thematic Area',
                    'type' => 'select',
                    'required' => false,
                    'width' => 'w-1/3',
                    'options' => $thematicareas,
                    'multiple' => false,
                ],
                [
                    'name' => 'target_group_id',
                    'label' => 'Target Group',
                    'type' => 'select',
                    'required' => false,
                    'width' => 'w-1/3',
                    'options' => $targetgroups,
                    'multiple' => false,
                ],
                [
                    'name' => 'tag_id',
                    'label' => 'Tags',
                    'type' => 'select',
                    'required' => false,
                    'width' => 'w-1/3',
                    'options' => $tags,
                    'multiple' => false,
                ],
                    
                    
                ]" />
            </div>
        </div>
    </div>

</x-app-layout>