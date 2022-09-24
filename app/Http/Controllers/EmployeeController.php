<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Shift;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\EmployeeType;
use App\Models\ModelHasRole;
use Illuminate\Http\Request;
use App\Models\EmployeePosition;
use Illuminate\Support\Facades\DB;
use App\Models\AttendanceDeviceUser;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index', 'viewEmployee']]);
        $this->middleware('permission:employee-create', ['only' => ['createEmployee', 'addEmployee']]);
        $this->middleware('permission:employee-edit', ['only' => ['editEmployee', 'updateEmployee']]);
    }

    public function index()
    {
        $no = 1;
        $Employee = DB::table('employees')
            ->leftJoin('users', 'employees.user_id', '=', 'users.id')
            ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->select('employees.*', 'users.name', 'designations.designation', 'departments.department_name')
            ->get();

        return view('layouts.employee.employee', compact('Employee', 'no'));
    }

    public function viewEmployee($id)
    {

        $EmployeeData = DB::table('employees')
            ->leftJoin('users', 'employees.user_id', '=', 'users.id')
            ->leftJoin('designations', 'employees.designation_id', '=', 'designations.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->leftJoin('branches', 'employees.branch_id', '=', 'branches.id')
            ->leftJoin('shifts', 'employees.shift_id', '=', 'shifts.id')
            ->leftJoin('countries', 'employees.nationality', '=', 'countries.id')
            ->leftJoin('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
            ->leftJoin('employee_positions', 'employees.position_id', '=', 'employee_positions.id')
            ->leftJoin('department_sections', 'employees.dept_section_id', '=', 'department_sections.id')
            ->select(
                'employees.*',
                'users.name as employee_name',
                'users.email',
                'designations.designation',
                'departments.department_name',
                'department_sections.section_name',
                'branches.branch_name',
                'branches.branch_location',
                'shifts.shift_name',
                'countries.name as country_name',
                'employee_types.type',
                'employee_positions.position_name',
            )
            ->where('employees.id', $id)
            ->first();

        //dd($EmployeeData);

        return view('layouts.employee.view-single-employee', compact('EmployeeData'));
    }

    public function createEmployee()
    {
        // $AssignDeviceUID = Employee::OrderBy('dev_emp_id', 'ASC')->Distinct('dev_emp_id')->pluck('dev_emp_id');
        // $DeviceUID = AttendanceDeviceUser::WhereNotIn('user_id', $AssignDeviceUID)->OrderBy('user_id', 'ASC')->Distinct('user_id')->pluck('user_id');

        //dd($DeviceUID);
        $Role = Role::get();
        $Branch = Branch::get();
        $Designation = Designation::get();
        $EmployeeType = EmployeeType::get();
        $EmployeePosition = EmployeePosition::get();
        $Shift = Shift::get();
        $Country = Country::get();

        return view('layouts.employee.create-employee', compact('Role', 'Branch', 'EmployeeType', 'EmployeePosition', 'Designation', 'Shift', 'Country'));
    }

    public function addEmployee(Request $request)
    {
        if ($request->roles == '2') {
            $v_email = 'nullable';
            $v_password = 'nullable';
        } else {
            $v_email = 'required';
            $v_password = 'required';
        }



        $validateData = $request->validate(
            [
                'name' => 'required',
                'roles' => 'required',
                'dev_emp_id' => 'nullable|unique:employees,dev_emp_id',
                'email' => $v_email . '|email|unique:users,email',
                'password' => $v_password . '|same:password-confirm',


                'phone' => 'required|numeric|unique:employees,phone',
                'father_name' => 'nullable|string',
                'mother_name' => 'nullable|string',
                'nationality' => 'nullable|string',
                'nid' => 'nullable|numeric',
                'blood_group' => 'nullable',
                'religion' => 'nullable|string',
                'gender' => 'nullable',
                'marital_status' => 'nullable',
                'present_address' => 'nullable',
                'permanent_address' => 'nullable',
                'dob' => 'nullable|date_format:Y-m-d|before:' . date('2005-01-01'),
                'employee_type_id' => 'nullable',
                'employee_position' => 'nullable',
                'branch_id' => 'required',
                'designation_id' => 'required',
                'department_id' => 'required',
                'dept_section_id' => 'required',
                'shift_id' => 'required',
                'position_id' => 'nullable',
                'employee_prefix_id' => 'nullable|string',
                'joining_date' => 'nullable',
                'joining_salary' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'current_salary' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'emergency_contact_name' => 'nullable',
                'emergency_contact_relation' => 'nullable',
                'emergency_contact_phone' => 'nullable|numeric',
                'employee_image' => 'nullable|image|max:1024',
                'nid_file' => 'nullable|max:1024',
            ],
            [],
            [
                'user_id' => 'user name',
                'dev_emp_id' => 'device user id',
                'branch_id' => 'branch',
                'designation_id' => 'designation',
                'department_id' => 'department section',
                'dept_section_id' => 'shift',
                'shift_id' => 'shift',
                'shift_id' => 'shift',
                'nid' => 'NID/Birth Certificate',
                'dob' => 'Date of Birth',
                'nid_file' => 'file',
            ]
        );
        // dd($validateData);

        if (!is_Null($request->employee_image)) {
            $file = $request->employee_image->hashName();
            $request->file('employee_image')->storeAs('public/img/employee', $file);
        } else {
            $file = null;
        }

        if (!is_Null($request->nid_file)) {
            if ($request->is_nid == 'nid') {
                $nid_file = $request->nid_file->hashName();
                $request->file('nid_file')->storeAs('public/file/employee/nid', $nid_file);
                $bc_file = null;
            } elseif ($request->is_nid == 'bc') {
                $bc_file = $request->nid_file->hashName();
                $request->file('nid_file')->storeAs('public/file/employee/bc', $bc_file);
                $nid_file = null;
            }
        } else {
            $nid_file = null;
            $bc_file = null;
        }



        if ($request->roles == '2') {

            $random = mt_rand(100000, 999999);
            $string = Str::random(10);
            $new_email = $string . $random . '@gmail.com';

            $random_pass = mt_rand(10000000, 99999999);
            $new_pass = $random_pass;
        } else {
            $new_email = $request->email;
            $new_pass = $request->password;
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $new_email,
            'password' => Hash::make($new_pass)
        ]);
        $user->assignRole($request->roles);
        $user_id = User::Where('email', $new_email)->value('id');

        if ($request->is_nid == 'nid') {
            $nid = $request->nid;
            $bc = null;
        } elseif ($request->is_nid == 'bc') {
            $bc = $request->nid;
            $nid = null;
        }

        Employee::create(array_merge($validateData, ['nid' => $nid], ['birth_certificate' => $bc], ['employee_image' => $file], ['nid_file' => $nid_file], ['birth_file' => $bc_file], ['user_id' => $user_id]));

        return redirect('employees');
    }

    public function editEmployee($id)
    {
        $Branch = Branch::get();
        $EmployeeType = EmployeeType::get();
        $EmployeePosition = EmployeePosition::get();
        $Designation = Designation::get();
        $Shift = Shift::get();
        $Country = Country::get();

        $EmployeeData = DB::table('employees')
            ->leftJoin('users', 'employees.user_id', '=', 'users.id')
            ->select('employees.*', 'users.name', 'users.email')
            ->where('employees.id', $id)
            ->first();
        //dd($EmployeeData);
        // $AssignDeviceUID = Employee::Where('dev_emp_id', '!=', $EmployeeData->dev_emp_id)->OrderBy('dev_emp_id', 'ASC')->Distinct('dev_emp_id')->pluck('dev_emp_id');

        // $DeviceUID = AttendanceDeviceUser::WhereNotIn('user_id', $AssignDeviceUID)->OrderBy('user_id', 'ASC')->Distinct('user_id')->pluck('user_id');

        $Role_id = ModelHasRole::Where('model_id', $EmployeeData->user_id)->value('role_id');
        $Role = Role::get();

        if ($EmployeeData->nid) {
            $card = 'nidCard';
        } elseif ($EmployeeData->birth_certificate) {
            $card = 'bcCard';
        } else {
            $card = 'nidCard';
        }

        return view('layouts.employee.edit-employee', compact('EmployeeData', 'Role', 'Role_id', 'Branch', 'Designation', 'Shift', 'EmployeeType', 'EmployeePosition', 'Country'))->with('card', $card);
    }

    public function updateEmployee(Request $request)
    {

        $validateData = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $request->user_id,
                'password' => 'same:password-confirm',
                'roles' => 'required',
                'dev_emp_id' => 'nullable',

                'phone' => 'required|numeric',
                'father_name' => 'nullable|string',
                'mother_name' => 'nullable|string',
                'nationality' => 'nullable|string',
                'nid' => 'nullable|numeric',
                'blood_group' => 'nullable',
                'religion' => 'nullable|string',
                'gender' => 'nullable',
                'marital_status' => 'nullable',
                'present_address' => 'nullable',
                'permanent_address' => 'nullable',
                'dob' => 'nullable|date_format:Y-m-d|before:' . date('2005-01-01'),
                'employee_type_id' => 'nullable',
                'employee_position' => 'nullable',
                'branch_id' => 'required',
                'designation_id' => 'required',
                'department_id' => 'required',
                'dept_section_id' => 'required',
                'shift_id' => 'required',
                'position_id' => 'nullable',
                'employee_prefix_id' => 'nullable|string',
                'joining_date' => 'nullable',
                'joining_salary' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'current_salary' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'emergency_contact_name' => 'nullable',
                'emergency_contact_relation' => 'nullable',
                'emergency_contact_phone' => 'nullable|numeric',
                'employee_image' => 'nullable|image|max:1024',
                'nid_file' => 'nullable|max:1024',
            ],
            [],
            [
                'user_id' => 'user name',
                'branch_id' => 'branch',
                'designation_id' => 'designation',
                'department_id' => 'department section',
                'dept_section_id' => 'shift',
                'shift_id' => 'shift',
                'shift_id' => 'shift',
                'nid' => 'NID/Birth Certificate',
                'dob' => 'Date of Birth',
                'nid_file' => 'file',
            ]
        );

        if ($request->is_nid == 'nid') {
            $nid = $request->nid;
            $bc = null;
        } elseif ($request->is_nid == 'bc') {
            $bc = $request->nid;
            $nid = null;
        } else {
            $bc = null;
            $nid = null;
        }

        if (!is_Null($request->employee_image)) {
            if ($request->filename) {
                unlink(storage_path('app/public/img/employee/' . $request->filename));
            }

            $file = $request->employee_image->hashName();
            $request->file('employee_image')->storeAs('public/img/employee', $file);
        } else {
            $file = $request->filename;
        }

        if (!is_Null($request->nid_file)) {

            if ($request->is_nid == 'nid') {
                if ($request->nid_filename) {
                    unlink(storage_path('app/public/file/employee/nid/' . $request->nid_filename));
                }
                if ($request->bc_filename) {
                    unlink(storage_path('app/public/file/employee/bc/' . $request->bc_filename));
                }
                $nid_file = $request->nid_file->hashName();
                $request->file('nid_file')->storeAs('public/file/employee/nid', $nid_file);
                $bc_file = null;
            } elseif ($request->is_nid == 'bc') {
                if ($request->bc_filename) {
                    unlink(storage_path('app/public/file/employee/bc/' . $request->bc_filename));
                }
                if ($request->nid_filename) {
                    unlink(storage_path('app/public/file/employee/nid/' . $request->nid_filename));
                }
                $bc_file = $request->nid_file->hashName();
                $request->file('nid_file')->storeAs('public/file/employee/bc', $bc_file);
                $nid_file = null;
            }
        } else {
            if ($request->is_nid == 'nid') {

                if ($request->nid_filename) {
                    $nid_file = $request->nid_filename;
                    $bc_file = null;
                } else {
                    if ($request->nid_filename) {
                        unlink(storage_path('app/public/file/employee/nid/' . $request->nid_filename));
                    }
                    if ($request->bc_filename) {
                        unlink(storage_path('app/public/file/employee/bc/' . $request->bc_filename));
                    }
                    $nid_file = null;
                    $bc_file = null;
                }
            } elseif ($request->is_nid == 'bc') {
                if ($request->bc_filename) {
                    $bc_file = $request->bc_filename;
                    $nid_file = null;
                } else {
                    if ($request->nid_filename) {
                        unlink(storage_path('app/public/file/employee/nid/' . $request->nid_filename));
                    }
                    if ($request->bc_filename) {
                        unlink(storage_path('app/public/file/employee/bc/' . $request->bc_filename));
                    }
                    $bc_file = null;
                    $nid_file = null;
                }
            }
        }

        if (!empty($request->password)) {
            $user = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        } else {
            $user = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        $user = User::find($request->user_id);
        DB::table('model_has_roles')->where('model_id', $request->user_id)->delete();
        $user->assignRole($request->roles);

        $Employee = Arr::except($validateData, array('name', 'email', 'password', 'roles'));

        Employee::where('id', $request->id)->update(array_merge($Employee, ['nid' => $nid], ['birth_certificate' => $bc], ['employee_image' => $file], ['nid_file' => $nid_file], ['birth_file' => $bc_file]));
        return redirect('employees');
    }

    public function downloadEmployeeNid($id)
    {
        $file = Employee::where('user_id', $id)->value('nid_file');
        $path = storage_path('app/public/file/employee/nid/' . $file);
        return response()->download($path);
    }

    public function downloadEmployeeBc($id)
    {
        $file = Employee::where('user_id', $id)->value('birth_file');
        $path = storage_path('app/public/file/employee/bc/' . $file);
        return response()->download($path);
    }
}
