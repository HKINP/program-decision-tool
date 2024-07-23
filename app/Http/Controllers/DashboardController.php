<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFeed;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Repositories\StagesRepository;

class DashboardController extends Controller
{

    protected $provinces, $stages;


    public function __construct(

        ProvinceRepository $provinces,
        StagesRepository $stages

    ) {
        $this->provinces = $provinces;
        $this->stages = $stages;
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
            return view('pages/dashboard/toolscreate')
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
