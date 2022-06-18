<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Book;
use App\Models\Collection;
use App\Models\Circulation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CirculationController extends Controller
{
    public function create(Collection $collection)
    {
        return view('admin.transaction.insert', [
            'title' => 'Pinjam Buku',
            'members' => Member::all(),
            'collections' => $collection
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_transaksi' => 'required|size:6|unique:circulations',
            'member_id' => 'required',
            'tgl_pinjam' => 'required',
            'durasi' => 'required'
        ]);
        
        $member = Member::firstWhere('id', $request->member_id);
        $cekMember = Circulation::where([['member_id', $member->id], ['status', 'Dipinjam']]);
        // jika member nya sudah meminjam buku sebanyak 3 kali
        if ($cekMember->count() >= 3) {
            return redirect('/dashboard/transaksi')->with('failed',"Member ini telah melebihi batas peminjaman!");
        }

        $collection = Collection::firstWhere('kode_koleksi', $request->kode_koleksi);
        $validateData['koleksi_id'] = $collection->id;
        $collection->status = 'Sedang Dipinjam';
        $collection->save();

        $validateData['tgl_kembali'] = Carbon::parse($validateData['tgl_pinjam'])->addDay($validateData['durasi']);

        $validateData['user_id'] = auth()->user()->id;
        Circulation::create($validateData);
        return redirect('/dashboard/transaksi')->with('success',"Transaksi berhasil ditambahkan!");
    }

    public function edit(Circulation $circulation)
    {
        //
    }

    public function update(Request $request, Circulation $circulation)
    {
        // dd($request);
        $validateData = $request->validate([
            'status' => 'required',
        ]);
        $validateData['tgl_kembali'] = today();

        $collection = Collection::firstWhere('id', $circulation->koleksi_id);
        $collection->status = 'Tersedia';
        $collection->save();

        Circulation::where('id', $circulation->id)->update($validateData);

        return redirect('/dashboard/transaksi')->with('success', 'Transaksi Sudah Selesai!');
    }

    public function destroy(Circulation $circulation)
    {
        if ($circulation->status === 'Dipinjam') {
            $collection = Collection::firstWhere('id', $circulation->koleksi_id);
            $collection->status = 'Tersedia';
            $collection->save();
        }

        Circulation::destroy($circulation->id);
        return redirect('/dashboard/transaksi')->with('success', 'Transaksi Berhasil Dihapus!');
    }
}
