<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white py-3 mb-4 rounded-lg flex flex-col md:flex-row items-center gap-4 md:gap-x-14 justify-between px-4">
            <div class="flex flex-col md:flex-row items-center gap-4 md:gap-x-4 justify-between flex-1 w-full md:w-auto">
                <div class="my-2 flex-1 w-full md:w-auto"><select name="selectedProvinceId" id="selectedProvinceId" class="mt-1 p-2 py-[11px] block w-full border text-xs border-[#ACB1C6] bg-white rounded-lg focus:outline-none focus:shadow-none disabled:cursor-not-allowed ">
                        <option value="" class="text-xs py-2">SELECT PROVINCE</option>
                        <option value="1" class="text-xs py-2">कोशी प्रदेश</option>
                        <option value="2" class="text-xs py-2">मधेश प्रदेश</option>
                        <option value="3" class="text-xs py-2">बाग्मती प्रदेश</option>
                        <option value="4" class="text-xs py-2">गण्डकी प्रदेश</option>
                        <option value="5" class="text-xs py-2">लुम्बिनी प्रदेश</option>
                        <option value="6" class="text-xs py-2">कर्णाली प्रदेश</option>
                        <option value="7" class="text-xs py-2">सुदुर पश्चिम प्रदेश</option>
                    </select></div>
                <div class="my-2 flex-1 w-full md:w-auto"><select name="selectedDistrictId" id="selectedDistrictId" disabled="" class="mt-1 p-2 py-[11px] block w-full border text-xs border-[#ACB1C6] bg-white rounded-lg focus:outline-none focus:shadow-none disabled:cursor-not-allowed ">
                        <option value="" class="text-xs py-2">SELECT DISTRICT</option>
                    </select></div>
            </div>
            <div class="flex gap-2"><button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 text-primary-foreground px-4 py-2 bg-purple-800 hover:bg-purple-600 h-auto text-white w-full md:w-auto mt-4 md:mt-0">RESET</button>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg w-full mb-5">
            <h3 class="text-xl  font-semibold mb-2">Instructions</h3>
            <div class="space-y-2 text-xs italic">
                <p>1) Use the menu below to design community-level activities. To support women and caregivers to
                    adopt the selected behaviors, consider what barriers they would need to overcome. These barriers may
                    be individual (e.g., knowledge, self-confidence, time, cost) or social (family support, cultural
                    practices, gender norms), or structural (health system, food system). We will address health system
                    barriers under IR 2 and food system barriers under IR 3. </p>
                <p class="mb-2">
                    2) For each platform/program determine what you would need to do: conduct IPC, organize community
                    events (e.g., street theater), refer or link with another program e.g., social protection. Complete
                    the who and how columns to determine further who needs to be involved and how. Then describe your
                    activity in as much detail as possible. Once you have completed identifying activities for everyone
                    in the district, consider how it might change for underserved populations. Given the year 1
                    implementation duration of 4-6 months, try to limit the number of activities to 5-7 for this IR.
                </p>
            </div>

        </div>
        <div class="flex md:flex-row items-center gap-4 md:gap-x-4 justify-between flex-1 mb-4 w-full md:w-auto">
        <div class="px-3 md:lg:xl:px-40   border-t border-b py-20 bg-opacity-10" style="background-image: url('https://www.toptal.com/designers/subtlepatterns/uploads/dot-grid.png') ;">
        <div class="grid grid-cols-1 md:lg:xl:grid-cols-3 group bg-white shadow-xl shadow-neutral-100 border ">


            <div
                class="p-10 flex flex-col items-center text-center group md:lg:xl:border-r md:lg:xl:border-b hover:bg-slate-50 cursor-pointer">
                <span class="p-5 rounded-full bg-red-500 text-white shadow-lg shadow-red-200"><svg
                        xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg></span>
                <p class="text-xl font-medium text-slate-700 mt-3">Most Experienced Team</p>
                <p class="mt-2 text-sm text-slate-500">Team BrainEdge education is a bunch of highly focused, energetic
                    set of people.</p>
            </div>

            <div
                class="p-10 flex flex-col items-center text-center group md:lg:xl:border-r md:lg:xl:border-b hover:bg-slate-50 cursor-pointer">
                <span class="p-5 rounded-full bg-orange-500 text-white shadow-lg shadow-orange-200"><svg
                        xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg></span>
                <p class="text-xl font-medium text-slate-700 mt-3">Best
                    Test preparation</p>
                <p class="mt-2 text-sm text-slate-500">Know where you stand and what next to do to succeed .</p>
            </div>

            <div class="p-10 flex flex-col items-center text-center group   md:lg:xl:border-b hover:bg-slate-50 cursor-pointer">
                <span class="p-5 rounded-full bg-yellow-500 text-white shadow-lg shadow-yellow-200"><svg
                        xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg></span>
                <p class="text-xl font-medium text-slate-700 mt-3">Admission process Guidance</p>
                <p class="mt-2 text-sm text-slate-500">Professional Advice for higher education abroad and select the
                    top institutions worldwide.</p>
            </div>


            <div class="p-10 flex flex-col items-center text-center group   md:lg:xl:border-r hover:bg-slate-50 cursor-pointer">
                <span class="p-5 rounded-full bg-lime-500 text-white shadow-lg shadow-lime-200"><svg
                        xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg></span>
                <p class="text-xl font-medium text-slate-700 mt-3">Best
                    Track Record</p>
                <p class="mt-2 text-sm text-slate-500">Yet another year ! Yet another jewel in our crown!</p>
            </div>

            <div class="p-10 flex flex-col items-center text-center group    md:lg:xl:border-r hover:bg-slate-50 cursor-pointer">
                <span class="p-5 rounded-full bg-teal-500 text-white shadow-lg shadow-teal-200"><svg
                        xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg></span>
                <p class="text-xl font-medium text-slate-700 mt-3">Free
                    Mock Exams</p>
                <p class="mt-2 text-sm text-slate-500">Get Topic-Wise Tests, Section- Wise and mock tests for your
                    preparation.</p>
            </div>

            <div class="p-10 flex flex-col items-center text-center group     hover:bg-slate-50 cursor-pointer">
                <span class="p-5 rounded-full bg-indigo-500 text-white shadow-lg shadow-indigo-200"><svg
                        xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg></span>
                <p class="text-xl font-medium text-slate-700 mt-3">Genuine
                    Visa Advice</p>
                <p class="mt-2 text-sm text-slate-500">Visa process by helping you create the necessary documentation
                </p>
            </div>




        </div>

        <div class="w-full   bg-indigo-600 shadow-xl shadow-indigo-200 py-10 px-20 flex justify-between items-center">
            <p class=" text-white"> <span class="text-4xl font-medium">Still Confused ?</span> <br> <span class="text-lg">Book For Free Career Consultation Today ! </span></p>
            <button class="px-5 py-3  font-medium text-slate-700 shadow-xl  hover:bg-white duration-150  bg-yellow-400">BOOK AN APPOINTMENT </button>
        </div>

    </div>
            

        </div>
        <div class="flex md:flex-row items-center gap-4 md:gap-x-4 justify-between flex-1 w-full md:w-auto">

            <div class=" bg-white p-4 rounded-lg w-1/2">
                <h3 class="text-xl  font-semibold mb-2">District Profile</h3>
                <div class="space-y-2">
                    <p class=" text-sm">WRA <span>:#</span></p>
                    <p class=" text-sm">Pregnant women <span>:#</span></p>
                    <p class=" text-sm">Adolescent girls <span>:#</span></p>
                    <p class=" text-sm">Children under 5 <span>:#</span></p>
                    <p class=" text-sm">children 0 to 23 months <span>:#</span></p>
                    <p class=" text-sm">Low equity quintile municipalities <span>:#</span></p>
                </div>

            </div>
            <div class="bg-white p-4 rounded-lg w-1/2">
                <h3 class="text-xl  font-semibold mb-2">Health Facilities</h3>
                <div class="space-y-2">
                    <p class="text-sm">Hospitals: <span>#</span></p>
                    <p class="text-sm">PHCCs: <span>#</span></p>
                    <p class="text-sm">HPs: <span>#</span></p>
                    <p class="text-sm">UHCs: <span>#</span></p>
                    <p class="text-sm">CHUs: <span>#</span></p>
                    <p class="text-sm">FCHVs: <span>#</span></p>
                </div>
            </div>

        </div>

</x-app-layout>