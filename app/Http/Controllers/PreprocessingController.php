<?php

namespace App\Http\Controllers;

use App\Models\dataset;
use App\Models\preprocesing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Sastrawi\Stemmer\StemmerFactory;

class PreprocessingController extends Controller
{
    public function PreprocesView(){

        $data = preprocesing::all();

        return view('master', [
            'title' => 'Naive Bayes',
            'preprocesing' => $data,
        ]);
    }

    
    public function cleaning($casefolding){
        
        // hapus url
        $url = preg_replace('/\b((https?|ftp|file):\/\/|www\.)[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', ' ', $casefolding);
        
        // hapus @
        $mention =  preg_replace('/(@)[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', ' ', $url);
        
        // hapus \n
        $n =  preg_replace('/(\n)[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', ' ', $mention);
        
        // hapus #
        $hastag =  preg_replace('/(#)[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', ' ', $n);
        
        // menghapus karakter yang tidak diinginkan
        $clean = preg_replace("/[^a-zA-Z ]/", " ", $hastag);
        
        $cleaning = trim($clean); 
        
        return $cleaning;
    }
    
    public function slangword($data){

        
        $kata = explode(" ", $data);
        $jmlh = count($kata);
        
        $slangword = DB::table('slangword')->get();

        // array assosiatif
        $keyed = $slangword->map(function ($item) {
             return [$item->kata_slang => $item->kata_benar];
        });

        $kamus = $keyed->all();
        $jmlhkamus = count($kamus);

        for($i = 0; $i<$jmlh; $i++){
            for($j=0; $j<$jmlhkamus; $j++){
                foreach($kamus[$j] as $x => $x_value) {
                    if($kata[$i] == $x){
                        $kata[$i] = $x_value;
                    }
                }
            }
        }

        $hasil_teks = implode(" ",$kata);
        return $hasil_teks;

    }

    public function stopword($str)
    {
        $kata = explode(" ",$str);
        
        $stopwords = DB::table('stopwords')->get();

        // array assosiatif
        $keyed = $stopwords->map(function ($item) {
            return [$item->stopword => $item->keyword];
       });

        $kamus = $keyed->all();
        
        if(count($kata) > 1)
        {
            for($i = 0; $i<count($kamus); $i++){
                $nilai = $kamus[$i];
                $kata = array_filter($kata, function ($w) use (&$nilai) {
                return !isset($nilai[strtolower($w)]);       # if utf-8: mb_strtolower($w, "utf-8")
                });
            }
        }  
        // check if not too much was removed such as "the the" would return empty
        if(!empty($kata))
            return implode(" ", $kata);
        return $kata;
    }

    public function stemming($str){
        
        require_once '/laragon/www/jesica-ta/vendor/autoload.php';

        $stemmerFactory = new StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();

        $steming   = $stemmer->stem($str);   

        return $steming;    
    }
    
    public function AddPreproces(){

        // tambahin dataset id
        $dataset   = dataset::all();
        $jmlhdataset   = dataset::count();

        if($jmlhdataset == null){
            return redirect('/preprocessing')->with("error", "Dataset Kosong!");
        }

        foreach($dataset as $data){

            // casefolding
            $casefolding = strtolower(trim($data['tweet']));

            $cleaning = app('App\Http\Controllers\PreprocessingController')->cleaning($casefolding);

            $slangword = app('App\Http\Controllers\PreprocessingController')->slangword($cleaning);
            
            $stopwords = app('App\Http\Controllers\PreprocessingController')->stopword($slangword);

            $steming = app('App\Http\Controllers\PreprocessingController')->stemming($stopwords);


            preprocesing::updateOrCreate([
                "dataset_id" => $data['id'],
                "label" => $data['label'],
                "cleaning" => $cleaning,
                "slangword" => $slangword,
                "stopword" => $stopwords,
                "steming" => $steming,

            ]);
        }

        return redirect('/naivebayes')->with("success", "Proses Preprocessing Berhasil!");
    }
}
