<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Question;
use Modules\Configuration\Models\Threshold;

class QuestionRepository extends Repository
{

    protected $threshold;

    public function __construct(Question $question)
    {
        $this->model = $question;
    }
   
    public function syncStages($question,$stages){
        return $question->stages()->sync($stages);
    }
     /**
     * Get color based on the question ID and response value.
     *
     * @param int $questionId
     * @param float $responseValue
     * @return string|null
     */
    public function getColor($questionId, $responseValue)
    {
        // Fetch thresholds for the given question
        $thresholds = Threshold::where('question_id', $questionId)->get();

        // Determine color for the response value
        foreach ($thresholds as $threshold) {
            if ($responseValue >= $threshold->min_value && $responseValue <= $threshold->max_value) {
                return $threshold->color;
            }
        }

        return null;
    }

    /**
     * Get recommendation based on the question ID and response value.
     *
     * @param int $questionId
     * @param float $responseValue
     * @return string|null
     */
    public function getRecommendation($questionId, $responseValue)
    {
        // Fetch thresholds for the given question
        $thresholds = Threshold::where('question_id', $questionId)->get();

        // Determine recommendation for the response value
        foreach ($thresholds as $threshold) {
            if ($responseValue >= $threshold->min_value && $responseValue <= $threshold->max_value) {
                return $threshold->recommendation;
            }
        }

        return null;
    }
}