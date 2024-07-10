<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Http;

trait Ipaymu
{
    public $va = '0000009608494411';
    public $api_key = 'SANDBOX496AA3D8-9460-4DA7-B958-6B068BFC1DD3';


    public function __construct()
    {
        // $this->va        = config('ipaymu.va');
        // $this->api_key   = config('ipaymu.api_key');
    }

    public function signature($body, $method)
    {
        $json_body       = json_encode($body, JSON_UNESCAPED_SLASHES);
        $request_body    = strtolower(hash('sha256', $json_body));
        $string_to_sign  = strtoupper($method).":".$this->va.":".$request_body.":".$this->api_key;
        $signature       = hash_hmac('sha256', $string_to_sign, $this->api_key);

        return $signature;
    }

    public function balance()
    {
        $va              = $this->va;
        // $url             = 'https://my.ipaymu.com/api/v2/balance';
        $url             = 'https://sandbox.ipaymu.com/api/v2/balance';
        $method          = 'POST';
        $timestamp       = Date('YmdHis');
        $body['account'] = $va;
        $signature       = $this->signature($body, $method);

        $headers = [
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'va'            => $va,
            'signature'     => $signature,
            'timestamp'     => $timestamp,
        ];

        $data_request = Http::withHeaders($headers)
                        ->post( $url, [
                            'account' => $va
                        ]);
        $response = $data_request->object();

        return $response;
    }

    public function redirect_payment($user_id, $product_id, $quantity, $price)
    {
        $user      = User::findOrFail($user_id);
        $produk    = Product::findOrFail($product_id);

        if (!isset($user) || !isset($produk) || ($quantity == null)) {
            return redirect()->back();
        }

        $va        = $this->va;
        // $url       = 'https://my.ipaymu.com/api/v2/payment';
        $url       = 'https://sandbox.ipaymu.com/api/v2/payment';
        $method    = 'POST';
        $timestamp = Date('YmdHis');

        // Request Body //
        $body['product'][] = ucwords("Pembelian Produk {$produk->name}");
        $body['qty'][]     = $quantity;
        $body['price'][]   = $price;

        $body['description'][] = "Transaksi barang {$produk->name} {$quantity} Buah, senilai {$price} Rupiah.";
        $body['imageUrl'][]    = url($produk->image);
        $body['referenceId']   = 'ID-'.rand(000000, 999999).
                                '-TEST-'.str_replace(
                                    ' ', 
                                    '',
                                    strtoupper($produk->name)
                                );

        $body['returnUrl']     = route('callback.notify');
        $body['notifyUrl']     = route('callback.return');
        $body['cancelUrl']     = route('callback.cancel');
        $body['buyerName']     = $user->name;
        $body['buyerEmail']    = $user->email;
        $body['buyerPhone']    = $user->phone ?? '012345678901';
        $body['feeDirection']  = 'BUYER';
        // End Request Body //

        // dd($body);

        $signature             = $this->signature($body, $method);

        $headers = [
            'Content-Type'     => 'application/json',
            'signature'        => $signature,
            'va'               => $va,
            'timestamp'        => $timestamp,
        ];

        $data_request = Http::withHeaders($headers)->post($url, $body);
        $response = $data_request->object();

        return $response;
    }
}
