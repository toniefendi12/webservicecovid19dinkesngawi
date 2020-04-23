<?php

namespace App\Http\Controllers\Covid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CovidController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }
    public function datacovidngawi(){
        $aman_total = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'aman')
                ->get()->count();
        $odr_total = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'odr')
                ->get()->count();
        $odp_total = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'odp')
                ->get()->count();
        $pdp_total = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'pdp')
                ->get()->count();
        $positif_total = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'positif')
                ->get()->count();
        $sembuh_total = DB::table('covid19s')
                ->select('id')
                ->where('keterangan', 'sembuh')
                ->get()->count();
        $meninggal_total = DB::table('covid19s')
                ->select('id')
                ->where('keterangan', 'meninggal')
                ->get()->count();
        $last_update_date_total = DB::table('covid19s')->select('updated_at as last_update_date')->orderBy('updated_at', 'DESC')->first();
        $kecamatan = DB::table('kecamatans')
                ->select('id', 'no_id as kode_kecamatan', 'nama as nama_kecamatan')
                ->orderByDesc('kode_kecamatan')
                ->get();
        if(!$kecamatan->IsEmpty()){
            foreach ($kecamatan as $key => $value) {
                $id = $value->id;
                $nama_kecamatan = $value->nama_kecamatan;
                $kode = $value->kode_kecamatan;
                $substr1 = substr($kode, 0, 2);
                $substr2 = substr($kode, 2, 2);
                $substr3 = substr($kode, 4, 2);
                $kode_wilayah = $substr1.".".$substr2.".".$substr3;
                $aman = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'aman')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $odr = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'odr')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $odp = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'odp')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $pdp = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'pdp')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $positif = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'positif')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $sembuh = DB::table('covid19s')
                        ->select('id')
                        ->where('keterangan', 'sembuh')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $meninggal = DB::table('covid19s')
                        ->select('id')
                        ->where('keterangan', 'meninggal')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $last_update_date = DB::table('covid19s')->select('updated_at as last_update_date')->where('kecamatan_id', $id)->orderBy('updated_at', 'DESC')->first();
                $kecamatan[$key]->kode_wilayah = $kode_wilayah;
                $kecamatan[$key]->total_aman = $aman;
                $kecamatan[$key]->total_odr = $odr;
                $kecamatan[$key]->total_odp = $odp;
                $kecamatan[$key]->total_pdp = $pdp;
                $kecamatan[$key]->total_terkonfirmasi = $positif;
                $kecamatan[$key]->total_sembuh = $sembuh;
                $kecamatan[$key]->total_meninggal = $meninggal;
                $kecamatan[$key]->metadata = $last_update_date;
            }
        }else{
           $kecamatan = array();
        }

        $data = array(
            'kode_wilayah'=>'35.21',
            'nama_kabupaten'=>'Ngawi',
            'nama_propinsi'=>'Jawa Timur',
            'total_aman'=>$aman_total,
            'total_odr'=>$odr_total,
            'total_odp'=>$odp_total,
            'total_pdp'=>$pdp_total,
            'total_terkonfirmasi'=>$positif_total,
            'total_sembuh'=>$sembuh_total,
            'total_meninggal'=>$meninggal_total,
            'metadata'=>$last_update_date,
            'persebaran_kecamatan'=>$kecamatan
        );
        return response()->json($data, 200);
    }
    public function datacovidngawiByKecamatan($id){
        $aman = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'aman')
                ->where('kecamatan_id', $id)
                ->get()->count();
        $odr = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'odr')
                ->where('kecamatan_id', $id)
                ->get()->count();
        $odp = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'odp')
                ->where('kecamatan_id', $id)
                ->get()->count();
        $pdp = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'pdp')
                ->where('kecamatan_id', $id)
                ->get()->count();
        $positif = DB::table('covid19s')
                ->select('id')
                ->where('kriteria', 'positif')
                ->where('kecamatan_id', $id)
                ->get()->count();
        $sembuh = DB::table('covid19s')
                ->select('id')
                ->where('keterangan', 'sembuh')
                ->where('kecamatan_id', $id)
                ->get()->count();
        $meninggal = DB::table('covid19s')
                ->select('id')
                ->where('keterangan', 'meninggal')
                ->where('kecamatan_id', $id)
                ->get()->count();
        $last_update_date = DB::table('covid19s')->select('updated_at as last_update_date')->where('kecamatan_id', $id)->orderBy('updated_at', 'DESC')->first();
        $data = array(
            'total_aman'=>$aman,
            'total_odr'=>$odr,
            'total_odp'=>$odp,
            'total_pdp'=>$pdp,
            'total_terkonfirmasi'=>$positif,
            'total_sembuh'=>$sembuh,
            'total_meninggal'=>$meninggal,
            'metadata'=>$last_update_date
        );
        return response()->json($data, 200);
    }
    public function data_kecamatan_ngawi(){
        $kecamatan = DB::table('kecamatans')
                ->select('id', 'nama', 'no_id as kode_kecamatan')
                ->orderByDesc('kode_kecamatan')
                ->get();
        if(!$kecamatan->IsEmpty()){
            foreach ($kecamatan as $key => $value) {
                $kode = $value->kode_kecamatan;
                $substr1 = substr($kode, 0, 2);
                $substr2 = substr($kode, 2, 2);
                $substr3 = substr($kode, 4, 2);
                $kode_wilayah = $substr1.".".$substr2.".".$substr3;
                $kecamatan[$key]->kode_wilayah=$kode_wilayah;
            }
            return response()->json($kecamatan, 200);
        }else{
            return response()->json('Tidak ada data!', 404);
        }
    }
    public function datacovid_tiap_kecamatan(){
         $kecamatan = DB::table('kecamatans')
                ->select('id', 'no_id as kode_kecamatan', 'nama as nama_kecamatan')
                ->orderByDesc('kode_kecamatan')
                ->get();
        if(!$kecamatan->IsEmpty()){
            foreach ($kecamatan as $key => $value) {
                $id = $value->id;
                $kode = $value->kode_kecamatan;
                $substr1 = substr($kode, 0, 2);
                $substr2 = substr($kode, 2, 2);
                $substr3 = substr($kode, 4, 2);
                $kode_wilayah = $substr1.".".$substr2.".".$substr3;
                $aman = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'aman')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $odr = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'odr')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $odp = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'odp')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $pdp = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'pdp')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $positif = DB::table('covid19s')
                        ->select('id')
                        ->where('kriteria', 'positif')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $sembuh = DB::table('covid19s')
                        ->select('id')
                        ->where('keterangan', 'sembuh')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $meninggal = DB::table('covid19s')
                        ->select('id')
                        ->where('keterangan', 'meninggal')
                        ->where('kecamatan_id', $id)
                        ->get()->count();
                $last_update_date = DB::table('covid19s')->select('updated_at as last_update_date')->where('kecamatan_id', $id)->orderBy('updated_at', 'DESC')->first();
                $kecamatan[$key]->kode_wilayah = $kode_wilayah;
                $kecamatan[$key]->total_aman = $aman;
                $kecamatan[$key]->total_odr = $odr;
                $kecamatan[$key]->total_odp = $odp;
                $kecamatan[$key]->total_pdp = $pdp;
                $kecamatan[$key]->total_terkonfirmasi = $positif;
                $kecamatan[$key]->total_sembuh = $sembuh;
                $kecamatan[$key]->total_meninggal = $meninggal;
                $kecamatan[$key]->metadata = $last_update_date;
            }
            return response()->json($kecamatan, 200);
        }else{
            return response()->json('Tidak ada data!', 404);
        }

    }
    //
}
