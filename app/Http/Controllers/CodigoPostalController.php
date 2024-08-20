<?php

namespace App\Http\Controllers;

use App\Models\codigospostales;
use Illuminate\Http\Request;

class CodigoPostalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataCP = codigospostales::all();
        return $dataCP;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(codigospostales $codigospostales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(codigospostales $codigospostales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, codigospostales $codigospostales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(codigospostales $codigospostales)
    {
        //
    }
}
