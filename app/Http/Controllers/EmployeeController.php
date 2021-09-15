<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployee;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.manager');
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(CreateEmployee $request)
    {
        $employeeRoleId = Role::firstOrCreate(['title' => Role::EMPLOYEE])->id;

        User::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $employeeRoleId,
            'name' => Faker::create()->name()
        ]);

        return redirect()->to(RouteServiceProvider::HOME);
    }
}
