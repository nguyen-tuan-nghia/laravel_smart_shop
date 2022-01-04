<?php

namespace App\Imports;

use App\product;
use Maatwebsite\Excel\Concerns\ToModel;

class Excelimports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new product([
            //
        ]);
    }
}
