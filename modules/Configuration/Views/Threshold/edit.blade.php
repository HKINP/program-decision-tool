<!-- resources/views/provinces/create.blade.php -->

<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">Edit District</h1>
            </div>

        </div>

        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div
                class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b px-6 py-6 bg-white border-gray-200">
                <x-form-component 
                :action="route('district.update', $district->id)" 
                :method="'PUT'" 
                :values="$district"
                :fields="[
                    [
                        'name' => 'province_id',
                        'label' => 'Province',
                        'type' => 'select',
                        'required' => true,
                        'width' => 12,
                        'options' => $provinces, // Assumes $provinces is an array of options for the select field
                    ],
                    [
                        'name' => 'district',
                        'label' => 'District Name',
                        'type' => 'text',
                        'required' => true,
                        'width' => 6,
                    ],
                    [
                        'name' => 'adolescent_girls',
                        'label' => 'No. of Adolescent Girls',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'children_under_5',
                        'label' => 'No. of Children Under 5',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'hospitals',
                        'label' => 'No. of Hospitals',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'hps',
                        'label' => 'No. of HPs',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'otcs',
                        'label' => 'No. of Of OTCs',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'phccs',
                        'label' => 'No. of PHCCs',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'pregnant_women',
                        'label' => 'No. of Pregnant Women',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'wra',
                        'label' => 'No. of Women of Reproductive Age',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'chus',
                        'label' => 'No. of CHUs',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'fchvs',
                        'label' => 'No. of FCHVs',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'uhcs',
                        'label' => 'No. of UHCs',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'akc',
                        'label' => 'No. of AKC',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'vhlc',
                        'label' => 'No. of VHLC',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'children_0_to_23_months',
                        'label' => 'No. of Children 0 to 23 Months',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'epi_clinics',
                        'label' => 'No. of EPI Clinics',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'hmg',
                        'label' => 'No. of HMG',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'low_equity_quintile_municipalities',
                        'label' => 'No. of Low Equity Quintile Municipalities',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'birthing_centers',
                        'label' => 'No. of Birthing Centers',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'schools',
                        'label' => 'No. of Schools',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                    [
                        'name' => 'orc',
                        'label' => 'No. of ORC',
                        'type' => 'number',
                        'required' => false, // Adjust based on your requirements
                        'width' => 6,
                    ],
                ]" />
            </div>
        </div>
    </div>

</x-app-layout>
