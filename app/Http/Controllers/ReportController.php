<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all(); // Untuk dropdown kategori

        // Jika kategori dipilih melalui query parameter atau input
        $selectedCategory = null;
        $reports = Report::with('user', 'categories')->latest();

        if ($request->has('categoryId') && !empty($request->input('categoryId'))) {
            $selectedCategory = Category::find($request->input('categoryId'));
            if ($selectedCategory) {
                $reports = $reports->whereHas('categories', function ($query) use ($selectedCategory) {
                    $query->where('id', $selectedCategory->id);
                });
            }
        }

        $reports = $reports->get();

        return view('home', compact('reports', 'categories', 'selectedCategory'));
    }

    public function pantau(Request $request)
    {
        $categories = Category::all(); // Untuk dropdown kategori

        // Jika kategori dipilih melalui query parameter atau input
        $selectedCategory = null;
        $reports = Report::with('user', 'categories')->latest();

        if ($request->has('categoryId') && !empty($request->input('categoryId'))) {
            $selectedCategory = Category::find($request->input('categoryId'));
            if ($selectedCategory) {
                $reports = $reports->whereHas('categories', function ($query) use ($selectedCategory) {
                    $query->where('id', $selectedCategory->id);
                });
            }
        }



        if (Auth::user()->role == 'admin') {
            $reports = $reports->get();
        } else {
            $reports = $reports->where('user_id', Auth::user()->id)->get();
        }

        return view('pantau', compact('reports', 'categories', 'selectedCategory'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);
    
        $report->update([
            'status' => $validated['status']
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
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
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }

    /**
     * Export reports to PDF based on category.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function exportPDF($categoryId)
    {
        // Ambil data berdasarkan ID kategori
        $reports = Report::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        })->with('categories', 'user')->get();

        // Ambil nama kategori untuk judul dan nama file
        $category = Category::find($categoryId)->name ?? 'Unknown';

        // Data yang akan dikirim ke view
        $data = [
            'reports' => $reports,
            'category' => $category,
        ];

        // Load view dan generate PDF
        $pdf = PDF::loadView('reports.pdf', $data)->setPaper('a4', 'landscape');

        // Download PDF dengan nama file yang sesuai
        return $pdf->download('report_' . $category . '.pdf');
    }
}
