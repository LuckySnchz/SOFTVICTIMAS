<?php

namespace App\Exports;

use App\Victim;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class VictimasExport implements FromCollection
{
   use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Victim::all();
    }
}
