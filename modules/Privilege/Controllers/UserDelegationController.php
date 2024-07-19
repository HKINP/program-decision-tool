<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Privilege\Repositories\UserDelegationRepository;
use Modules\Privilege\Repositories\UserRepository;
use Modules\Privilege\Requests\Delegation\StoreRequest;
use Modules\Privilege\Requests\Delegation\UpdateRequest;

use Gate;

class UserDelegationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @param  UserDelegationRepository  $userDelegations
     * @return void
     */
    public function __construct(
        UserRepository $users,
        UserDelegationRepository $userDelegations
    ){
        $this->users = $users;
        $this->userDelegations = $userDelegations;
    }

    /**
     * Display a listing of the delegation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('view-delegation')) {
            $user = auth()->user();
            return view('Privilege::Delegation.index')
                ->withDelegations($this->userDelegations
                    ->where('from_user', '=', $user->id)
                    ->orWhere('to_user', $user->id)
                    ->get())
                ->withUser($user);
        }
        return response()->view('denied');
    }

    /**
     * Show the form for creating a new delegation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Privilege::Delegation.add')
            ->withUsers($this->users->where('office_id', '=', auth()->user()->office_id)
                ->whereNotIn('id', [auth()->id()])
                ->pluck('full_name', 'id'));
    }

    /**
     * Store a newly created delegation in storage.
     *
     * @param  \Modules\Privilege\Requests\Delegation\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $data['from_user'] = auth()->id();
        $delegation = $this->userDelegations->create($data);
        if($delegation){
            return response()->json(['status' => 'ok',
                'delegation' => $delegation,
                'fromUser' => $delegation->fromUser->full_name,
                'toUser' => $delegation->toUser->full_name,
                'message' => 'Authority delegation is successfully added.'], 200);
        }
        return response()->json(['status'=>'error',
            'message'=>'Authority delegation can not be added.'], 422);
    }

    /**
     * Display the specified delegation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delegation = $this->userDelegations->find($id);
        $this->authorize('view', $delegation);
    }

    /**
     * Show the form for editing the specified delegation.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $delegation = $this->userDelegations->find($id);
        if($this->authorize('update', $delegation)){
            return view('Privilege::Delegation.edit')
                ->withDelegation($delegation)
                ->withUsers($this->users->where('office_id', '=', auth()->user()->office_id)
                    ->whereNotIn('id', [auth()->id()])
                    ->pluck('full_name', 'id'));
        }

        if($request->isJson()){
            return response()->json([
                'status'=>'error',
                'message'=>'You are not authorized to edit this delegation.'
            ], 401);
        }
        return view('denied');
    }

    /**
     * Update the specified delegation in storage.
     *
     * @param  \Modules\Privilege\Requests\Delegation\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $delegation = $this->userDelegations->find($request->get('id'));
        if($this->authorize('update', $delegation)){
            $delegation = $this->userDelegations->update($request->get('id'), $request->except('id'));
            if($delegation){
                return response()->json(['status' => 'ok',
                    'delegation' => $delegation,
                    'toUser' => $delegation->toUser->full_name,
                    'message' => 'Authority delegation is successfully updated.'], 200);
            }
            return response()->json(['status'=>'error',
                'message'=>'Authority delegation can not be updated.'], 422);
        }
        if($request->wantsJson()){
            return response()->json([
                'status'=>'error',
                'message'=>'You are not authorized to update this delegation.'
            ], 401);
        }
        return view('denied');
    }

    /**
     * Remove the specified delegation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delegation = $this->userDelegations->find($id);
        $this->authorize('delete', $delegation);
        $flag = $this->userDelegations->destroy($id);
        if($flag){
            return response()->json([
                'type'=>'success',
                'message'=>'Authority delegation is successfully deleted.',
            ], 200);
        }
        return response()->json([
            'type'=>'error',
            'message'=>'Authority delegation can not deleted.',
        ], 422);
    }

    /**
     * Deactivate the specified delegation from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, $id)
    {
        $delegation = $this->userDelegations->find($request->get('id'));
        if($this->authorize('update', $delegation)){
            $delegation = $this->userDelegations->update($id, ['is_active'=>'0', 'end_date'=>date('Y-m-d')]);
            if($delegation){
                return response()->json(['status' => 'ok',
                    'delegation' => $delegation,
                    'message' => 'Authority delegation is deactivated successfully.'], 200);
            }
            return response()->json(['status'=>'error',
                'message'=>'Authority delegation can not be deactivated.'], 422);
        }
        if($request->wantsJson()){
            return response()->json([
                'status'=>'error',
                'message'=>'You are not authorized to deactivate this delegation.'
            ], 401);
        }
        return view('denied');
    }
}
