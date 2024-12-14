<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ReportsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $categoryId;
    protected $row = 1;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function collection()
    {
        return Report::whereHas('categories', function($query) {
            $query->where('category_id', $this->categoryId);
        })->with(['categories', 'user'])->get();
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

    public function map($report): array
    {
        $this->row++;
        return [
            $report->id,
            $report->user->name,
            $report->desc,
            $report->location,
            '', // Kolom untuk gambar akan dikosongkan
            $report->status,
            $report->lat,
            $report->lng,
            $report->categories->pluck('name')->implode(', '),
            $report->created_at,
            $report->updated_at,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $lastColumn = $sheet->getHighestColumn();
                $lastRow = $sheet->getHighestRow();

                // Auto-fit columns except for the Gambar (E) column
                foreach(range('A', $lastColumn) as $column) {
                    if ($column !== 'E') { // Exclude Gambar column for manual sizing
                        $sheet->getColumnDimension($column)->setAutoSize(true);
                    }
                }

                // Set specific width for Gambar column to accommodate images
                $sheet->getColumnDimension('E')->setWidth(30); // Adjust as needed

                // Add borders
                $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Make headers bold
                $sheet->getStyle('A1:' . $lastColumn . '1')->getFont()->setBold(true);

                // Define column E width in pixels (approximation)
                // PhpSpreadsheet's default character width is approximately 7 pixels per character
                $columnWidthInChars = 30;
                $columnWidthInPixels = $columnWidthInChars * 7; // ≈210 pixels

                // Define row height in points and convert to pixels
                $rowHeightInPoints = 120; // As set below
                $rowHeightInPixels = $rowHeightInPoints * 1.33; // ≈160 pixels

                // Add images
                $reports = $this->collection();
                foreach ($reports as $index => $report) {
                    if ($report->image_url) {
                        $imagePath = storage_path('app/public/' . $report->image_url);
                        if (file_exists($imagePath)) {
                            $drawing = new Drawing();
                            $drawing->setName('Report Image');
                            $drawing->setDescription('Report Image');
                            $drawing->setPath($imagePath);
                            $drawing->setHeight(100); // Set image height
                            $drawing->setResizeProportional(true); // Maintain aspect ratio

                            // Calculate image width based on height and aspect ratio
                            // PhpSpreadsheet does not provide a direct way to get image dimensions,
                            // so you might need to use getimagesize or another method if precise control is needed.
                            list($width, $height) = getimagesize($imagePath);
                            $imageWidth = ($width / $height) * 100; // Calculate width based on height=100
                            
                            // Calculate offsets to center the image
                            $offsetX = ($columnWidthInPixels - $imageWidth) / 2;
                            $offsetY = ($rowHeightInPixels - 100) / 2; // 100 is the image height

                            $drawing->setOffsetX($offsetX);
                            $drawing->setOffsetY($offsetY);

                            $drawing->setCoordinates('E' . ($index + 2)); // Column E, starting from row 2
                            $drawing->setWorksheet($sheet->getDelegate());
                        }
                    }
                }

                // Adjust row height for images
                foreach(range(2, $lastRow) as $row) {
                    $sheet->getRowDimension($row)->setRowHeight(120); // 120 points ≈160 pixels
                }
            },
        ];
    }
}
