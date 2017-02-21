<?php

namespace App\Http\Controllers;

use Request;
use Validator;
use Input;
use App\LemburPegawai;
use App\Pegawai;
use App\Kategorylembur;


class LemburpegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lembur = LemburPegawai::all();
        return view('LemburPegawai.index', compact('lembur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pegawai=Pegawai::all();
        $kategori=Kategorylembur::all();
        return view('LemburPegawai.create',compact('pegawai','kategori'));
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
            'kode_lembur_id'=>'unique:lembur_pegawais',
            'pegawai_id'=>'required',
            'jumlah_jam'=>'required',
        ];
 $sms=[
            'kode_lembur_id.required'=>'Tidak Boleh Kosong',
            'kode_lembur_id.unique'=>'Sudah Ada',
            'pegawai_id.required'=>'Tidak Boleh Kosong',
            'jumlah_jam.required'=>'Tidak Boleh Kosong',
        ];
        $validasi=Validator::make(Input::all(),$roles,$sms);
        if($validasi->fails()){
            return redirect()->back()
                ->WithErrors($validasi)
                ->WithInput();
        }

         $lembur = new LemburPegawai;
                $lembur->kode_lembur_id = Request('kode_lembur_id');
                $lembur->pegawai_id = Request('pegawai_id');
                $lembur->jumlah_jam = Request('jumlah_jam');
                $lembur->save();
                return redirect('lembur');
      
        

       
               
        
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
        $kategori=Kategorylembur::all();
        $lembur=LemburPegawai::find($id);
        return view('LemburPegawai.edit',compact('pegawai','kategori','lembur'));
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
        $lembur=LemburPegawai::where('id',$id)->first();
        if($lembur['kode_lembur_id'] != Request('kode_lembur_id')){

        $rules=[
                'kode_lembur_id'=>'required|unique:lembur_pegawais,kode_lembur_id',
                'pegawai_id'=>'required',
                'jumlah_jam'=>'required',
                
                ];
        }
        else{

        $rules=[
                'kode_lembur_id'=>'required',
                'pegawai_id'=>'required',
                'jumlah_jam'=>'required',
                ];
        }
        $sms=[
                
                'kode_lembur_id.required'=>'Tidak Boleh Kosong',
                'kode_lembur_id.unique'=>'Kode Sudah Ada',
                'pegawai_id.required'=>'Tidak Boleh Kosong',
                'jumlah_jam.required'=>'Tidak Boleh Kosong',
                ];
        $validasi=Validator::make(Input::all(),$rules,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }

        $update=Request::all();
        $lembur=LemburPegawai::find($id);
        $lembur->update($update);
        return redirect('lembur');
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
        $lembur = LemburPegawai::findOrFail($id);
        $lembur->delete();
        return redirect()->route('lembur.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
