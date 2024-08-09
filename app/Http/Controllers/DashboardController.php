<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFeed;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Repositories\StagesRepository;
use Modules\Report\Repositories\DistrictVulnerabilityRepository;
use Modules\Report\Repositories\PriorityRepository;

class DashboardController extends Controller
{

    protected $provinces, $stages,$districtVulnerability,$priority;


    public function __construct(

        ProvinceRepository $provinces,
        StagesRepository $stages,
        DistrictVulnerabilityRepository $districtVulnerability,
        PriorityRepository $priority,

    ) {
        $this->provinces = $provinces;
        $this->stages = $stages;
        $this->districtVulnerability = $districtVulnerability;
        $this->priority = $priority;
    }

    public function index()
    {
        return view('pages/dashboard/dashboard');
    }
    public function documentation()
    {
        $dataFeed = new DataFeed();

        return view('pages/dashboard/documentation');
    }
    public function dataentry(Request $request)
    {

        if ($request->has('did')) {

            
            $did = $request->query('did');
            $stages = $this->stages->get();
            $districtvulnerability=$this->districtVulnerability->where('district_id', '=', $did)->exists();
            $prioritystatus=$this->priority->where('district_id', '=', $did)->exists();        
            return view('pages/dashboard/toolscreate')
                ->withDistrictvulnerability($districtvulnerability)
                ->withPrioritystatus($prioritystatus)
                ->withStages($stages)
                ->withDistrictID($did);
        } else {
            $provinces = $this->provinces->with(['districts'])->get();
            // $this->authorize('manage-account-code');
            return view('pages/dashboard/dataentry')
                ->withProvinces($provinces);
        }
    }




    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analytics()
    {
        return view('pages/dashboard/analytics');
    }

    /**
     * Displays the fintech screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fintech()
    {
        return view('pages/dashboard/fintech');
    }
}
