<x-app-layout>
    @php
    $profilesByProvince = $profile->groupBy('province.province');
@endphp

<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <ul class="flex border-b">
        @foreach($profilesByProvince as $provinceName => $profiles)
            <li class="-mb-px mr-1">
                <a class="inline-block py-2 px-4 text-blue-500 hover:text-blue-700 font-semibold tab-link" href="#tab-{{ \Str::slug($provinceName) }}">{{ $provinceName }}</a>
            </li>
        @endforeach
    </ul>
</div>

<div class="tab-content">
    @foreach($profilesByProvince as $provinceName => $profiles)
        <div id="tab-{{ \Str::slug($provinceName) }}" class="tab-pane">
            <x-table-listing 
                :title="$provinceName . 'Profile'" 
                :headers="['S.N', 'Indicator', 'Source', 'Total', 'Rural', 'Actions']" 
                :useAddModal="false" 
                :name="'province'" 
                :addRoute="route('provinceprofile.create')"
            >
                @foreach ($profiles as $index => $profile)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $profile->indicator->indicator_name ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $profile->source}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $profile->all_value}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $profile->rural_value}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="flex space-x-4">
                                <a href="{{ route('provinceprofile.edit', $profile->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-table-listing>
        </div>
    @endforeach
</div>

<script>
    document.querySelectorAll('.tab-pane').forEach((tabPane) => {
        tabPane.style.display = 'none';
    });
    document.querySelector('.tab-pane').style.display = 'block'; // Show the first tab by default

    // Add active class to the first tab by default
    document.querySelector('.tab-link').classList.add('border-blue-500', 'text-blue-600');

    document.querySelectorAll('.tab-link').forEach((tabLink) => {
        tabLink.addEventListener('click', function(event) {
            event.preventDefault();

            // Remove active class from all tabs
            document.querySelectorAll('.tab-link').forEach((link) => {
                link.classList.remove('border-blue-500', 'text-blue-600');
                link.classList.add('text-blue-500', 'hover:text-blue-700');
            });

            // Add active class to the clicked tab
            this.classList.add('border-blue-500', 'text-blue-600');
            this.classList.remove('text-blue-500', 'hover:text-blue-700');

            // Hide all tab content
            document.querySelectorAll('.tab-pane').forEach((tabPane) => {
                tabPane.style.display = 'none';
            });

            // Show the selected tab content
            document.querySelector(this.getAttribute('href')).style.display = 'block';
        });
    });
</script>


</x-app-layout>
