<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    protected $fillable = ['aplikasi_id', 'aplikasi', 'nama', 'demo', 'catatan'];

    public function getKolomAttribute() {
    	$jumlahKolom = Backlog::all()->count();

    	return $jumlahKolom;
    }

    public function backlog() {
    	return $this->belongsTo('App\Backlog');
    }
}
