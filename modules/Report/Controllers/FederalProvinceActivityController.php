<?php

namespace Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use Modules\Report\Requests\FederalProvinceActivity\StoreRequest;
use Modules\Report\Requests\FederalProvinceActivity\UpdateRequest;
use Modules\Configuration\Repositories\ActivitiesRepository;
use Modules\Configuration\Repositories\OutcomesRepository;
use Modules\Configuration\Repositories\ProvinceRepository;
use Modules\Report\Repositories\FederalProvinceActivityRepository;
use App\Constants;


class FederalProvinceActivityController extends Controller
{
    protected $province, $activity, $outcomes, $federalProvinceActivity;

    public function __construct(
        ProvinceRepository $province,
        ActivitiesRepository $activity,
        OutcomesRepository $outcomes,
        FederalProvinceActivityRepository $federalProvinceActivity
    ) {
        $this->province = $province;
        $this->activity = $activity;
        $this->outcomes = $outcomes;
        $this->federalProvinceActivity = $federalProvinceActivity;
    }

    /**
     * Display a listing of the activities.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = $this->federalProvinceActivity->get();
        return view('Report::FederalProvinceActivity.index')
        ->withActivities($activities);
    }
    /**
     * Display a listing of the activities.
     *
     * @return \Illuminate\Http\Response
     */
    public function federalActivities()
    {
        $outcomes = $query->get();
        $partners = Constants::PARTNERS;
        $activities = $this->federalProvinceActivity->where('implemented_by','=',1)->get();
        return view('Report::FederalProvinceActivity.Federal.index')
        ->withActivities($activities);
    }

    /**
     * Show the form for creating a new activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = $this->province->all();
        $activities = $this->activity->all();
        $outcomes = $this->outcomes->all();
        
        return view('report.federal_province_activities.create', compact('provinces', 'activities', 'outcomes'));
    }

    /**
     * Store a newly created activity in storage.
     *
     * @param  \Modules\Report\Requests\FederalProvinceActivity\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $this->federalProvinceActivity->create($validatedData);

        return redirect()->route('federal_province_activities.index')
                         ->with('success', 'Federal Province Activity created successfully!');
    }

    /**
     * Show the form for editing the specified activity.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = $this->federalProvinceActivity->find($id);
        $provinces = $this->province->getAll();
        $activities = $this->activity->getAll();
        $outcomes = $this->outcomes->getAll();

        return view('report.federal_province_activities.edit', compact('activity', 'provinces', 'activities', 'outcomes'));
    }

    /**
     * Update the specified activity in storage.
     *
     * @param  \Modules\Report\Requests\FederalProvinceActivity\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->federalProvinceActivity->update($id, $validatedData);

        return redirect()->route('federal_province_activities.index')
                         ->with('success', 'Federal Province Activity updated successfully!');
    }

    /**
     * Remove the specified activity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->federalProvinceActivity->delete($id);

        return redirect()->route('federal_province_activities.index')
                         ->with('success', 'Federal Province Activity deleted successfully!');
    }
}
