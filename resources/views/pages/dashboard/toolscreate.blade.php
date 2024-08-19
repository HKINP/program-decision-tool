<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
         <a href="{{ route('steplist.create'}}"
            <div class="flex items-center gap-2 text-2xl p-4">
                <div class="border p-2 rounded-full ml-2">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
                    </svg>
                </div>
                <p class="font-semibold text-[24px]">Approach</p>
            </div>
        </a>

        <div class="grid grid-cols-2 gap-4">
            @foreach ($stageInfo as $info)
            @php
            $stage = $info['stage'];
            $route = $info['route'];
            $showTick = $info['tick'];
            @endphp

            <a href="{{ $route }}" class="border bg-white border-[#D8DAE5] rounded-lg divide-y divide-solid block hover:bg-blue-100 hover:shadow-lg transition duration-300 ease-in-out">
                <div class="flex justify-between items-center cursor-pointer p-4">
                    <div class="flex gap-2 items-center">
                        <p class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">
                            {{ sprintf('%02d', $loop->index + 1) }}
                        </p>
                        <p class="font-semibold text-md text-blue-600">{{ $stage->stages }}</p>
                    </div>
                    <div class="flex items-center">
                        @if($showTick)
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M24,12c0-1.696-.86-3.191-2.168-4.073,.301-1.548-.148-3.213-1.347-4.413-1.199-1.199-2.864-1.648-4.413-1.347-.882-1.308-2.377-2.168-4.073-2.168s-3.191,.86-4.073,2.168c-1.548-.301-3.214,.148-4.413,1.347-1.199,1.199-1.648,2.864-1.347,4.413-1.308,.882-2.168,2.377-2.168,4.073s.86,3.191,2.168,4.073c-.301,1.548,.148,3.214,1.347,4.413,1.199,1.199,2.864,1.648,4.413,1.347,.882,1.308,2.377,2.168,4.073,2.168s3.191-.86,4.073-2.168c1.548,.301,3.214-.148,4.413-1.347,1.199-1.199,1.648-2.864,1.347-4.413,1.308-.882,2.168-2.377,2.168-4.073Zm-12.091,3.419c-.387,.387-.896,.58-1.407,.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701,1.404,1.425-5.793,5.707Z" fill="green" />
                        </svg>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>

    </div>
</x-app-layout>