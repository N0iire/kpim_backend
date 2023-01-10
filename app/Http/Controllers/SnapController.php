<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\SimpananSukarela;
use App\Models\SimpananWajib;
use App\MyConstant;
use App\Services\Midtrans\CreateSnapTokenService;

class SnapController extends Controller
{
    public function snapToken(){
        if(request('type') == 'wajib'){
            $data = SimpananWajib::where('id', request('id'))->first();
            $nominal = $data->nominal_bayar;
        }elseif(request('type') == 'pinjaman'){
            $data = Pinjaman::where('id', request('id'))->first();
            $nominal = $data->nominal_cicilan;
        }elseif(!request('type')){
            return response([
                'status' => false,
                'message' => 'No type input!'
            ], MyConstant::BAD_REQUEST);
        }

        if(request('nominal')){
            $nominal = request('nominal');
        }

        $order = [
            'id' => random_int(1, 999999),
            'nominal' => $nominal
        ];

        $midtrans = new CreateSnapTokenService($order);
        $snapToken = $midtrans->getSnapToken();

        return response([
            'status' => true,
            'snapToken' => $snapToken,
            'message' => 'Snap token received!'
        ], MyConstant::OK);
    }
}
