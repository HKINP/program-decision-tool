<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Exports\Export;

// use Modules\Configuration\Repositories\DepartmentRepository;
use Modules\Configuration\Repositories\OfficeRepository;
use Modules\Privilege\Repositories\RoleRepository;
use Modules\Privilege\Repositories\UserRepository;

class UserExportController extends Controller
{
    /**
     * UserExportController constructor.
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
     * Store supplier data from spreadsheet
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $users = $this->users->get();

        $data = [];

        $data[] = [
            'SN',
            'Name',
            'Email Address',
            'Phone Number',
            'Designation',
            'Office',
            'Roles',
            'Department',
            'Employee Code'
        ];

        foreach ($users as $index => $record) {
            $data[] = [
                $index + 1,
                $record->full_name,
                $record->email_address,
                $record->phone_number,
                $record->designation,
                $record->getOfficeName(),
                implode(',',$record->roles()->pluck('role')->toArray()),
                $record->department->name,
                $record->employee_code
            ];
        }

        $properties = [
            'title' => 'users',
            'description' => 'users'
        ];

        $export = new Export($data,$properties);

        return Excel::download($export, 'users.xlsx');

        // Excel::create('Users', function ($excel) use ($data) {
        //     $excel->setTitle('Users');
        //     $excel->setCreator(config('app.name'))
        //         ->setCompany(config('app.name'));
        //     $excel->sheet('Items', function ($sheet) use ($data) {
        //         $sheet->setOrientation('landscape');
        //         $sheet->fromArray($data);
        //     });
        // })->export('xls');
    }

}
