<?php

namespace Modules\Configuration\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\ThematicAreaRepository;
use Modules\Configuration\Requests\TargetGroup\StoreRequest;
use Modules\Configuration\Requests\TargetGroup\UpdateRequest;

class ThematicAreaApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  ThematicAreaRepository $targetgroups
     * @return void
     */
    protected $thematicareas;
    

    public function __construct(
        ThematicAreaRepository $thematicareas
    )
    {
        $this->thematicareas = $thematicareas;
    }
    
   
    public function getbytargetId($id)
    {
        $thematicareas = $this->thematicareas->where('target_group_id','=',$id)->get();
        return response()->json($thematicareas);
    }

}
