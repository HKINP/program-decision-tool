<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Configuration\Repositories\StagesRepository;
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
    protected $questions,$stages;
    

    public function __construct(
        QuestionRepository $questions,
        StagesRepository $stages
    )
    {
        $this->questions = $questions;
        $this->stages = $stages;
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
             return view('Configuration::Question.index')
            ->withQuestions($this->questions->orderby('question', 'asc')->get());
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions=$this->stages->all()->mapWithKeys(function($stages) {
            return [$stages->id => $stages->stages];
        })->toArray();;
        return view('Configuration::Question.create')
        ->withStages($questions);
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
      
        return view('Configuration::Question.edit')
            ->withQuestion($this->questions->find($id));
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
        $questions = $this->questions->update($request->get('id'), $request->except('id'));
        if($questions){
            return response()->json(['status' => 'ok',
                'Province' => $questions,
                'message' => 'Question is successfully updated.'], 200);
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
