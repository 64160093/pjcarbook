<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $divisions = Division::all();
        $department = Department::all();
        $position = Position::all();
        $role = Role::all();
        return view('auth.register', [
            'divisions' => $divisions,
            'department' => $department,
            'position' => $position,
            'role' => $role,
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phonenumber' => ['required', 'string', 'max:15'],
            'division' => ['required', 'exists:division,division_id'],
            'department' => ['sometimes', 'required_if:division,6', 'exists:department,department_id'], // ตรวจสอบ department เฉพาะเมื่อ division เป็น 6
            'position' => ['required', 'exists:position,position_id'],
            'role' => ['required', 'exists:role,role_id'],
        ]);
    }

    protected function create(array $data)
    {
        \Log::info('Register Data:', $data);

        // ตั้งค่า department_id เป็น null หาก division ไม่ใช่ 6
        if ($data['division'] != 6) {
            $data['department'] = null;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => '0',
            'phonenumber' => $data['phonenumber'],
            'division_id' => $data['division'], // บันทึก division_id
            'department_id' => $data['department'],
            'position_id' => $data['position'] ,
            'role_id' => $data['role']
        ]);
    }
}
