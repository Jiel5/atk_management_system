<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PermintaanExport implements FromView
{
    protected $permintaan;

    public function __construct($permintaan)
    {
        $this->permintaan = $permintaan;
    }

    public function view(): View
    {
        return view('permintaan.export_excel', [
            'permintaan' => $this->permintaan
        ]);
    }
}
