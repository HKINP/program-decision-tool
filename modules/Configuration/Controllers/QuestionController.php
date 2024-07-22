<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Configuration\Repositories\StagesRepository;
use Modules\Configuration\Repositories\TagsRepository;
use Modules\Configuration\Repositories\TargetGroupRepository;
use Modules\Configuration\Repositories\ThematicAreaRepository;
use Modules\Configuration\Requests\Question\StoreRequest;
use Modules\Configuration\Requests\Question\UpdateRequest;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  QuestionRepository $questions
     * @return void
     */
    protected $questions,$stages,$tags,$targetgroups,$thematicareas;
    

    public function __construct(
        QuestionRepository $questions,
        StagesRepository $stages,
        TagsRepository $tags,
        ThematicAreaRepository $thematicareas,
        TargetGroupRepository $targetgroups
    )
    {
        $this->questions = $questions;
        $this->stages = $stages;
        $this->tags = $tags;
        $this->targetgroups = $targetgroups;
        $this->thematicareas = $thematicareas;
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

        $questions = $this->questions->with(['stage', 'thematicArea', 'tag', 'targetGroup'])
        ->orderBy('question', 'asc')
        ->get();
        // return response()->json(['status'=>'Good',
        //     'data'=>$questions], 200);

             return view('Configuration::Question.index')
            ->withQuestions($questions);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        // dd($this->stages->all());
        $stages=$this->stages->all()->mapWithKeys(function($stage) {
            return [$stage->id => $stage->stages];
        })->toArray();
     

        $tags=$this->tags->all()->mapWithKeys(function($tags) {
            return [$tags->id => $tags->tags];
        })->toArray();

        $thematicareas=$this->thematicareas->all()->mapWithKeys(function($thematicareas) {
            return [$thematicareas->id => $thematicareas->thematic_area];
        })->toArray();

        $targetgroups=$this->targetgroups->all()->mapWithKeys(function($targetgroups) {
            return [$targetgroups->id => $targetgroups->target_group];
        })->toArray();
        
        return view('Configuration::Question.create')
        ->withTags($tags)
        ->withThematicareas($thematicareas)
        ->withStages($stages)
        ->withTargetgroups($targetgroups);
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
        
        $questions = $this->questions->create($request->all());
        
        if($questions){
            return redirect()->route('question.index')->with('success', 'Question added  successfully!');
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
        $questions = $this->questions->find($id);
        return response()->json(['status'=>'ok','question'=>$questions], 200);
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
      
        // dd($this->stages->all());
        $stages=$this->stages->all()->mapWithKeys(function($stage) {
            return [$stage->id => $stage->stages];
        })->toArray();
     

        $tags=$this->tags->all()->mapWithKeys(function($tags) {
            return [$tags->id => $tags->tags];
        })->toArray();

        $thematicareas=$this->thematicareas->all()->mapWithKeys(function($thematicareas) {
            return [$thematicareas->id => $thematicareas->thematic_area];
        })->toArray();

        $targetgroups=$this->targetgroups->all()->mapWithKeys(function($targetgroups) {
            return [$targetgroups->id => $targetgroups->target_group];
        })->toArray();
        return view('Configuration::Question.edit')
            ->withQuestion($this->questions->find($id))
            ->withTags($tags)
            ->withThematicareas($thematicareas)
            ->withStages($stages)
            ->withTargetgroups($targetgroups);
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
        
        $questions = $this->questions->update($id, $request->except('id'));
        if($questions){            
                return redirect()->route('question.index')->with('success', 'Question Updated successfully!');
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
        $flag = $this->questions->destroy($id);
        if($flag){
            return redirect()->route('question.index')->with('success', 'Question is successfully deleted.');
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Account Code can not deleted.',
        ], 422);
    }
}
