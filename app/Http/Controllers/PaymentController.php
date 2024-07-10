<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function return()
    {
        return view('callback.return', [
            // 'data' => $data,
        ]);
    }
    
    public function notify(Request $request)
    {
        $sid = $request->sid;
        $trx = $request->trx_id;
        $status = $request->status;
        $reference_id = $request->reference_id;

        $transaction = Transaction::where('invoice', $sid)->first();

        if ($transaction->status == 'success') {
            return response()->json(['message' => 'Transaksi sudah berhasil'], 200);
        } else {
            $status = $status == 'berhasil' ? 'success' : $status;
            $transaction->update([
                'status' => $status,
            ]);

            return redirect()->route('user.transactions.index');
        }
    }

    public function cancel()
    {
        return view('callback.cancel', [
            // 'data' => $data,
        ]);
    }
}
