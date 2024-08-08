<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\DistrictProfileRepository;
use Modules\Configuration\Repositories\DistrictRepository;
use Modules\Configuration\Repositories\IndicatorsRepository;
use Modules\Configuration\Requests\District\Profile\StoreRequest;
use Modules\Configuration\Requests\District\Profile\UpdateRequest;

class DistrictProfileController extends Controller
{

    protected $indicators, $district, $profile;


    public function __construct(
        IndicatorsRepository $indicators,
        DistrictRepository $district,
        DistrictProfileRepository $profile,

    ) {
        $this->indicators = $indicators;
        $this->district = $district;
        $this->profile = $profile;
    }

    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {

        $profile = $this->profile->with(['district', 'indicator'])->orderby('district_id', 'asc')->get();

        // $this->authorize('manage-account-code');
        return view('Configuration::District.Profile.index')
            ->withProfile($profile);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $district = $this->district->all()->mapWithKeys(function ($district) {
            return [$district->id => $district->district];
        })->toArray();

        $indicators = $this->indicators->all();

     return view('Configuration::District.Profile.create')
            ->withDistricts($district)
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

        $input=$request->all();
        $isChecked = $request->has('displayinreport');
        if($isChecked){
            $input['displayinreport']=1;                  
        }
       
        // $this->authorize('manage-account-code');
        $districtprofile = $this->profile->create($request->all());
       
        

        if ($districtprofile) {
            return redirect()->route('districtprofile.index')->with('success', 'Added District Profile data successfully!');
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Account Code can not be added.'
        ], 422);
    }

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $districtprofile = $this->profile->find($id);
        return response()->json(['status' => 'ok', 'district' => $districtprofile], 200);
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
        $districts = $this->district->all()->mapWithKeys(function ($district) {
            return [$district->id => $district->district];
        })->toArray();

        $indicators = $this->indicators->all()->mapWithKeys(function ($indicator) {
            return [$indicator->id => $indicator->indicator_name];
        })->toArray();

        return view('Configuration::District.Profile.edit')
            ->withProfile($this->profile->find($id))
            ->withIndicators($indicators)
            ->withDistricts($districts);
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
        $input=$request->all();
        $isChecked = $request->has('displayinreport');
        if($isChecked){
            $input['displayinreport']=1;                  
        }
        else{
            $input['displayinreport']=0;     
        }

        $districtprofile = $this->profile->update($id, $input);

        if ($districtprofile) {
            return redirect()->route('districtprofile.index')->with('success', 'District Profile Updated successfully!');
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Account Code can not be updated.'
        ], 422);
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
        if ($flag) {
            return redirect()->route('districtprofile.index')->with('success', 'District Profile is successfully deleted.');
        }
        return response()->json([
            'type' => 'error',
            'message' => 'District can not deleted.',
        ], 422);
    }
}
