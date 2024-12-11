<?php

namespace App\Http\Controllers;

use App\Models\report;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with('user', 'categories')->latest()->get();
        return view('home', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('layout.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'message'   => 'required|string|max:1000',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'address'   => 'required|string|max:500',
            'tags'      => 'nullable|array',
        ]);

        // Mengunggah gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/reports', 'public');
        }

        // Menyimpan data laporan ke database
        $report = Report::create([
            'user_id'    => Auth::id(),
            'desc'       => $request->input('message'),
            'location'   => $request->input('address'),
            'image_url'  => $imagePath,
            'lat'        => $request->input('latitude'),
            'lng'        => $request->input('longitude'),
        ]);

        // Menyimpan tags/kategori jika ada
        if ($request->has('tags')) {
            $report->categories()->sync($request->input('tags'));
        }

        return redirect()->route('form')->with('success', 'Laporan berhasil dikirim.');
    }


    /**
     * Display the specified resource.
     */
    public function show(report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(report $report)
    {
        //
    }
}
