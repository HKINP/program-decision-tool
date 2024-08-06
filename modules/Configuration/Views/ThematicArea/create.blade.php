<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Add Thematic Area</h1>
            </div>

        </div>

        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">
                <x-form-component :action="route('thematicarea.store')" :method="'POST'" :fields="[
                    [
                        'name' => 'target_group_id[]',
                        'label' => 'Target Group',
                        'type' => 'select',
                        'required' => true,
                        'width' => 'w-1/2',
                        'options' => $targetGroups,
                        'multiple'=>true,
                    ],
                    [
                        'name' => 'thematic_area',
                        'label' => 'Thematic Area',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-1/2',
                    ],
                    
                    
                ]" />
            </div>
        </div>
    </div>
    <style>
     .select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid #bfc4cd 1px !important;
    outline: 0 !important;
    padding: 0.4rem !important;
}

.select2-container--default .select2-selection--multiple {
    border: 1px solid #bfc4cd !important;
    padding: 0.4rem !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #1d4ed8 !important;
    color: white !important;
    font-size: 0.875rem !important;
}
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.multipleselect').select2();
        });
    </script>

</x-app-layout>