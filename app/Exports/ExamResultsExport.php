<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExamResultsExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    protected $examId;

    public function __construct($examId)
    {
        $this->examId = $examId;
    }

    public function collection()
    {
        return Result::with(['user','exam'])
            ->where('exam_id', $this->examId)
            ->get()
            ->map(function ($r) {
                return [
                    $r->user->last_name . ', ' . $r->user->first_name,
                    $r->score,
                    $r->exam->title,
                    $r->created_at->format('Y-m-d')
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Student',
            'Score',
            'Exam',
            'Date'
        ];
    }

    // 📏 Column widths (clean layout)
    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 25,
            'C' => 10,
            'D' => 25,
        ];
    }

    // 🎨 Modern styling
    public function styles(Worksheet $sheet)
    {
        // HEADER STYLE (Row 1)
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '2F5597', // modern blue
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // ALL CELLS ALIGNMENT
        $sheet->getStyle('A1:D1000')->getAlignment()->setHorizontal(
            Alignment::HORIZONTAL_CENTER
        );

        // BORDER FOR ALL DATA
        $sheet->getStyle('A1:D1000')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'D9D9D9'],
                ],
            ],
        ]);

        // ALTERNATING ROW COLORS (zebra style)
        for ($row = 2; $row <= 1000; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'F3F6FB',
                        ],
                    ],
                ]);
            }
        }

        return [];
    }
}