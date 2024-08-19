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
use Modules\Configuration\Repositories\DistrictRepository;
// use Modules\Configuration\Repositories\DepartmentRepository;
// use Modules\Configuration\Repositories\AccountCodeRepository;
use Modules\Configuration\Repositories\MonitoringCodeRepository;
use Modules\Configuration\Repositories\ProvinceRepository;

class UserController extends Controller
{
    protected $users, $roles, $provinces, $districts;


    public function __construct(
        RoleRepository $roles,
        ProvinceRepository $provinces,
        UserRepository $users,
        DistrictRepository $districts,
    ) {
        $this->provinces = $provinces;
        $this->roles = $roles;
        $this->users = $users;
        $this->districts = $districts;
    }
    public function get(Request $request, $id = null)
    {


        $columns = array(
            0 => 'id',
            1 => 'full_name',
            2 => 'email_address',
            3 => 'role',
            4 => 'office',
            5 => 'department',
            6 => 'last_updated_by',
            7 => 'id',
        );

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = User::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $users =  User::where('id', 'LIKE', "%{$search}%")
                ->orWhere('full_name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = User::where('id', 'LIKE', "%{$search}%")
                ->orWhere('full_name', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($users)) {
            foreach ($users as $i => $user) {
                $show =  '#';
                $edit =  '#';
                // $show =  route('users.view',$user->id);
                // $edit =  route('users.edit',$user->id);

                $nestedData['id'] = $i + 1;
                $nestedData['full_name'] = $user->full_name;
                $nestedData['email_address'] = $user->email_address;
                $roles = '';
                if ($user->roles) {
                    foreach ($user->roles as $role) {
                        $roles .= $role->role . '<br/>';
                    }
                }

                $nestedData['role'] = $roles;
                $nestedData['office'] = $user->office ? $user->office->office_name : '';
                $nestedData['department'] = $user->getDepartmentName();
                $nestedData['last_updated_by'] = $user->updatedBy ? ($user->updatedBy->full_name . ' on ' . $user->updated_at) : 'NA';
                // $nestedData['last_updated_by'] = getLastUpdatedUser('Modules\Privilege\Models\User', $user->id);

                $options = '<a class="edit-user" href="' . route('user.edit', $user->id) .
                    '"title="Edit User"><i class="fa fa-lg fa-edit"></i></a>&nbsp;';
                $options .= '<a class="delete-user" href="javascript:;" id="' . $user->id . '"
                            title="Delete User"><i class="fa fa-lg fa-trash-o"></i></a>&nbsp;';

                if ($user->is_active == 1) {
                    $options .= '<a href="javascript:;" class="change-status" title="Deactivate"
                    id="' . $user->id . '"><i class="fa fa-lg fa-check-square-o"></i></a>';
                } else {
                    $options .= '<a href="javascript:;" class="change-status" title="Activate"
                    id="' . $user->id . '"><i class="fa fa-lg fa-ban"></i></a>';
                }

                $options .= '&nbsp;';
                $options .= '<a data-toggle="modal"
                        href="' . route('user.get.change.password', $user->id) . '"
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

        return view('Privilege::User.index')->withUsers($this->users->get());
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Privilege::User.add')
            ->withProvinces($this->provinces->get())
            ->withDistricts($this->districts->get())
            ->withRoles($this->roles->get());
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Modules\Privilege\Requests\User\StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        try {
            // Convert assignedProvince and assignedDistrict arrays to comma-separated strings
            $data = $request->except(['password', 'password_confirmation']);

            // Convert assignedProvince and assignedDistrict to comma-separated values
            if (isset($data['assignedProvince'])) {
                $data['assignedProvince'] = implode(',', $data['assignedProvince']);
            }

            if (isset($data['assignedDistrict'])) {
                $data['assignedDistrict'] = implode(',', $data['assignedDistrict']);
            }

            // Encrypt the password
            $data['password'] = bcrypt($request->password);

            // Create the user
            $user = $this->users->create($data);

            if ($user) {
                // If the user creation is successful
                return redirect()->route('user.index')
                    ->with('success', 'User is successfully added.');
            }
            return redirect()->back()->withInput()
                ->with('error', 'An error occurred while adding the user. Please try again.');
        } catch (\Exception $e) {

            // Log the error message for debugging purposes
            \Log::error('User creation failed: ' . $e->getMessage());

            // Return back with input and error message
            return redirect()->back()->withInput()
                ->withErrorMessage('An error occurred while adding the user. Please try again.');
        }
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->users->with(['roles'])->find($id);       
        if ($user) {
          
            return view('Privilege::User.edit')
            ->withProvinces($this->provinces->get())
            ->withDistricts($this->districts->get())
            ->withUser($user)
            ->withRoles($this->roles->all()) // Pass all roles as objects
            ->withUserRoleIds($user->roles->pluck('id')->toArray());
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
        $data=$request->all();
        // Convert assignedProvince and assignedDistrict to comma-separated values
        if (isset($data['assignedProvince'])) {
            $data['assignedProvince'] = implode(',', $data['assignedProvince']);
        }

        if (isset($data['assignedDistrict'])) {
            $data['assignedDistrict'] = implode(',', $data['assignedDistrict']);
        }

       
        $user = $this->users->update($id, $data);
        if($user) {
            return redirect()->route('user.index')
                ->with('success', 'User is successfully updated.');
        } else {
            return redirect()->back()->withInput()
                ->with('error','User can not be updated.');
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
        $flag = $this->users->destroy($id);

        if ($flag) {
            return redirect()->route('user.index')
                ->with('success', 'User is successfully added.');
        }
    }

    /**
     * Change status of the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        // $user = $this->users->changeStatus($id);
        // $message = ($user->is_active == 1) ? "User is activated successfully.": "User is deactivated successfully.";
        // if($user->support_staff == 1){
        //     $message = ($user->is_active == 1) ? "Support staff is activated successfully.": "Support staff is deactivated successfully.";
        // }
        // return response()->json(['status'=>'ok','user'=>$user, 'message'=>$message], 200); 
    }
}
