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
            $data = SimpananWajib::where('id', request(['id']))->first();

            $order = [
                'id' => $data->id,
                'nominal' => $data->nominal_bayar
            ];
    
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
    
            return response([
                'status' => true,
                'snapToken' => $snapToken,
                'message' => 'Snap token received!'
            ], MyConstant::OK);
        }elseif(request('type') == 'sukarela'){
            $data = SimpananSukarela::where('id', request(['id']))->first();

            $order = [
                'id' => $data->id,
                'nominal' => $data->nominal_sukarela
            ];
    
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
    
            return response([
                'status' => true,
                'snapToken' => $snapToken,
                'message' => 'Snap token received!'
            ], MyConstant::OK);
        }elseif(request('type') == 'pinjaman'){
            $data = Pinjaman::where('id', request(['id']))->first();

            $order = [
                'id' => $data->id,
                'nominal' => $data->nominal_cicilan
            ];
    
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
    
            return response([
                'status' => true,
                'snapToken' => $snapToken,
                'message' => 'Snap token received!'
            ], MyConstant::OK);
        }else{
            return response([
                'status' => false,
                'message' => 'Error request'
            ], MyConstant::BAD_REQUEST);
        }
    }
}
