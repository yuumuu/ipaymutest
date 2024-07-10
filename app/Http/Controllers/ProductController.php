<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $models;

    public function __construct()
    {
        $this->models = Product::paginate(10);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index', [
            'data' => $this->models,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            // 'data' => $this->models,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'name'  => 'required|string',
            'price' => 'required',
            'stock' => 'required|min:1',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/'.$file->store('products', 'public');

            $data['image'] =$filepath;
        }

        $data['user_id'] = Auth::user()->id;

        $data = Product::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'data' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'data' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Product::findOrFail($id);

        $data = $request->validate([
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'name'  => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/'.$file->store('products', 'public');

            $data['image'] = $filepath;
        } else {
            $data['image'] = $model->image;
        }

        $data['user_id'] = Auth::user()->id;

        $model->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $transactions = $product->transactions()->get();

        foreach ($transactions as $item) {
            $item->delete();
        }

        $file = Storage::exists($product->image) ? Storage::delete($product->image) : false;

        $product->delete();
        return redirect()->route('products.index');
    }
}
