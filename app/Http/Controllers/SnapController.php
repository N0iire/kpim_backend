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
            if(request('id')){
                $data = SimpananWajib::where('id', request('id'))->first();
                $id = $data->id;
                $nominal = $data->nominal_bayar;
            }else{
                $data = SimpananWajib::latest()->first();
                $id = $data->id + 1;
            }
        }elseif(request('type') == 'sukarela'){
            if(request('id')){
                $data = SimpananSukarela::where('id', request('id'))->first();
                $id = $data->id;
                $nominal = $data->nominal_bayar;
            }else{
                $data = SimpananSukarela::latest()->first();
                $id = $data->id + 1;
            }
        }elseif(request('type') == 'pinjaman'){
            if(request('id')){
                $data = Pinjaman::where('id', request('id'))->first();
                $id = $data->id;
                $nominal = $data->nominal_bayar;
            }else{
                $data = Pinjaman::latest()->first();
                $id = $data->id + 1;
            }
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
            'id' => $id,
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
