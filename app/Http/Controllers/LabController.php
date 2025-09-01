<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    // Tampilkan semua lab
    public function index()
    {
        $labs = Lab::all();
        return response()->json($labs);
    }

    // Tampilkan detail satu lab
    public function show($id)
    {
        $lab = Lab::findOrFail($id);
        return response()->json($lab);
    }
}
