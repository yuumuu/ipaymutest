<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Traits\Ipaymu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    use Ipaymu;
    protected $auth;

    public function __construct()
    {
        $this->auth = Auth::user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ($this->auth->role == 'admin') {
            $transactions = Transaction::paginate(10);
        } elseif ($this->auth->role == 'user') {
            $transactions = Transaction::where('user_id', $this->auth->id)->paginate(10);
        }

        return view('transactions.index', [
            'data' => $transactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'total_price' => 'required|max:5000000',
            'payment_method' => 'required|in:ipaymu,midtrans,xendit',
        ]);

        if (!$this->auth->phone || $this->auth->phone == '' || $this->auth->phone == null) {
            return redirect()->back()->with('message', '');
        }

        $product = Product::findOrFail($data['product_id']);

        if ($data) {
            $payment = json_decode(
                json_encode(
                    $this->redirect_payment(
                        $this->auth->id,
                        $request->product_id, 
                        $request->quantity, 
                        $product->price,
                    )
                ), true);
            
            $created = Transaction::create([
                'user_id' => $this->auth->id,
                'product_id' => $data['product_id'],
                'invoice' => $payment['Data']['SessionID'],
                'quantity' => $data['quantity'],
                'total_price' => $data['total_price'],
                'status' => 'pending',
                'payment_url' => $payment['Data']['Url'],
                'payment_method' => $data['payment_method'],
            ]);

            $newest_stock =  $product->stock - $data['quantity'];

            $product->update([
                'stock' => $newest_stock,
            ]);

            return redirect()->route('user.transactions.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
