<?php

namespace App\Http\Controllers;

use Request;
use App\Tunjangan;
use App\Jabatan;
use App\Golongan;
use Validator;
use Input;

class TunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $tunjangan = Tunjangan::all();
        return view('Tunjangan.index', compact('tunjangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $jabatan=Jabatan::all();
        $golongan=Golongan::all();
        return view('Tunjangan.create',compact('jabatan','golongan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $roles=[
            'kode_tunjangan'=>'unique:tunjangans',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'status'=>'required',
            'jumlah_anak'=>'required|numeric',
            'besaran_uang'=>'required|numeric',
        ];
 $sms=[
            'kode_tunjangan.required'=>'Tidak Boleh Kosong',
            'kode_tunjangan.unique'=>'Sudah Digunakan',
            'jabatan_id.required'=>'Tidak Boleh Kosong',
            'golongan_id.required'=>'Tidak Boleh Kosong',
            'status.required'=>'Tidak Boleh Kosong',
            'jumlah_anak.numeric'=>'Harus berbentuk angka',
            'besaran_uang.numeric'=>'Harus berbentuk angka',
        ];
        $validasi=Validator::make(Input::all(),$roles,$sms);
        if($validasi->fails()){
            return redirect()->back()
                ->WithErrors($validasi)
                ->WithInput();
        }

         $tunjangan = new Tunjangan;
                $tunjangan->kode_tunjangan = Request('kode_tunjangan');
                $tunjangan->jabatan_id = Request('jabatan_id');
                $tunjangan->golongan_id = Request('golongan_id');
                $tunjangan->status = Request('status');
                $tunjangan->jumlah_anak = Request('jumlah_anak');
                $tunjangan->besaran_uang = Request('besaran_uang');
                $tunjangan->save();
                return redirect('tunjangan');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $golongan=Golongan::all();
        $jabatan=Jabatan::all();
        $tunjangan=Tunjangan::find($id);
        return view('tunjangan.edit',compact('jabatan','golongan','tunjangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $tunjangan=Tunjangan::where('id',$id)->first();
        if($tunjangan['kode_tunjangan'] != Request('kode_tunjangan')){
            $roles=[
                'kode_tunjangan'=>'required|unique:tunjangans',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'besaran_uang'=>'required',
                'jumlah_anak'=>'required',
                'status'=>'required',
            ];
        }
        else{
            $roles=[
                'kode_tunjangan'=>'required',
                'jabatan_id'=>'required',
                'golongan_id'=>'required',
                'besaran_uang'=>'required',
                'jumlah_anak'=>'required',
                'status'=>'required',
            ];
        }
        $sms=[
                'kode_tunjangan.required'=>'jangan kosong',
                'kode_tunjangan.unique'=>'jangan sama',
                'jabatan_id.required'=>'jangan kosong',
                'golongan_id.required'=>'jangan kosong',
                'besaran_uang.required'=>'jangan kosong',
                'status.required'=>'jangan kosong',
                'jumlah_anak.required'=>'jangan kosong',
            ];
            $validasi= Validator::make(Input::all(),$roles,$sms);
            if($validasi->fails()){
                return redirect()->back()
                        ->WithErrors($validasi)
                        ->WithInput();
            }

            $update=Request::all();
            $tunjangan=Tunjangan::find($id);
            $tunjangan->update($update);
            return redirect('tunjangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tunjangan = Tunjangan::findOrFail($id);
        $tunjangan->delete();
        return redirect()->route('tunjangan.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
