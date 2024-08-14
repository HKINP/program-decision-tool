<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActivitiesAddForm extends Component
{
    public $stageId;
    public $districtProfile;
    public $priorities;
    public $platforms;

    public function __construct($stageId, $districtProfile, $priorities, $platforms)
    {
        $this->stageId = $stageId;
        $this->districtProfile = $districtProfile;
        $this->priorities = $priorities;
        $this->platforms = $platforms;
    }

    public function render()
    {
        return view('components.activities-add-form');
    }
}
