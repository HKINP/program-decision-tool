<?php
// app/Traits/StatusQueryTrait.php

namespace App\Traits;


use Modules\Report\Models\DistrictVulnerability;
use Modules\Report\Models\PrioritizedActivities as ModelsPrioritizedActivities;
use Modules\Report\Models\Priority;

trait StageStatus
{
    protected function getStatuses($districtId)
    {
        $vulnerabilityModel = new DistrictVulnerability();
        $prioritiesModel = new Priority();
        $prioritizedActivitiesModel = new ModelsPrioritizedActivities();        
        return [
            'districtvulnerability' => (int) $vulnerabilityModel->where('district_id', $districtId)->exists(),
            'prioritystatus' => (int) $prioritiesModel->where('district_id', $districtId)->exists(),
            'ir1status' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 3)->exists(),
            'ir2status' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 4)->exists(),
            'ir3status' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 5)->exists(),
            'ir4status' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 6)->exists(),
        ];
    }

    protected function getStageInfo($stageId, $districtId)
    {
        $statuses = $this->getStatuses($districtId);

        $showTick = false;
        $route = route('dataentrystage.create', ['stageId' => $stageId, 'did' => $districtId]);

        if ($stageId == 1 && $statuses['districtvulnerability']) {
            $showTick = true;
            $route = route('districtvulnerability.index', ['stageId' => $stageId, 'did' => $districtId]);
        } elseif ($stageId == 2 && $statuses['prioritystatus']) {
            $showTick = true;
            $route = route('priority.index', ['stageId' => $stageId, 'did' => $districtId]);
        } elseif ($stageId >= 3 && $statuses['prioritystatus']) {
            $showTick = $statuses["ir{$stageId}status"] ?? false;
            $route = route('prioritizedActivities.index', ['stageId' => $stageId, 'did' => $districtId]);
        }

        return [
            'route' => $route,
            'tick' => $showTick,
        ];
    }
}
