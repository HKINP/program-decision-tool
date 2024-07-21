<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div
            class="bg-white py-3 mb-4 rounded-lg flex flex-col md:flex-row items-center gap-4 md:gap-x-14 justify-between px-4">
            <div class="flex flex-col md:flex-row items-center gap-4 md:gap-x-4 justify-between flex-1 w-full md:w-auto">
                <div class="my-2 flex-1 w-full md:w-auto"><select name="selectedProvinceId" id="selectedProvinceId"
                        class="mt-1 p-2 py-[11px] block w-full border text-xs border-[#ACB1C6] bg-white rounded-lg focus:outline-none focus:shadow-none disabled:cursor-not-allowed ">
                        <option value="" class="text-xs py-2">SELECT PROVINCE</option>
                        <option value="1" class="text-xs py-2">कोशी प्रदेश</option>
                        <option value="2" class="text-xs py-2">मधेश प्रदेश</option>
                        <option value="3" class="text-xs py-2">बाग्मती प्रदेश</option>
                        <option value="4" class="text-xs py-2">गण्डकी प्रदेश</option>
                        <option value="5" class="text-xs py-2">लुम्बिनी प्रदेश</option>
                        <option value="6" class="text-xs py-2">कर्णाली प्रदेश</option>
                        <option value="7" class="text-xs py-2">सुदुर पश्चिम प्रदेश</option>
                    </select></div>
                <div class="my-2 flex-1 w-full md:w-auto"><select name="selectedDistrictId" id="selectedDistrictId"
                        disabled=""
                        class="mt-1 p-2 py-[11px] block w-full border text-xs border-[#ACB1C6] bg-white rounded-lg focus:outline-none focus:shadow-none disabled:cursor-not-allowed ">
                        <option value="" class="text-xs py-2">SELECT DISTRICT</option>
                    </select></div>
            </div>
            <div class="flex gap-2"><button
                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 text-primary-foreground px-4 py-2 bg-purple-800 hover:bg-purple-600 h-auto text-white w-full md:w-auto mt-4 md:mt-0">RESET</button>
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
        <div class="grid grid-cols-3 gap-4 bg-white p-4 rounded-lg w-full mb-5">
            <div class="col">
              <h3 class="font-bold text-lg mb-2">Programs and Platforms</h3>
              <ul class="list-disc pl-4">
                <li>Academia</li>
                <li>Market</li>
                <li>Community</li>
                <li>  - VSLAS</li>
                <li>  - Post-harvest management</li>
              </ul>
            </div>
            <div class="col">
              <h3 class="font-bold text-lg mb-2">Actors</h3>
              <ul class="list-disc pl-4">
                <li>Home</li>
                <li>LSP (ag)</li>
                <li>HFP (fruit & veg)</li>
                <li>HFP (livestock)</li>
                <li>Post-harvest</li>
                <li>Farmers</li>
                <li>SMEs</li>
              </ul>
            </div>
            <div class="col">
              <h3 class="font-bold text-lg mb-2">Actions</h3>
              <ul class="list-disc pl-4">
                <li>- Train</li>
                <li>  - Producer</li>
                <li>  - Coach</li>
                <li>LSP</li>
                <li>(livestock)</li>
                <li>TA</li>
                <li>management</li>
                <li>AKC</li>
                <li>VHLEC</li>
                <li>CTEVT</li>
                <li>- Market facilitation</li>
                <li>- Link</li>
                <li>- CRG</li>
              </ul>
            </div>
          </div>
        
</x-app-layout>
