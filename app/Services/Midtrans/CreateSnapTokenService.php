<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
 
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order['id'],
                'gross_amount' => $this->order['nominal'],
            ],
            'customer_details' => [
                'name' => auth()->user()->nama_anggota,
                'username' => auth()->user()->username,
            ]
        ];
        
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}