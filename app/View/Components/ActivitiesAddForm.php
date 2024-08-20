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
    public $stepRemarks;

    public function __construct($stageId, $districtProfile, $priorities, $platforms,$keybarriers,$activities,$stepRemarks)
    {
        $this->stageId = $stageId;
        $this->districtProfile = $districtProfile;
        $this->priorities = $priorities;
        $this->platforms = $platforms;
        $this->keybarriers = $keybarriers;
        $this->activities = $activities;
        $this->stepRemarks = $stepRemarks;
    }

    public function render()
    {
        return view('components.activities-add-form');
    }
}
