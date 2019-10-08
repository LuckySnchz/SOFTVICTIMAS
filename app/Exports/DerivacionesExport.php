<?php

namespace App\Exports;

use App\Derivacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class DerivacionesExport implements FromCollection
{
   use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Derivacion::all();
    }
}
