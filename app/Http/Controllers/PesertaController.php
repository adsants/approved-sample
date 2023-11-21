<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peserta;
use App\Models\Peserta_history;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;



class PesertaController extends Controller
{
    public function form()
    {        
        return view('form');
    }
    
    public function approved()
    {
        $dataPesertas = Peserta::latest()->paginate(20);
        return view('approved', compact('dataPesertas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'          => 'required|min:5',
            'alamat'        => 'required|min:20',
            'keterangan'    => 'required|min:20'
        ]);

        Peserta::create([
            'nama'          => $request->nama,
            'alamat'        => $request->alamat,
            'keterangan'    => $request->keterangan,
            'created_at'    => now()
        ]);

        //redirect to index
        return redirect()->route('form-peserta')->with(['success' => 'Terimakasih telah melakukan input Data, selanjutnya proses Approval akan dilakukan oleh Admin.']);
    }

    public function approvedProcess(Request $request)
    {
        $this->validate($request, [
            'id'            => 'required',
            'status'        => 'required',
            'keterangan'    => 'required'
        ]);

       
        Peserta::where('id',$request->id)->update(['status_akhir' => $request->status]);


        Peserta_history::create([
            'peserta_id'    => $request->id,
            'status'        => $request->status,
            'keterangan'    => $request->keterangan,
            'created_by'    => Auth::user()->id,
            'created_at'    => now()
        ]);

        
        return redirect()->route('approved-peserta')->with(['success' => 'Proses Approval telah berhasil disimpan.']);
    }

    public function showHistory(string $id)
    {
        $dataHistorys = Peserta_history::
        select('peserta_histories.*','users.name as created_by_name')
        ->leftJoin('users', 'users.id', '=', 'peserta_histories.created_by')
        ->where('peserta_id',$id)
        ->orderBy('peserta_histories.id', 'asc')->get();
        return view('approved_history', compact('dataHistorys'));
    }
}