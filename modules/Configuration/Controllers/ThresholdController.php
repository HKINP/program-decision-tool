<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Configuration\Repositories\QuestionRepository;
use Modules\Configuration\Repositories\ThresholdRepository;
use Modules\Configuration\Requests\Threshold\StoreRequest;
use Modules\Configuration\Requests\Threshold\UpdateRequest;

class ThresholdController extends Controller
{
    protected $threshold, $questions;

    public function __construct(
        ThresholdRepository $threshold,
        QuestionRepository $questions
    ) {
        $this->threshold = $threshold;
        $this->questions = $questions;
    }

    /**
     * Display a listing of the thresholds by question ID.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getThresholdbyQuestionId($id)
    {
        try {
            $threshold = $this->threshold->with(['stage', 'question'])
                ->where('question_id', $id)
                ->orderBy('id', 'asc')
                ->get();
                
            $question = $this->questions->find($id);

            if (!$question) {
                return response()->json(['status' => 'error', 'message' => 'Question not found.'], 404);
            }

            $stage_id = $question->stage_id;
            
            return view('Configuration::Threshold.index')
                ->withStageId($stage_id)
                ->withQuestionId($id)
                ->withThreshold($threshold);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new threshold.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('Configuration::Threshold.create');
    }

    /**
     * Store a newly created threshold in storage.
     *
     * @param  \Modules\Configuration\Requests\Threshold\StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->all();
            $max_value = $data['max_value'];
            $min_value = $data['min_value'];
            $color = $data['color'];
            $recommendation = $data['recommendation'];

            for ($i = 0; $i < count($min_value); $i++) {
                $inputs = [
                    'min_value' => $min_value[$i],
                    'max_value' => $max_value[$i],
                    'question_id' => $data['question_id'],
                    'stage_id' => $data['stage_id'],
                    'recommendation' => $recommendation[$i],
                    'color' => $color[$i],
                ];

                $this->threshold->create($inputs);
            }

            return redirect()->back()->with('success', 'Threshold Value has been successfully saved.');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified threshold.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        try {
            $threshold = $this->threshold->find($id);
            
            if (!$threshold) {
                return response()->json(['status' => 'error', 'message' => 'Threshold not found.'], 404);
            }

            return response()->json($threshold);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified threshold.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $threshold = $this->threshold->find($id);
            
            if (!$threshold) {
                return response()->json(['status' => 'error', 'message' => 'Threshold not found.'], 404);
            }

            return view('Configuration::Threshold.edit')
                ->withThreshold($threshold);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified threshold in storage.
     *
     * @param  \Modules\Configuration\Requests\Threshold\UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $updated = $this->threshold->update($id, $request->except('id'));
            
            if ($updated) {
                return redirect()->back()->with('success', 'Threshold Value is updated successfully.');
            }
            
            return response()->json(['status' => 'error', 'message' => 'Threshold Value cannot be updated.'], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified threshold from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deleted = $this->threshold->destroy($id);
            
            if ($deleted) {
                return redirect()->back()->with('success', 'Threshold Value is successfully deleted.');
            }
            
            return response()->json(['status' => 'error', 'message' => 'Threshold Value cannot be deleted.'], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
