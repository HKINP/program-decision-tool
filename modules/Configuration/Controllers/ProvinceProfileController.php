<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Repositories\IndicatorsRepository;
use Modules\Configuration\Repositories\ProvinceProfileRepository;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Configuration\Requests\Province\Profile\StoreRequest;
use Modules\Configuration\Requests\Province\Profile\UpdateRequest;

class ProvinceProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  province $provinceprofiles
     * @return void
     */
    protected $indicators,$provinces,$profile;
    

    public function __construct(
        IndicatorsRepository $indicators,
        ProvinceRepository $provinces,
        ProvinceProfileRepository $profile,

    )
    {
        $this->indicators = $indicators;
        $this->provinces=$provinces;
        $this->profile=$profile;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
       $profile=$this->profile->with(['province','indicator'])->orderby('province_id', 'asc')->get();
    
        // $this->authorize('manage-account-code');
             return view('Configuration::Province.Profile.index')
            ->withProfile($profile);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces=$this->provinces->all()->mapWithKeys(function($province) {
            return [$province->id => $province->province];
        })->toArray();

        $indicators=$this->indicators->all();

        return view('Configuration::Province.Profile.create')
        ->withProvinces($provinces)
        ->withIndicators($indicators);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Modules\Configuration\Requests\District\StoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        // Retrieve all data from the request
        $data = $request->all();
    
        // Extract individual arrays
        $indicatorIds = $data['indicator_id'];
        $allValues = $data['all_value'];
        $ruralValues = $data['rural_value'];
        $sources = $data['source'];
    
            // Loop through each array to create indicator records
            for ($i = 0; $i < count($indicatorIds); $i++) {
                $inputs = [
                    'province_id' => $data['province_id'], // Link to the created profile
                    'indicator_id' => $indicatorIds[$i],
                    'all_value' => $allValues[$i],
                    'rural_value' => $ruralValues[$i],
                    'source' => $sources[$i],
                ];
    
                $this->profile->create($inputs);
            }
    
            return redirect()->route('provinceprofile.index')
                             ->with('success', 'Added Province Profile data successfully!');
       
     
    }
    
    
    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provinceprofile = $this->profile->find($id);
        return response()->json(['status'=>'ok','district'=>$provinceprofile], 200);
    }

    /**
     * Show the form for editing the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        // $this->authorize('manage-account-code');
        $provinces=$this->provinces->all()->mapWithKeys(function($province) {
            return [$province->id => $province->province];
        })->toArray();

        $indicators=$this->indicators->all()->mapWithKeys(function($indicator) {
            return [$indicator->id => $indicator->indicator_name];
   })->toArray();
        
        return view('Configuration::Province.Profile.edit')
            ->withProfile($this->profile->find($id))
            ->withIndicators($indicators)
            ->withProvinces($provinces);
    }

    /**
     * Update the specified account head in storage.
     *
     * @param  \Modules\Configuration\Requests\District\UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $id)
    {
         // $this->authorize('manage-account-code');
     
        
         $provinceprofile = $this->profile->update($id, $request->except(['id', 'province_id','indicator_id']));
       
         if($provinceprofile){
             return redirect()->route('provinceprofile.index')->with('success', 'Provice Profile Updated successfully!');
         }
         return response()->json(['status'=>'error',
             'message'=>'Account Code can not be updated.'], 422);
     }
   
    

    /**
     * Remove the specified account head from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        // $this->authorize('manage-account-code');
        $flag = $this->profile->destroy($id);
        if($flag){
            return redirect()->route('provinceprofile.index')->with('success', 'Province Profile is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'District can not deleted.',
        ], 422);
    }
}
