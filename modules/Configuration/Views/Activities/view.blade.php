<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Activity Details</h1>
            </div>

        </div>
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">{{$activity->activities}}</h2>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Activity Type -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Activity Type:</label>
                        <p>{{ $activityType[$activity->activity_type] ?? 'N/A' }}</p>
                    </div>

                    <!-- IR Activities -->
                    @if($activity->ir_id)
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">IR Activities:</label>
                        <p>{{ $ir[$activity->ir_id] ?? 'N/A' }}</p>
                    </div>
                    @endif

                    <!-- Outcomes -->
                    @if($activity->outcomes_id)
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Outcomes:</label>
                        <p>{{ $outcomes[$activity->outcomes_id] ?? 'N/A' }}</p>
                    </div>
                    @endif

                    <!-- Activities -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Activities:</label>
                        <p>{{ $activity->activities ?? 'N/A' }}</p>
                    </div>

                    <!-- Responsible Partners -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Responsible Partners:</label>
                        <p>
                            @foreach($activity->partner as $partner)
                            {{ $partners[$partner] ?? 'N/A' }}@if (!$loop->last), @endif
                            @endforeach
                        </p>
                    </div>

                    <!-- Targeted For -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Targeted For:</label>
                        <p>{{ $activity->targeted_for ?? 'N/A' }}</p>
                    </div>

                    <!-- Implemented By -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Implementation at:</label>
                        <p>
                            @foreach($activity->implemented_by as $impl)
                            {{ $implementor[$impl] ?? 'N/A' }}@if (!$loop->last), @endif
                            @endforeach
                        </p>
                    </div>

                    <!-- Unit -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Unit:</label>
                        <p>{{ $activity->unit ?? 'N/A' }}</p>
                    </div>

                    <!-- Budget -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Budget ($):</label>
                        <p>{{ $activity->total_budget ?? 'N/A' }}</p>
                    </div>

                    <!-- Total Target -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Total Target:</label>
                        <p>{{ $activity->total_target ?? 'N/A' }}</p>
                    </div>

                    <!-- Year -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Year:</label>
                        <p>{{ $year[$activity->year] ?? 'N/A' }}</p>
                    </div>

                    <!-- Months -->
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Months:</label>
                        <p>
                            @foreach($activity->months as $month)
                            {{ $months[$month] ?? 'N/A' }}@if (!$loop->last), @endif
                            @endforeach
                        </p>
                    </div>

                    <!-- Province -->
                    @if($activity->province_id)
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">Province:</label>
                        <p>
                            @foreach($activity->province_id as $province)
                            {{ $provinces->firstWhere('id', $province)->province ?? 'N/A' }}@if (!$loop->last), @endif
                            @endforeach
                        </p>
                    </div>
                    @endif

                    <!-- District -->
                    @if($activity->district_id)
                    <div>
                        <label class="block mb-2 text-sm font-bold text-black text-gray-900">District:</label>
                        <p>
                            @foreach($activity->district_id as $district)
                            {{ $districts->firstWhere('id', $district)->district ?? 'N/A' }}@if (!$loop->last), @endif
                            @endforeach
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
  
</x-app-layout>