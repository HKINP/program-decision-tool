<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait FiltersActivities
{
    /**
     * Filters activities based on the authenticated user's permission and districts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByPermissionAndDistrict($query)
    {
        $user = Auth::user(); // Get the authenticated user

        // Check if the user has 'abc' permission
        if ($user && $user->hasPermission('abc')) {
            // Filter activities by user's assigned districts
            return $query->whereIn('district_id', $user->districts->pluck('id'));
        }

        // If the user doesn't have 'abc' permission, return an empty query
        return $query->whereRaw('1 = 0');
    }
}
