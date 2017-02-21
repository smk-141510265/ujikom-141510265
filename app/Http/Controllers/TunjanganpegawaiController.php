<?php

namespace App\Http\Controllers;

use Request;
use App\TunjanganPegawai;
use App\Pegawai;
use App\Tunjangan;
use Validator;
use Input;

class TunjanganpegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tunjanganpegawai=TunjanganPegawai::all();
        $pegawai=Pegawai::all();
        return view('TunjanganPegawai.index',compact('tunjanganpegawai','Pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tunjangan=Tunjangan::all();
        $pegawai=Pegawai::all();
        return view('TunjanganPegawai.create',compact('tunjangan','pegawai','tunjanganpegawai'));
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
            'kode_tunjangan_id'=>'unique:tunjangan_pegawais',
            'pegawai_id'=>'required',
        ];
     $sms=[
            'kode_tunjangan_id.required'=>'Tidak Boleh Kosong',
            'kode_tunjangan_id.unique'=>'Sudah Digunakan',
            'pegawai_id.required'=>'Tidak Boleh Kosong',
        ];
        $validasi=Validator::make(Input::all(),$roles,$sms);
        if($validasi->fails()){
            return redirect()->back()
                ->WithErrors($validasi)
                ->WithInput();
        }

                $tunjanganpegawai = new TunjanganPegawai;
                $tunjanganpegawai->kode_tunjangan_id = Request('kode_tunjangan_id');
                $tunjanganpegawai->pegawai_id = Request('pegawai_id');
                $tunjanganpegawai->save();
                return redirect('tunja');
      
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
        $pegawai=Pegawai::all();
        $tunjangan=Tunjangan::all();
        $tunjanganpegawai=TunjanganPegawai::find($id);
        return view('TunjanganPegawai.edit',compact('pegawai','tunjangan','tunjanganpegawai'));
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
    }
}
