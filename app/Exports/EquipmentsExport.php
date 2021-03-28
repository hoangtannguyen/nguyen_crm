<?php

namespace App\Exports;

use App\Equipment;
use Maatwebsite\Excel\Concerns\FromCollection;

class EquipmentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Equipment::all();
    }
}
