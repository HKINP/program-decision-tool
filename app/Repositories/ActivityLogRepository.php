<?php
namespace App\Repositories;

use App\ActivityLog;

class ActivityLogRepository extends Repository
{
    public function __construct(ActivityLog $log)
    {
        $this->model = $log;
    }

    public function searchAndPaginate($data, $paginate)
    {
        $query = $this->model->with(['user'])
            ->selectRaw('*, DATE_FORMAT(created_at, "%D %b, %Y  %h:%i %p") as created_on');
        if (!empty($data['from_date']))
            $query->whereDate("created_at", '>=', $data['from_date']);
        if (!empty($data['to_date']))
            $query->whereDate("created_at", '<=', $data['to_date']);
        if (!empty($data['user_id']))
            $query->where("user_id", $data['user_id']);
        return $query->orderBy('created_at', 'desc')
            ->paginate($paginate);
    }
}