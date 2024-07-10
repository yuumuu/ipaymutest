<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $models;

    public function __construct()
    {
        $this->models = User::paginate(10);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'data' => $this->models,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create', [
            'data' => $this->models,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('users.show', [
            'data' => $this->models,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('users.edit', [
            'data' => $this->models,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 
    }
}
