<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="w-[98%] mx-auto my-4 rounded-lg divide-solid divide-y h-max">
        <div class="flex items-center gap-2 text-2xl p-4">
            <div class="border p-2 rounded-full ml-2"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                    viewBox="0 0 1024 1024" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 0 0 0 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z">
                    </path>
                </svg></div>
            <p class="font-semibold text-[24px]">Settings</p>
        </div>
        <div id="provinces-container">
            @foreach ($provinces as $index => $province)
                <div class="province border bg-white border-[#D8DAE5] rounded-lg divide-y divide-solid mb-4">
                    <div class="flex justify-between items-center cursor-pointer province-header"
                        data-index="{{ $index }}">
                        <div class="flex gap-2 p-4 items-center">
                            <p
                                class="h-10 w-10 bg-[#F1F3F8] rounded-full flex items-center justify-center font-semibold">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</p>
                            <p class="font-semibold text-md text-blue-600">{{ $province->province }}</p>
                        </div>
                        <span class="text-4xl arrow-icon">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 14L8 10H16L12 14Z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="province-content grid grid-cols-6 gap-4 p-4">
                        <div class="col-span-6 mb-4">
                            <input type="text" class="search-district form-input w-full p-2 border rounded-lg"
                                placeholder="Search district...">
                        </div>
                        @foreach ($province->districts as $district)
                            <a
                                href=" <a href="{{ route('dataentry.create', ['did' => $district->id, 'stageId' => 0]) }}" 
                            
                            class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 hover:shadow-lg transition duration-300 ease-in-out cursor-pointer">
                            <p class="text-center mt-2 text-sm font-semibold">{{ $district->district }}</p>
                            </a>
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Collapse functionality
            $('.province-header').on('click', function() {
                var index = $(this).data('index');
                var $content = $(this).next('.province-content');

                // Collapse all other provinces
                $('.province-content').not($content).slideUp();
                $('.arrow-icon').not($(this).find('.arrow-icon')).removeClass('rotate-180');

                // Toggle current province
                $content.slideToggle();
                $(this).find('.arrow-icon').toggleClass('rotate-180');
            });

            // Open the first province by default
            $('.province-header').first().trigger('click');

            // Search functionality
            $('.search-district').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();
                var $provinceContent = $(this).closest('.province-content');

                $provinceContent.find('.district').each(function() {
                    var districtName = $(this).text().toLowerCase();
                    if (districtName.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
</x-app-layout>
