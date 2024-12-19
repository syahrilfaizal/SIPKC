<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithMapping, WithHeadings
{
    protected $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->reports;
    }

    public function map($report): array
    {
        return [
            $report->id,
            $report->user->name,
            $report->desc,
            $report->location,
            $report->image_url ? asset('storage/' . $report->image_url) : '-',
            $report->status,
            $report->lat,
            $report->lng,
            $report->categories->pluck('name')->implode(', '),
            $report->created_at->format('d-m-Y H:i'),
            $report->updated_at->format('d-m-Y H:i'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelapor',
            'Deskripsi',
            'Lokasi',
            'Gambar',
            'Status',
            'Latitude',
            'Longitude',
            'Kategori',
            'Dibuat pada',
            'Diperbarui pada',
        ];
    }
}
