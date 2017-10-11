<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aplication;
use App\Backlog;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class AplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
         $aplications = Aplication::select(['id', 'kode', 'nama']);
          return Datatables::of($aplications)
          ->addColumn('nama', function($aplication) {
                    return '<a href="'.route('aplikasi.show', $aplication->id).'">'.$aplication->nama.'</a>';
                })
          ->addColumn('action', function($aplications){
         return view('datatable._action', [
                'model'    => $aplications,
                'form_url' => route('aplikasi.destroy', $aplications->id),
                'edit_url' => route('aplikasi.edit', $aplications->id),
                'confirm_message' => 'Yakin mau menghapus '."$aplications->nama.?"
        ]);
           })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'kode', 'name'=>'kode', 'title'=>'Kode Aplikasi'])
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama Aplikasi'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false,'searchable'=>false]);
        
        return view('aplikasi.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('aplikasi.create');
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
        $this->validate($request, [
            'kode' => 'required|unique:aplications',
            'nama' => 'required|unique:aplications'
        ]);
        $aplikasi = Aplication::create($request->all());
        Session::flash("flash_notification", [
             "level"=>"success",
            "message"=>"Berhasil Menambahkan ".$aplikasi->nama.""
        ]);
            return redirect()->route('aplikasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aplikasi = Aplication::find($id);
        $listBacklog = Backlog::where('aplikasi_id', $id)->get();
        return view('aplikasi.show', compact('aplikasi', 'listBacklog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //membuat proses edit
        $aplication = Aplication::find($id);
        return view('aplikasi.edit')->with(compact('aplication'));
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
        $this->validate($request, [
        'kode' => 'required|unique:aplications,kode,' . $id,
                'nama' => 'required|unique:aplications,nama,'. $id 
        ]);
        $aplication = Aplication::find($id);
        $aplication->update($request->all());
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil Mengubah ".$aplication->nama.""
         ]);
        return redirect()->route('aplikasi.index');
         }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data_backlog = Backlog::where('aplikasi_id', $id)->count();

//JIKA APLIKASI SUDAH TERPAKAI
        if ($data_backlog > 0) {

            //PERINGTAN TIDAK BISA DIHAPUS
            Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Aplikasi Tidak Bisa Dihapus. Karena Sudah Terpakai."
            ]);

            return redirect()->route('aplikasi.index');

        }
        else{

            //membuat proses hapus
            Aplication::destroy($id);
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Aplikasi berhasil dihapus"
            ]);
            return redirect()->route('aplikasi.index');

        }
    }
}
