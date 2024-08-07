<?php

namespace Modules\Configuration\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Configuration\Repositories\TargetGroupRepository;
use Modules\Configuration\Repositories\ThematicAreaRepository;
use Modules\Configuration\Requests\ThematicArea\StoreRequest;
use Modules\Configuration\Requests\ThematicArea\UpdateRequest;

class ThematicAreaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  ThematicAreaRepository $thematicareas
     * @return void
     */
    protected $thematicareas, $targetgroups;


    public function __construct(
        ThematicAreaRepository $thematicareas,
        TargetGroupRepository $targetgroups,

    ) {
        $this->thematicareas = $thematicareas;
        $this->targetgroups = $targetgroups;
    }

    /**
     * Display a listing of the account codes.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {

        $thematicareas = $this->thematicareas->with(['targetGroups'])->orderby('thematic_area', 'asc')->get();

        // return response()->json(['status' => 'ok', 'thematicarea' => $thematicareas], 200);
        // $this->authorize('manage-account-code');
        return view('Configuration::ThematicArea.index')
            ->withThematicareas($thematicareas);
    }

    /**
     * Show the form for creating a new account head.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $targetgroups = $this->targetgroups->pluck('target_group', 'id')->toArray();
        return view('Configuration::ThematicArea.create')
            ->withTargetGroups($targetgroups);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Modules\Configuration\Requests\District\StoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {

        // Extract only the thematic_area from the request
        $thematicAreaData = $request->only('thematic_area');
        // Create a new ThematicArea
        $thematicArea = $this->thematicareas->create($thematicAreaData);
        // Extract target group IDs from the request
        $targetGroupIds = collect($request->input('target_group_id'))->flatten()->all();

        // Attach target groups to the thematic area
        if ($thematicArea) {
            $thematicArea->targetGroups()->attach($targetGroupIds);

            return redirect()->route('thematicarea.index')->with('success', 'Added Thematic Area successfully!');
        }
        return redirect()->route('thematicarea.index')->with('error', 'Added Thematic Area successfully!');
    }

    /**
     * Display the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thematicarea = $this->thematicareas->find($id);
        return response()->json(['status' => 'ok', 'thematicarea' => $thematicarea], 200);
    }

    /**
     * Show the form for editing the specified account head.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $targetgroups = $this->targetgroups->pluck('target_group', 'id')->toArray();
        return view('Configuration::ThematicArea.edit')
            ->withThematicArea($this->thematicareas->find($id))
            ->withTargetGroups($targetgroups);
    }

    /**
     * Update the specified account head in storage.
     *
     * @param  \Modules\Configuration\Requests\District\UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $id)
    {
        // $this->authorize('manage-account-code');
        // Find the ThematicArea by ID
        $thematicArea = $this->thematicareas->find($id);

        // $thematicareas = $this->thematicareas->update($id, $request->except('id
        // Update the ThematicArea
        $thematicArea->update([
            'thematic_area' => $request->input('thematic_area'),
        ]);
        if (!$thematicArea) {
            return response()->json(['status' => 'error', 'message' => 'Thematic Area not found.'], 404);
        }

        // Update the ThematicArea
        $thematicArea->update([
            'thematic_area' => $request->input('thematic_area'),
        ]);

        // Extract target group IDs from the request
        $targetGroupIds = collect($request->input('target_group_id'))->flatten()->all();

        // Sync target groups with the thematic area
        $thematicArea->targetGroups()->sync($targetGroupIds);

        // Redirect or return a response
        return redirect()->route('thematicarea.index')->with('success', 'Thematic Area updated successfully!');
    }

    /**
     * Remove the specified account head from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        // $this->authorize('manage-account-code');
        $flag = $this->thematicareas->destroy($id);
        if ($flag) {
            return redirect()->route('thematicarea.index')->with('success', 'Thematic Area is successfully deleted.');
        }
        return response()->json([
            'type' => 'error',
            'message' => 'District can not deleted.',
        ], 422);
    }
}
