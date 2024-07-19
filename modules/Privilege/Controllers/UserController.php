<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;

use Modules\Privilege\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Privilege\Requests\User\StoreRequest;
use Modules\Privilege\Repositories\RoleRepository;
use Modules\Privilege\Repositories\UserRepository;
use Modules\Privilege\Requests\User\UpdateRequest;
use Modules\Configuration\Repositories\OfficeRepository;

use Modules\Configuration\Repositories\AwardCodeRepository;
use Modules\Configuration\Repositories\BudgetCodeRepository;

use Modules\Configuration\Repositories\DepartmentRepository;
// use Modules\Configuration\Repositories\AccountCodeRepository;
use Modules\Configuration\Repositories\MonitoringCodeRepository;

class UserController extends Controller
{
    /**
     * The role repository instance.
     *
     * @var RoleRepository
     */
    protected $roles;

    /**
     * The office repository instance.
     *
     * @var OfficeRepository
     */
    protected $offices;

    /**
     * The department repository instance.
     *
     * @var DepartmentRepository
     */
    protected $departments;

    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * UserController constructor.
     *
     * @param OfficeRepository $offices
     * @param RoleRepository $roles
     * @param UserRepository $users
     */
    public function __construct(
        RoleRepository $roles,
        UserRepository $users
    )
    {
        $this->offices = $offices;
        $this->roles = $roles;
        $this->users = $users;
    }
    public function get(Request $request,$id=null)
    {


        $columns = array( 
            0 =>'id', 
            1 =>'full_name',
            2=> 'email_address',
            3=> 'role',
            4=> 'office',
            5=> 'department',
            6=> 'last_updated_by',
            7=> 'id',
        );

        $totalData = User::count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {            
        $users = User::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
        $search = $request->input('search.value'); 

        $users =  User::where('id','LIKE',"%{$search}%")
                    ->orWhere('full_name', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        $totalFiltered = User::where('id','LIKE',"%{$search}%")
                    ->orWhere('full_name', 'LIKE',"%{$search}%")
                    ->count();
        }

        $data = array();
        if(!empty($users)){
            foreach ($users as $i => $user){
                $show =  '#';
                $edit =  '#';
                // $show =  route('users.view',$user->id);
                // $edit =  route('users.edit',$user->id);

                $nestedData['id'] = $i+1;
                $nestedData['full_name'] = $user->full_name;
                $nestedData['email_address'] = $user->email_address;
                $roles = '';
                if($user->roles){
                    foreach($user->roles as $role){
                        $roles .= $role->role.'<br/>';
                    }
                }

                $nestedData['role'] = $roles;
                $nestedData['office'] = $user->office ? $user->office->office_name : '';
                $nestedData['department'] = $user->getDepartmentName();
                $nestedData['last_updated_by'] = $user->updatedBy ? ($user->updatedBy->full_name .' on ' . $user->updated_at) : 'NA';
                // $nestedData['last_updated_by'] = getLastUpdatedUser('Modules\Privilege\Models\User', $user->id);

                $options = '<a class="edit-user" href="'.route('user.edit', $user->id).
                            '"title="Edit User"><i class="fa fa-lg fa-edit"></i></a>&nbsp;';
                $options .= '<a class="delete-user" href="javascript:;" id="'.$user->id .'"
                            title="Delete User"><i class="fa fa-lg fa-trash-o"></i></a>&nbsp;';

                if($user->is_active == 1){
                    $options .= '<a href="javascript:;" class="change-status" title="Deactivate"
                    id="'.$user->id.'"><i class="fa fa-lg fa-check-square-o"></i></a>';
                }else{
                    $options .= '<a href="javascript:;" class="change-status" title="Activate"
                    id="'.$user->id.'"><i class="fa fa-lg fa-ban"></i></a>';
                }
                
                $options .= '&nbsp;';
                $options .= '<a data-toggle="modal"
                        href="'.route('user.get.change.password', $user->id).'"
                        data-target="#changePasswordModal" title="Change Password of User">
                        <i class="fa fa-lg fa-lock" aria-hidden="true"></i>
                        </a>';

                $nestedData['options'] = $options;
                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );

        return response()->json($json_data);
    }


    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       
        return view('Privilege::User.index');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Privilege::User.add')
            ->withAccountCodes($this->accountCodes->where('is_active', '=', 1)->get())
            ->withAwardCodes($this->awardCodes->where('is_active', '=', 1)->get())
            ->withBudgetCodes($this->budgetCodes->where('is_active', '=', 1)->get())
            ->withDepartments($this->departments->select(['department_name', 'id'])->get())
            ->withMonitoringCodes($this->monitoringCodes->where('is_active', '=', 1)->get())
            ->withRoles($this->roles->get())
            ->withOffices($this->offices->where('is_active', '=', 1)->get())
            ;
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Modules\Privilege\Requests\User\StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->except(['password', 'confirm_password']);
        $data['password'] = bcrypt($request->password);
        $user = $this->users->create($data);
        if($user) {
            return redirect()->route('user.index')
                ->withSuccessMessage('User is successfully added.');
        } else {
            return redirect()->back()->withInput()
                ->withWarningMessage('User can not be added.');
        }
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->users->where('support_staff', '=', 0)->find($id);

        $award_ids = $user->awardCodes->pluck('id')->toArray();

        $awardCodes = $this->awardCodes->whereIn('id',$award_ids)->with('budgetCodes','monitoringCodes')->get();

        $budget_ids = [];
        $monitoring_ids = [];

        foreach ($awardCodes as $key => $awardCode) {
            $budgets = $awardCode->budgetCodes->pluck('id')->toArray();
            $monitorings = $awardCode->monitoringCodes->pluck('id')->toArray();

            $budget_ids = array_merge($budgets,$budget_ids);
            $monitoring_ids = array_merge($monitorings,$monitoring_ids);

        }

        $budget_ids = array_unique($budget_ids);
        $monitoring_ids = array_unique($monitoring_ids);

        $budgetCodes = $this->budgetCodes->whereIn('id',$budget_ids)->get();
        $monitoringCodes = $this->monitoringCodes->whereIn('id',$monitoring_ids)->get();

        if($user){
            return view('Privilege::User.edit')
                ->withAccountCodes($this->accountCodes->where('is_active', '=', 1)->get())
                ->withAwardCodes($this->awardCodes->where('is_active', '=', 1)->get())
                ->withBudgetCodes($budgetCodes)
                ->withDepartments($this->departments->select(['department_name', 'id'])->get())
                ->withMonitoringCodes($monitoringCodes)
                ->withRoles($this->roles->get())
                ->withOffices($this->offices->where('is_active', '=', 1)->get())
                ->withUser($user)
                ->withUserRoles($user->roles ? $user->roles->pluck('id')->toArray() : [])
                ;
        }
        return response()->view('denied');
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Modules\Privilege\Requests\User\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = $this->users->update($id, $request->except('username'));
        if($user) {
            return redirect()->route('user.index')
                ->withSuccessMessage('User is successfully updated.');
        } else {
            return redirect()->back()->withInput()
                ->withWarningMessage('User can not be updated.');
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->users->destroy($id);
    }

    /**
     * Change status of the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $user = $this->users->changeStatus($id);
        $message = ($user->is_active == 1) ? "User is activated successfully.": "User is deactivated successfully.";
        if($user->support_staff == 1){
            $message = ($user->is_active == 1) ? "Support staff is activated successfully.": "Support staff is deactivated successfully.";
        }
        return response()->json(['status'=>'ok','user'=>$user, 'message'=>$message], 200); 
    }
    
}
