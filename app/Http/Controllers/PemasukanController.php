<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\StorePemodalRequest;
use App\Http\Requests\UpdatePemasukanRequest;
use App\Http\Resources\KPIMResource;
use App\Models\CatatanJual;
use App\Models\Pemodal;
use App\Models\Pinjaman;
use App\Models\SimpananPokok;
use App\Models\SimpananSukarela;
use App\Models\SimpananWajib;
use App\MyConstant;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukan = Pemasukan::all();

        return response([
            'pemasukan' => KPIMResource::collection($pemasukan),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePemasukanRequest  $request
     * @return \Illuminate\Http\Response
     */
public function store(StorePemasukanRequest $request)
    {
        $pemasukan = Pemasukan::create($request->toArray());

        return response([
            'pemasukan' => $pemasukan
        ], MyConstant::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show($string)
    {
        $tanggal = explode('-', $string);
        $bulan = array_pop($tanggal);
        $tahun = implode(' ', $tanggal);

        $simpanan_pokok = SimpananPokok::whereYear('tgl_bayar', $tahun)
                                            ->whereMonth('tgl_bayar', $bulan)
                                            ->sum('nominal_pokok');

        $simpanan_wajib = SimpananWajib::whereYear('tgl_bayar', $tahun)
                                            ->whereMonth('tgl_bayar', $bulan)
                                            ->sum('nominal_bayar');

        $simpanan_sukarela = SimpananSukarela::whereYear('tgl_bayar', $tahun)
                                                ->whereMonth('tgl_bayar', $bulan)
                                                ->sum('nominal_sukarela');

        $detail_pemasukan = new SupportCollection();
        $detail_pemasukan->put('simpanan_pokok', $simpanan_pokok);
        $detail_pemasukan->put('simpanan_wajib', $simpanan_wajib);
        $detail_pemasukan->put('simpanan_sukarela', $simpanan_sukarela);

        return response($detail_pemasukan, MyConstant::OK);
    }

    /**
     * Finding pemasukan as years
     *
     * @param \Illuminate\Http\Request;
     * @return\Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $tahun = $request->tgl_awal; // Tahun dari input
        $pemasukan_perbulan = new SupportCollection(); // Array

        for($i=1; $i < 13; $i++){
                $date = $tahun . "-" . $i;
                $total_sp = SimpananPokok::whereYear('tgl_bayar', $tahun)
                                                ->whereMonth('tgl_bayar', $i)
                                                ->sum('nominal_pokok');
                $total_sw = SimpananWajib::whereYear('tgl_bayar', $tahun)
                                                ->whereMonth('tgl_bayar', $i)
                                                ->sum('nominal_bayar');
                $total_ss = SimpananSukarela::whereYear('tgl_bayar', $tahun)
                                                ->whereMonth('tgl_bayar', $i)
                                                ->sum('nominal_sukarela');
                $total_jual = CatatanJual::whereYear('tgl_penjualan', $tahun)
                                                ->whereMonth('tgl_penjualan', $i)
                                                ->sum('total_penjualan');
                $total_modal = Pemodal::whereYear('tgl_bayar', $tahun)
                                                ->whereMonth('tgl_bayar', $i)
                                                ->sum('nominal_modal');
                $total_pinjaman = Pinjaman::whereYear('tgl_pinjaman', $tahun)
                                                ->whereMonth('tgl_pinjaman', $i)
                                                ->where('status', 1)
                                                ->sum('total_pinjaman');

                $total_simpanan = $total_sp + $total_sw + $total_ss;

                $pemasukan_perbulan->push((object)[
                    'tanggal' => $date,
                    'total_simpanan' => $total_simpanan,
                    'total_jual' => $total_jual,
                    'total_modal' => $total_modal,
                    'total_pinjaman' => $total_pinjaman
                ]);
        }
        return response($pemasukan_perbulan, MyConstant::OK);
    }
}
