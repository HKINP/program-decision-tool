<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\IndicatorsRepository;
use Modules\Configuration\Repositories\StagesRepository;
use Modules\Configuration\Repositories\ThematicAreaRepository;
use Modules\Configuration\Requests\Indicators\StoreRequest;
use Modules\Configuration\Requests\Indicators\UpdateRequest;

class IndicatorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  IndicatorsRepository $indicators
     * @return void
     */
    protected $stages,$thematicareas,$indicators;
    

    public function __construct(
        StagesRepository $stages,
        ThematicAreaRepository $thematicareas,
        IndicatorsRepository $indicators,
    )
    {
        $this->stages = $stages;
        $this->thematicareas = $thematicareas;
        $this->indicators=$indicators;
    }
    
    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        
        // $this->authorize('manage-account-code');

        $indicators = $this->indicators->orderBy('id', 'asc')->get();
        // return response()->json(['status'=>'Good',
        //     'data'=>$indicators], 200);

             return view('Configuration::Indicators.index')
            ->withIndicators($indicators);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
             
        return view('Configuration::Indicators.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Modules\Configuration\Requests\Question\StoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        // $this->authorize('manage-account-code');
        
        $indicators = $this->indicators->create($request->all());
        
        if($indicators){
            return redirect()->route('indicators.index')->with('success', 'Indicator added  successfully!');
        }
        return response()->json(['status'=>'error',
            'message'=>'Account Code can not be added.'], 422);
    }

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $indicators = $this->indicators->find($id);
        return response()->json(['status'=>'ok','indicators'=>$indicators], 200);
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
      
        
        $stages=$this->stages->all()->mapWithKeys(function($stage) {
            return [$stage->id => $stage->stages];
        })->toArray();

        $thematicareas=$this->thematicareas->all()->mapWithKeys(function($thematicareas) {
            return [$thematicareas->id => $thematicareas->thematic_area];
        })->toArray();

       
        return view('Configuration::Indicators.edit')
            ->withIndicators($this->indicators->find($id))
            ->withThematicareas($thematicareas)
            ->withStages($stages);
    }

    /**
     * Update the specified account head in storage.
     *
     * @param  \Modules\Configuration\Requests\Province\UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $id)
    {
        
        $indicators = $this->indicators->update($id, $request->except('id'));
        if($indicators){            
                return redirect()->route('indicators.index')->with('success', 'Indicators Updated successfully!');
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
       
        $flag = $this->indicators->destroy($id);
        if($flag){
            return redirect()->route('indicators.index')->with('success', 'Indicators is successfully deleted.');
        }
       
    }
}
