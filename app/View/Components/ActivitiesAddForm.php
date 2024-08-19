<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActivitiesAddForm extends Component
{
    public $stageId;
    public $districtProfile;
    public $priorities;
    public $platforms;
    public $keybarriers;
    public $activities;

    public function __construct($stageId, $districtProfile, $priorities, $platforms,$keybarriers,$activities)
    {
        $this->stageId = $stageId;
        $this->districtProfile = $districtProfile;
        $this->priorities = $priorities;
        $this->platforms = $platforms;
        $this->keybarriers = $keybarriers;
        $this->activities = $activities;
    }

    public function render()
    {
        return view('components.activities-add-form');
    }
}
