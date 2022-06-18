<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function create() {
        return view('admin.member.insert', [
            'title' => 'Tambah Member'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_member' => 'required|size:6|unique:members',
            'nama' => 'required',
            'nomor' => 'required|unique:members'
        ]);
        $validateData['user_id'] = auth()->user()->id;
        Member::create($validateData);
        return redirect('/dashboard/member')->with('success',"Member berhasil ditambahkan!");
    }


    // harus diperbaiki
    public function edit(Member $member) {
        return view('admin.member.edit', [
            'title' => 'Edit Member',
            'members' => $member
        ]);
    }

    public function update (Request $request, Member $member)
    {
        $rules = [
            'nama' => 'required',
        ];

        // jika kode_buku nya berubah
        if ($request->kode_member != $member->kode_member) {
            $rules['kode_member'] = 'required|size:6|unique:members';
        }
        // jika isbn nya berubah
        if ($request->nomor != $member->nomor) {
            $rules['nomor'] = 'required|unique:members';
        }

        $validateData = $request->validate($rules);

        Member::where('id', $member->id)->update($validateData);

        return redirect('/dashboard/member')->with('success',"Member berhasil diperbaharui!");
    }

    public function destroy(Member $member)
    {
        // Storage::delete($property->photo);
        // Property::destroy($property->id);
        Member::destroy($member->id);
        return redirect('/dashboard/member')->with('success', 'Member berhasil dihapus!');
    }
    
}
