<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Modules\Configuration\Repositories\AccountCodeRepository;
use Modules\Configuration\Repositories\AwardCodeRepository;
use Modules\Configuration\Repositories\BudgetCodeRepository;
// use Modules\Configuration\Repositories\DepartmentRepository;
use Modules\Configuration\Repositories\MonitoringCodeRepository;
use Modules\Configuration\Repositories\OfficeRepository;
use Modules\Privilege\Repositories\RoleRepository;
use Modules\Privilege\Repositories\UserRepository;

use Modules\Privilege\Requests\SupportStaff\StoreRequest;
use Modules\Privilege\Requests\SupportStaff\UpdateRequest;

class SupportStaffController extends Controller
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
     * SupportStaffController constructor.
     *
     * @param AccountCodeRepository $accountCodes
     * @param AwardCodeRepository $awardCodes
     * @param BudgetCodeRepository $budgetCodes
     * @param DepartmentRepository $departments
     * @param MonitoringCodeRepository $monitoringCodes
     * @param OfficeRepository $offices
     * @param RoleRepository $roles
     * @param UserRepository $users
     */
    public function __construct(
        AccountCodeRepository $accountCodes,
        AwardCodeRepository $awardCodes,
        BudgetCodeRepository $budgetCodes,
        DepartmentRepository $departments,
        MonitoringCodeRepository $monitoringCodes,
        OfficeRepository $offices,
        RoleRepository $roles,
        UserRepository $users
    )
    {
        $this->accountCodes = $accountCodes;
        $this->awardCodes = $awardCodes;
        $this->budgetCodes = $budgetCodes;
        $this->departments = $departments;
        $this->monitoringCodes = $monitoringCodes;
        $this->offices = $offices;
        $this->roles = $roles;
        $this->users = $users;
    }

    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->with(['office','department'])
            ->where('support_staff', 1)
            ->get();
        return view('Privilege::SupportStaff.index')
                ->withUsers($users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Privilege::SupportStaff.add')
            ->withAccountCodes($this->accountCodes->where('is_active', '=', 1)->get())
            ->withAwardCodes($this->awardCodes->where('is_active', '=', 1)->get())
            ->withBudgetCodes($this->budgetCodes->where('is_active', '=', 1)->get())
            ->withDepartments($this->departments->select(['department_name', 'id'])->get())
            ->withMonitoringCodes($this->monitoringCodes->where('is_active', '=', 1)->get())
            ->withOffices($this->offices->select(['id', 'office_name'])->get());
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Modules\Privilege\Requests\User\StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $data['support_staff'] = 1;
        $user = $this->users->create($data);
        if($user) {
            return redirect()->route('support.staff.index')
                ->withSuccessMessage('Support staff is successfully added.');
        } else {
            return redirect()->back()->withInput()
                ->withWarningMessage('Support staff can not be added.');
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
        $user = $this->users->where('support_staff', '=', 1)->find($id);

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


        if($user) {
            return view('Privilege::SupportStaff.edit')
                ->withAccountCodes($this->accountCodes->where('is_active','=', 1)->get())
                ->withAwardCodes($this->awardCodes->where('is_active', '=', 1)->get())
                ->withBudgetCodes($budgetCodes)
                ->withDepartments($this->departments->select(['department_name', 'id'])->get())
                ->withMonitoringCodes($monitoringCodes)
                ->withOffices($this->offices->select(['id', 'office_name'])->get())
                ->withUser($user);
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
        $user = $this->users->update($id, $request->all());
        if($user) {
            return redirect()->route('support.staff.index')
                ->withSuccessMessage('Support staff is successfully updated.');
        } else {
            return redirect()->back()->withInput()
                ->withWarningMessage('Support staff can not be updated.');
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
}
