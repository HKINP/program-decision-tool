<?php

namespace App\Http\Middleware;

use App\Repositories\ActivityLogRepository;
use Closure;

class ActivityLogger
{
    protected $activityLogs;
    
    public function __construct(
        ActivityLogRepository $activityLogs
    ){
        $this->activityLogs = $activityLogs;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Do not log data table ajax requests
        if (strpos($request->fullUrl(), 'draw=') === false) {
            $data = [
                'user_id'=>auth()->id() ? auth()->id() : null,
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'route'=>$request->fullUrl(),
                'agent'=>$request->server('HTTP_USER_AGENT'),
            ];
            $this->activityLogs->create($data);
        }

        return $next($request);
    }
}
