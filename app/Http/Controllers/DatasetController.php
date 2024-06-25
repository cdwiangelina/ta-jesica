<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\DatasetImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\dataset;

class DatasetController extends Controller
{
    public function ImportDataset(Request $request){

        $validate = $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new DatasetImport, request()->file('file'));
        return redirect('/dataset')->with("success", "Data Berhasil Ditambahkan!");
    }

    public function ViewDataset(){
        $dataset   = dataset::all();

        return view('master', [
            'title' => 'Dataset',
            'dataset' => $dataset
        ]);
    }
}
