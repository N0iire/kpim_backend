<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Resources\KPIMResource;
use App\Models\CatatanBeli;
use App\Models\DetailNonPembelian;
use App\Models\Pinjaman;
use App\MyConstant;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Pengeluaran::class);

        $pengeluaran = Pengeluaran::all();

        return response([
            'pengeluaran' => KPIMResource::collection($pengeluaran),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengeluaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengeluaranRequest $request)
    {
        $this->authorize('create', Pengeluaran::class);

        $pengeluaran = Pengeluaran::create($request->toArray());

        return response([
            'pengeluaran' => $pengeluaran,
            'message' => 'Data berhasil ditambah!'
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
        $this->authorize('view', Pengeluaran::class);

        $tahun = $request->tgl_awal; // Tahun dari input
        $pengeluaran_perbulan = new Collection();

        for($i=1; $i < 13; $i++){
            $date = $tahun . "-" . $i;

            $total_pembelian = CatatanBeli::whereYear('tgl_pembelian', $tahun)
                                            ->whereMonth('tgl_pembelian', $i)
                                            ->sum('total_pembelian');
            $total_pinjaman = Pinjaman::whereYear('tgl_pinjaman', $tahun)
                                                ->whereMonth('tgl_pinjaman', $i)
                                                ->where('status', 0)
                                                ->sum('total_pinjaman');
            $total_non_beli = DetailNonPembelian::whereYear('tgl_transaksi', $tahun)
                                                    ->whereMonth('tgl_transaksi', $i)
                                                    ->sum('nominal_transaksi');

            $pengeluaran_perbulan->push((object)[
                'tanggal' => $date,
                'total_pembelian' => $total_pembelian,
                'total_pinjaman' => $total_pinjaman,
                'total_non_beli' => $total_non_beli
            ]);
        }

        return response($pengeluaran_perbulan, MyConstant::OK);
    }
}
