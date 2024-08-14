<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DistrictProfileCard extends Component
{
    public $districtprofile;
    public $districtVulnerability;

    public function __construct($districtprofile, $districtVulnerability)
    {
        $this->districtprofile = $districtprofile;
        $this->districtVulnerability = $districtVulnerability;
    }

    public function render()
    {
        return view('components.district-profile-card');
    }
}
