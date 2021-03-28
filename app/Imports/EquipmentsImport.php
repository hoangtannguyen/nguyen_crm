<?php

namespace App\Imports;

use App\Equipment;
use Maatwebsite\Excel\Concerns\ToModel;

class EquipmentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Equipment([
            //
        ]);
    }
}
