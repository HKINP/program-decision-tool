<x-app-layout>
    <div class="mb-8 rounded-lg w-full mb-5 mt-5">
        <div class="flex items-center gap-4 text-2xl ">
            <a href="{{ route('prioritizedActivities.edit', $data->id) }}" class="flex items-center gap-4 text-2xl">
                <!-- First Arrow -->
                <div class="border bg-white p-2 rounded-full ml-2">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
                    </svg>
                </div>

                <!-- Step Description -->
                <p class="font-semibold text-[24px]">Step 3. Social Behavior Change (SBC) Activities (IR1)</p>
            </a>


            <!-- Step Description -->
            <p class="font-semibold text-[24px]">{{$title}}</p>
        </div>
    </div>
    <div class="container mx-auto px-4">
        <div class="flex gap-2 items-center mb-4">
            <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">01</p>
            <p class="font-semibold text-md text-blue-600">Activity Update</p>
        </div>
        <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
            <form action="{{ route('prioritizedActivities.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4 mb-2">
                    <!-- Activity Details -->
                    @if($data->stage_id !=6)
                    <div class="flex flex-col w-full">
                        <label for="activity-text-{{ $data->id }}" class="text-sm font-medium text-gray-700">Activity Details</label>
                        <textarea id="activity-text-{{ $data->id }}" name="proposed_activities" rows="3" required
                            class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Write your activity details here...">{{ $data->proposed_activities }}</textarea>
                    </div>
                    @endif
                    @if($data->stage_id==6)
                    <div class="flex flex-col w-full">
                        <label for="activitites" class="text-sm font-medium text-gray-700">Activities</label>
                        <select id="activitites" required  name="activity_id"
                                class="bg-white border border-gray-300  rounded-lg p-2 text-sm w-full">
                                @foreach($activities as $activity)
                                <option value="{{ $activity->id }}"
                                    {{ in_array($activity->id, explode(',', $data->activity_id)) ? 'selected' : '' }}>
                                    {{ $activity->activities }}
                                </option>
                                @endforeach
                            </select>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <!-- Targeted For -->
                        <div class="flex flex-col w-full">
                            <label for="targetted-for-option-{{ $data->id }}" class="text-sm font-medium text-gray-700">Targeted For</label>
                            <select id="targetted-for-option-{{ $data->id }}" name="targeted_for"
                                class="bg-white border border-gray-300 rounded-lg p-2 text-sm w-full">
                                <option value="All" {{ $data->targeted_for == 'All' ? 'selected' : '' }}>All</option>
                                <option value="Vulnerable" {{ $data->targeted_for == 'Vulnerable' ? 'selected' : '' }}>Vulnerable</option>
                            </select>
                        </div>

                        <!-- Platform -->
                        <div class="flex flex-col w-full">
                            <label for="platform-option-{{ $data->id }}" class="text-sm font-medium text-gray-700">Platform</label>
                            <select id="platform-option-{{ $data->id }}" required multiple name="platforms_id[]"
                                class="bg-white border border-gray-300 multipleselect rounded-lg p-2 text-sm w-full">
                                @foreach($platforms as $platform)
                                <option value="{{ $platform->id }}"
                                    {{ in_array($platform->id, explode(',', $data->platforms_id)) ? 'selected' : '' }}>
                                    {{ $platform->platforms }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Remarks -->
                        <div class="flex flex-col w-full">
                            <label for="notes-text-{{ $data->id }}" class="text-sm font-medium text-gray-700">Remarks</label>
                            <textarea id="notes-text-{{ $data->id }}" name="remarks" rows="1"
                                class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Write your notes here...">{{ $data->remarks }}</textarea>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="flex justify-end items-center">
                        <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>