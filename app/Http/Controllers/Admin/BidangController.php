<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    private function validasiBidang(Request $request)
    {
        $request->validate(
            [
                'bidang' => 'required',
            ]
        );
    }

    public function index()
    {
        $page = 'Bidang';
        $bidang = Bidang::latest()->get();
        return view('admin.bidang.index', compact('page', 'bidang'));
    }

    public function store(Request $request)
    {
        $this->validasiBidang($request);
        $data = [
            'bidang' => request('bidang'),
        ];
        $bidang = Bidang::create($data);
        if ($bidang) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Data Bidang');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambahkan Data Bidang');
        }
    }

    public function update(Request $request, $id)
    {
        $bidang = Bidang::findOrFail($id);

        $this->validasiBidang($request);

        $bidang->update([
            'bidang' => $request->bidang,
        ]);

        return redirect()->back()->with('success', 'Berhasil Merubah Data Bidang');
    }

    public function destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Bidang');
    }
}
