<?php
namespace Modules\Configuration\Repositories;

use App\Repositories\Repository;
use Modules\Configuration\Models\Question;

class QuestionRepository extends Repository
{
    public function __construct(Question $question)
    {
        $this->model = $question;
    }
   
    public function syncStages($question,$stages){
        return $question->stages()->sync($stages);
    }
}