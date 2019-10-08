<?php

namespace App\Exports;

use App\Demanda;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class IncidenciasExport implements FromCollection
{
   use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Demanda::all();
    }
}
