<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Edit Platform</h1>
            </div>

        </div>

        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div
                class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">
                <x-form-component 
                :action="route('actors.update', $actors->id)" 
                :method="'PUT'" 
                :values="$actors"
                :fields="[
                   [
                        'name' => 'parent_id',
                        'label' => 'Parent Actors',
                        'type' => 'select',
                        'required' => true,
                        'width' => 'w-1/2',
                        'options' => $actorsList,
                    ],
                    [
                        'name' => 'actors',
                        'label' => 'Actors',
                        'type' => 'text',
                        'required' => true,
                        'width' => 'w-1/2',
                    ],
                    
                    
                ]" />
            </div>
        </div>
    </div>

</x-app-layout>
