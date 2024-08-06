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
                    'name' => 'target_group_id',
                    'label' => 'Target Group',
                    'type' => 'select',
                    'required' => false,
                    'width' => 'w-1/2',
                    'options' => $targetgroups,
                    'multiple' => false,
                ],
                [
                    'name' => 'thematic_area_id',
                    'label' => 'Thematic Area',
                    'type' => 'select',
                    'required' => false,
                    'width' => 'w-1/2',
                    'options' => $thematicareas,
                    'multiple' => false,
                ],
               
                [
                    'name' => 'indicator_id',
                    'label' => 'Indicator',
                    'type' => 'select',
                    'required' => false,
                    'width' => 'w-1/2',
                    'options' => $indicators,
                    'multiple' => false,
                ],
                 [
                      'name' => 'question',
                      'label' => 'Question Name',
                      'type' => 'text',
                      'required' => true,
                      'width' => 'w-1/2'
                  ],
                    
                ]" />
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#target_group_id').change(function() {
                var targetGroupId = $(this).val();
                if (targetGroupId) {
                    $.ajax({
                        url: '/api/thematicarea/' + targetGroupId,
                        type: 'GET',
                        data: {
                            target_group_id: targetGroupId
                        },
                        success: function(data) {
                            $('#thematic_area_id').empty();
                            $('#thematic_area_id').append('<option value="">Please select an option</option>');
                            $.each(data, function(index, thematicArea) {
                                $('#thematic_area_id').append('<option value="' + thematicArea.id + '">' + thematicArea.thematic_area + '</option>');
                            });
                        }
                    });
                } else {
                    $('#thematic_area_id').empty();
                    $('#thematic_area_id').append('<option value="">Please select an option</option>');
                }
            });
        });
    </script>
</x-app-layout>