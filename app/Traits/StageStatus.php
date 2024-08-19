<?php
// app/Traits/StatusQueryTrait.php

namespace App\Traits;


use Modules\Report\Models\DistrictVulnerability;
use Modules\Report\Models\StepRemarks as ModelsPrioritizedActivities;
use Modules\Report\Models\Priority;

trait StageStatus
{
    protected function getStatuses($districtId)
    {
        $vulnerabilityModel = new DistrictVulnerability();
        $prioritiesModel = new Priority();
        $prioritizedActivitiesModel = new ModelsPrioritizedActivities();
        return [
            'districtvulnerability' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 1)->where('stage_status', 1)->exists(),
            'prioritystatus' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 2)->where('stage_status', 1)->exists(),
            'ir1status' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 3)->where('stage_status', 1)->exists(),
            'ir2status' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 4)->where('stage_status', 1)->exists(),
            'ir3status' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 5)->where('stage_status', 1)->exists(),
            'ir4status' => (int) $prioritizedActivitiesModel->where('district_id', $districtId)->where('stage_id', 6)->where('stage_status', 1)->exists(),
        ];
    }
    protected function getStageInfo($stageId, $districtId)
    {
        $statuses = $this->getStatuses($districtId);
        
        $showTick = false;
    
        // Define static route mappings based on stageId
        $routes = [
            1 => 'districtvulnerability.index',
            2 => 'priority.index',
            3 => 'prioritizedActivities.index',
            4 => 'prioritizedActivities.index',
            5 => 'prioritizedActivities.index',
            6 => 'prioritizedActivities.index',
        ];
    
        // Default route
        $route = route('dataentrystage.create', ['stageId' => $stageId, 'did' => $districtId]);
    
        // Determine the correct key for stages 3 to 6
        $statusKey = ($stageId >= 3 && $stageId <= 6) ? 'ir' . ($stageId - 2) . 'status' : null;
        
    
        // Check if all statuses are 1
        $allStatusesAreOne = true;
        foreach ($statuses as $key => $value) {
            if ($value !== 1) {
                $allStatusesAreOne = false;
                break;
            }
        }
    
        // Determine if we need to show a tick and set the appropriate route
        if ($stageId == 1 && !empty($statuses['districtvulnerability'])) {
            $showTick = true;
            $route = route($routes[$stageId], ['stageId' => $stageId, 'did' => $districtId]);
        } elseif ($stageId == 2 && !empty($statuses['prioritystatus'])) {
            $showTick = true;
            $route = route($routes[$stageId], ['stageId' => $stageId, 'did' => $districtId]);
        }elseif ($stageId == 3 && !empty($statuses['ir1status'])) {
            $showTick = true;
            $route = route($routes[$stageId], ['stageId' => $stageId, 'did' => $districtId]);
         }elseif ($stageId == 4 && !empty($statuses['ir2status'])) {
            $showTick = true;
            $route = route($routes[$stageId], ['stageId' => $stageId, 'did' => $districtId]);
        }elseif ($stageId == 5 && !empty($statuses['ir3status'])) {
            $showTick = true;
            $route = route($routes[$stageId], ['stageId' => $stageId, 'did' => $districtId]);
        }elseif ($stageId == 6 && !empty($statuses['ir4status'])) {
            $showTick = true;
            $route = route($routes[$stageId], ['stageId' => $stageId, 'did' => $districtId]);
        }  
        return [
            'route' => $route,
            'tick' => $showTick,
        ];
    }
    
    
}
