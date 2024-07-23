<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

// use Modules\Configuration\Repositories\DepartmentRepository;
use Modules\Configuration\Repositories\OfficeRepository;
use Modules\Privilege\Repositories\RoleRepository;
use Modules\Privilege\Repositories\UserRepository;

class UserImportController extends Controller
{
    /**
     * UserImportController constructor.
     *
     * @param DepartmentRepository $departments
     * @param OfficeRepository $offices
     * @param RoleRepository $roles
     * @param UserRepository $users
     */
    public function __construct(
        // DepartmentRepository $departments,
        // OfficeRepository $offices,
        RoleRepository $roles,
        UserRepository $users
    ){
        // $this->departments = $departments;
        // $this->offices = $offices;
        // $this->roles = $roles;
        // $this->users = $users;
    }

    /**
     * Show page for importing items from excelsheet
     *
     */
    public function create()
    {
        return view('Privilege::User.import');
    }

    /**
     * Store supplier data from spreadsheet
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'attachment' => 'required|mimes:xls,xlsx',
        ]);

        $columns = [
            'full_name',
            'email_address',
            'phone_number',
            'designation',
            'office',
            'roles',
            'department',
            'employee_code',
            'active',
        ];

        $redirect = redirect()->route('user.index');

        $path = $request->file('attachment')->getRealPath();
        $collection = Excel::load($path, function ($reader) use ($columns) {
            $reader->select($columns);
        })->get()->filter();

        if (count($collection) > 0 && count($collection->first()) == count($columns)) {
            $userData = [];
            foreach ($collection as $index => $excelRow) {

                if (empty($excelRow->email_address)) {
                    $message = 'Users can not be imported successfully. Email address is empty.';
                    return $redirect->withWarningMessage($message);
                }

                $emailAddress = $this->users->findByField('email_address', $excelRow->email_address);
                if ($emailAddress) {
                    $message = 'Users can not be imported successfully. User with email address ' . $excelRow->email_address . ' already exists in the system.';
                    return $redirect->withWarningMessage($message);
                }

                $office = $this->offices->findByField('office_name', $excelRow->office);
                if (!$office) {
                    $message = 'Users can not be imported successfully. Office ' . $excelRow->office . ' does not exists in the system.';
                    return $redirect->withWarningMessage($message);
                }

                $department = $this->departments->findByField('department_name', $excelRow->department);
                if (!$department) {
                    $message = 'Users can not be imported successfully. Department ' . $excelRow->department . ' does not exists in the system.';
                    return $redirect->withWarningMessage($message);
                }

                $roles = explode(',', $excelRow->roles);
                $roleIds = $this->roles->select(['*'])
                    ->whereIn('role', $roles)
                    ->pluck('id');

                foreach ($columns as $id => $column) {
                    $data[$column] = $excelRow->$column;
                }
                unset($data['office']);
                unset($data['roles']);
                unset($data['department']);
                unset($data['active']);

                $data['is_active'] = $excelRow->active == 1 ? 1 :0;
                $data['office_id'] = $office->id;
                $data['department_id'] = $department->id;
                $data['roles'] = $roleIds;
                $data['password'] = bcrypt($excelRow->email_address);

                $user = $this->users->create($data);
                if (!$user) {
                    return $redirect->withWarningMessage('Users can not be imported. User with email address '.$excelRow->email_address.' can not imported.');
                }
            }
        } else {
            $redirect->withWarningMessage('It seems you have modified headings of the provided sheet or empty data.');
        }
        return $redirect;
    }

}
