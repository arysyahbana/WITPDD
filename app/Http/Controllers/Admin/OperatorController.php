<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    private function validasiOperator(Request $request, $passRule)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => $passRule,
            ]
        );
    }

    public function index()
    {
        $page = 'Operator';
        $operator = User::get();
        return view('admin.operator.index', compact('page', 'operator'));
    }

    public function store(Request $request)
    {
        $this->validasiOperator($request, 'required');

        $store = new User();
        $store->name = $request->input('name');
        $store->email = $request->input('email');
        $store->password = Hash::make($request->input('password'));
        $store->save();
        return redirect()->route('operator.index')->with('success', 'Berhasil Menambahkan Data Operator');
    }

    public function update(Request $request, $id)
    {
        $operator = User::findOrFail($id);
        $this->validasiOperator($request, 'sometimes');
        $operator->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('operator.index')->with('success', 'Berhasil Mengubah Data Operator');
    }

    public function destroy($id)
    {
        $operator = User::findOrFail($id);
        $operator->delete();
        return redirect()->route('operator.index')->with('success', 'Berhasil Menghapus Data Operator');
    }
}
