<?php

namespace App\Http\Controllers;

use Request;
use App\Jabatan;
use Validator;
use Input;

class JabatanController extends Controller
{
    //
     public function index()
    {
        $jabatan = Jabatan::all();
        return view('Jabatan.index', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $rules=['kode_jabatan'=>'required|unique:jabatans','nama_jabatan'=>'required','besaran_uang'=>'required'];
      $message=['kode_jabatan.required'=>'Kolom Jangan Sampai Kosong','kode_jabatan.unique'=>'Kode Yang Anda Masukan Sudah Ada','nama_jabatan.required'=>'Kolom Jangan Sampai Kosong','besaran_uang.required'=>'Kolom Jangan Sampai Kosong'];
      $validator=Validator::make(Input::all(),$rules,$message);

        if ($validator->fails())
         {
            # code...
            return redirect('/jabatan/create')
            ->withErrors($validator)
            ->withInput();
        }
        else
        {
                $jabatan=Request::all();
                Jabatan::create($jabatan);
                return redirect('jabatan');
        }
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
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.edit', compact('jabatan'));
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
        $jabatanUpdate=Request::all();
        $jabatan=Jabatan::find($id);
        $jabatan->update($jabatanUpdate);
        return redirect('jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with('alert-success', 'Data Berhasil Dihapus.');
    }
}
