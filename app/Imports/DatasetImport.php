<?php

namespace App\Imports;

use App\Models\dataset;
use Maatwebsite\Excel\Concerns\ToModel;

class DatasetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new dataset([
            'username'      => $row[1],
            'tweet'     => $row[0], 
            'label'     => $row[2], 
        ]);
    }
}
