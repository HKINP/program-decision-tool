<?php

namespace Modules\Configuration\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Configuration\Repositories\ThematicAreaRepository;
use Modules\Configuration\Requests\TargetGroup\StoreRequest;
use Modules\Configuration\Requests\TargetGroup\UpdateRequest;

class QuestionApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  ThematicAreaRepository $targetgroups
     * @return void
     */
    protected $questions;
    

    public function __construct(
        QuestionRepository $questions
    )
    {
        $this->questions = $questions;
    }
    
   
    public function getbythematicareaID($id)
    {
        $questions = $this->questions
        ->where('thematic_area_id','=',$id)
        ->where('stage_id','=',1)
        ->get();
        return response()->json($questions);
    }

    
}