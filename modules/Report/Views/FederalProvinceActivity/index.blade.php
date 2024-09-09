<x-app-layout>
<div class="province-section bg-white border border-[#D8DAE5] rounded-lg mb-4">
    <div class="title p-4 text-xl font-bold text-left bg-gray-100 border-b border-[#D8DAE5]">
       Federal/Province Level Activities
    </div>
    <div class="province-content grid grid-cols-4 gap-4 p-4">
        <a href="{{route('federal.activities')}}" class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 cursor-pointer ease-in-out duration-300">
            <p class="text-center mt-2 text-sm font-semibold">Federal</p>
        </a>
        <a href="https://decisiontool.hki.org.np/steplist?did=104" class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 cursor-pointer ease-in-out duration-300">
            <p class="text-center mt-2 text-sm font-semibold">Koshi Province</p>
        </a>
        <a href="https://decisiontool.hki.org.np/steplist?did=105" class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 cursor-pointer ease-in-out duration-300">
            <p class="text-center mt-2 text-sm font-semibold">Madhesh Province</p>
        </a>
        <a href="https://decisiontool.hki.org.np/steplist?did=106" class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 cursor-pointer ease-in-out duration-300">
            <p class="text-center mt-2 text-sm font-semibold">Bagmati Province</p>
        </a>
        <a href="https://decisiontool.hki.org.np/steplist?did=114" class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 cursor-pointer ease-in-out duration-300">
            <p class="text-center mt-2 text-sm font-semibold">Gandaki Province</p>
        </a>
        <a href="https://decisiontool.hki.org.np/steplist?did=107" class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 cursor-pointer ease-in-out duration-300">
            <p class="text-center mt-2 text-sm font-semibold">Lumbini Province</p>
        </a>
        <a href="https://decisiontool.hki.org.np/steplist?did=108" class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 cursor-pointer ease-in-out duration-300">
            <p class="text-center mt-2 text-sm font-semibold">Karnali Province</p>
        </a>
        <a href="https://decisiontool.hki.org.np/steplist?did=109" class="district bg-gray-100 border rounded-lg p-10 justify-center items-center flex flex-col gap-y-2 hover:bg-blue-300 cursor-pointer ease-in-out duration-300">
            <p class="text-center mt-2 text-sm font-semibold">Sudurpashchim Province</p>
        </a>
    </div>
</div>

</x-app-layout>