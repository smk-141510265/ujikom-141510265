<?php

namespace App\Http\Controllers;

use Request;
use App\KategoryLembur;
use App\Jabatan;
use App\Golongan;
use Validator;
use Input;

class KategorilemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $kategori = KategoryLembur::all();
        return view('KategoriLembur.index', compact('kategori'));
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
        return view('KategoriLembur.create',compact('jabatan','golongan'));
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
        $rules=[
                'kode_lembur'=>'required|unique:kategory_lemburs,kode_lembur',
                'golongan_id'=>'required',
                'jabatan_id'=>'required',
                'besaran_uang'=>'required',
                ];
        $sms=[
                'kode_lembur.required'=>'Tidak Boleh Kosong',
                'besaran_uang.required'=>'Tidak Boleh Kosong',
                'kode_lembur.unique'=>'Kode Sudah Ada',
                'golongan_id.required'=>'Tidak Boleh Kosong',
                'jabatan_id.required'=>'Tidak Boleh Kosong',
                ];
        $validasi=Validator::make(Input::all(),$rules,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }
        
        $kategori=Request::all();
        Kategorylembur::create($kategori);
        return redirect('kategori');

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
        $kategori=Kategorylembur::find($id);
        return view('KategoriLembur.edit',compact('kategori','golongan','jabatan'));
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
        $kategori=Kategorylembur::where('id',$id)->first();
        if($kategori['kode_lembur'] != Request('kode_lembur')){

        $rules=[
                'kode_lembur'=>'required|unique:kategory_lemburs,kode_lembur',
                'golongan_id'=>'required',
                'besaran_uang'=>'required|numeric',
                'jabatan_id'=>'required',
                ];
        }
        else{

        $rules=[
                'kode_lembur'=>'required',
                'golongan_id'=>'required',
                'jabatan_id'=>'required',
                ];
        }
        $sms=[
                
                'kode_lembur.required'=>'Tidak Boleh Kosong',
                'besaran_uang.numeric'=>'Harus Berbentuk Angka',
                'kode_lembur.unique'=>'Kode Sudah Ada',
                'golongan_id.required'=>'Tidak Boleh Kosong',
                'jabatan_id.required'=>'Tidak Boleh Kosong',
                ];
        $validasi=Validator::make(Input::all(),$rules,$sms);
        if($validasi->fails()){
            return redirect()->back()
            ->WithErrors($validasi)
            ->WithInput();
        }

        $update=Request::all();
        $kategori=Kategorylembur::find($id);
        $kategori->update($update);
        return redirect('kategori');
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
        $kategori = Kategorylembur::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
