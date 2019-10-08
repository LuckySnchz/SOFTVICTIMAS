<?php

namespace App\Exports;

use App\Caso;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class CasosExport implements FromCollection
{
   use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Caso::all();
    }
}
