<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ExportController extends Controller
{
    public function exportByCategory($category)
    {
        $reports = Report::whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        })->get();

        return Excel::download(new ReportExport($reports), $category . '.xlsx');
    }
}
