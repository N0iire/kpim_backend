<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Resources\KPIMResource;
use App\Models\CatatanJual;
use App\Models\Pemodal;
use App\Models\Pinjaman;
use App\Models\SimpananPokok;
use App\Models\SimpananSukarela;
use App\Models\SimpananWajib;
use App\MyConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Pemasukan::class);

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
        $this->authorize('create', Pemasukan::class);

        $pemasukan = Pemasukan::create($request->toArray());

        return response([
            'pemasukan' => $pemasukan
        ], MyConstant::OK);
    }

    /**
     * Finding pemasukan as years
     *
     * @param \Illuminate\Http\Request;
     * @return\Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->authorize('view', Pemasukan::class);

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
