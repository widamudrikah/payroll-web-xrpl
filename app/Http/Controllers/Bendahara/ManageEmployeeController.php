<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageEmployeeController extends Controller
{
    public function index() {
        $employees = Employee::all();
        return view('bendahara.employee.index', compact('employees'));
    }

    // menampilkan form tambah karyawan
    public function create() {
        return view('bendahara.employee.create');
    }

    // proses simpan data
    public function store(StoreKaryawanRequest $request) {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'karyawan',
        ]);

        Employee::create([
            'user_id'       => $user->id,
            'jabatan'       => $request->jabatan,
            'gaji_pokok'    => $request->gaji_pokok
        ]);
        return redirect()->route('manage.employee.index')->with('message', 'Berhasil menambahkan data karyawan');
    }

    // menampilkan form edit data
    public function edit($id) {
        $employee = Employee::findOrFail($id);
        return view('bendahara.employee.edit', compact('employee'));
    }

    // proses update data
    public function update(UpdateKaryawanRequest $request, $id) {
        $employee = Employee::with('user')->findOrFail($id);

        $employee->user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $employee->user->password,
        ]);

        $employee->update([
            'jabatan'   => $request->jabatan,
            'gaji_pokok'    => $request->gaji_pokok
        ]);

        return redirect()->route('manage.employee.index')->with('message', 'Berhasil update data karyawan');
    }
}
