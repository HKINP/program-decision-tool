<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Privilege\Repositories\UserRepository;
use Modules\Privilege\Requests\User\Department\UpdateRequest;

use Gate;

class UserDepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(
        UserRepository $users
    ){
        $this->users = $users;
    }

    /**
     * Show the form for editing the specified user department.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = $this->users->find($id);
        if($user){
            return view('Privilege::User.Department.edit')
                ->withUser($user)
                ->withDepartments($user->departments->pluck('department_name', 'id'));
        }
        if($request->isJson()){
            return response()->json([
                'status'=>'error',
                'message'=>'You are not authorized to edit.'
            ], 401);
        }
        return view('denied');
    }

    /**
     * Update the specified delegation in storage.
     *
     * @param  \Modules\Privilege\Requests\User\Department\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = $this->users->find($request->user_id);
        $user->update($request->all());
        if($user){
            return response()->json(['status' => 'ok',
                'user' => $user,
                'department' => $user->department ? $user->department->department_name : '',
                'message' => 'User department is successfully updated.'], 200);
        }
        if($request->wantsJson()){
            return response()->json([
                'status'=>'error',
                'message'=>'You are not authorized to update this delegation.'
            ], 401);
        }
        return view('denied');
    }
}
