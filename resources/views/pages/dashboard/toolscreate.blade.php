<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="flex items-center gap-2 text-2xl p-4">
            <div class="border p-2 rounded-full ml-2">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
                </svg>
            </div>
            <p class="font-semibold text-[24px]">Approach</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach ($stages as $index => $stage)
                <a href="{{ route('priority.index', ['did' => $districtID, 'stageId' => $stage->id]) }}" class="border bg-white border-[#D8DAE5] rounded-lg divide-y divide-solid block hover:bg-blue-100 hover:shadow-lg transition duration-300 ease-in-out">
                    <div class="flex justify-between items-center cursor-pointer p-4">
                        <div class="flex gap-2 items-center">
                            <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">
                                {{ sprintf('%02d', $index + 1) }}
                            </p>
                            <p class="font-semibold text-md text-blue-600">{{ $stage->stages }}</p>
                        </div>
                        <span class="text-4xl">
                            <!-- Optional icon or element here -->
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
