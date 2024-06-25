<?php

namespace App\Http\Controllers;

use App\Models\preprocesing;
use Illuminate\Http\Request;
use Phpml\Dataset\ArrayDataset;  
use Illuminate\Routing\Controller;
use Phpml\CrossValidation\RandomSplit;

class ModelController extends Controller
{
    public function model(Request $request){

        $getData = preprocesing::all();
        $cekData = preprocesing::all()->count();

        if($cekData == 0){ // buat cek udah di preprocessing atau belum
            return view('master', [
                'title' => 'Naive  Bayes',
                'preprocesing' => $getData,
                'data' => 0,
            ]);
        } else{

            // hitung data set berlabel negatif dan positif
            $datasetNegatif = preprocesing::where('label', 'negatif')->count();
            $datasetPositif = preprocesing::where('label', 'positif')->count();

            // memanggil dataset clean
            $tweet = array();
            $label = array();
            
            foreach ($getData as $data) {
                $tweet [] = $data->steming;
                $label [] = $data->label;
            }
    
            $dataset = new ArrayDataset(
                $tweet, $label
            );


            // =================== bagi data ===================
            $randomSplit = new RandomSplit($dataset, 0.1, 20);
            // data latih
            $dataLatih  =  $randomSplit->getTrainSamples();
            $labelLatih =  $randomSplit->getTrainLabels();
            // data Uji
            $dataUji  =  $randomSplit->getTestSamples();
            $labelUji =  $randomSplit->getTestLabels();

            // =================== proses bag of words ===================
            // untuk menyatukan array jadi sebuah kalimat digabung untuk dicari kata uniknya
            $dataLatihGabung = implode(' ', $dataLatih);

            // untuk buat kalimat menjadi kata
            $dataLatihPisah = explode(' ', $dataLatihGabung);

            // jumlah kata unik data latih (kosakata)
            $uniques = array_unique($dataLatihPisah); 
            $dataUnik = count($uniques);

            // pisahkan data latih positif dan negatif
            // data latih positif
            $dataLatihPositif = array();
            $flag = 0;
            for($i=0; $i<count($dataLatih); $i++){
                if($labelLatih[$i] == "positif"){
                    $dataLatihPositif[$flag] = $dataLatih[$i];
                    $flag += 1;
                }
            }

            // untuk menyatukan array jadi sebuah kalimat
            $arrayPositif = implode(' ', $dataLatihPositif);

            // untuk buat kalimat menjadi kata
            $dataPositif = explode(' ', $arrayPositif);

            // jumlah dokument data latih positif / Docs J
            $docLatihPositif = count($dataLatihPositif);

            // menghitung jumlah kemunculan kata unik pada label positif (ni)
            $niLatihPositif   = array_count_values($dataPositif);

            // menghitung jumlah seluruh kata berlabel positif (N)
            $NLatihPositif = count($dataPositif);

            // data latih negatif
            $dataLatihNegatif = array();
            $flagN = 0;
            for($i=0; $i<count($dataLatih); $i++){
                if($labelLatih[$i] == "negatif"){
                    $dataLatihNegatif[$flagN] = $dataLatih[$i];
                    $flagN += 1;
                }
            }

            // untuk menyatukan array jadi sebuah kalimat
            $arrayNegatif = implode(' ', $dataLatihNegatif);

            // untuk buat kalimat menjadi kata
            $dataNegatif = explode(' ', $arrayNegatif);

            // jumlah dokument data latih negatif
            $docLatihNegatif = count($dataLatihNegatif);

            // menghitung jumlah kemunculan kata unik pada label negatif (ni)
            $niLatihNegatif   = array_count_values($dataNegatif);

            // menghitung jumlah seluruh kata berlabel negatif (N)
            $NLatihNegatif= count($dataNegatif);  
           
            //=================== NAIVE BAYES ===================
            // hitung probabilitas positif 
            $PvjPositif = $docLatihPositif/count($dataLatih);
            $hitungPositif = array();

            // pecah kata uji per kalimat
            $pecahKataUji = array();
            for($i=0; $i<count($dataUji); $i++){ // menghitung banyak kalimat
                $pecahKataUji[$i] = explode(' ', $dataUji[$i]); // pecah kalimat menjadi per kata
                for($j=0; $j<count($pecahKataUji[$i]); $j++){ // looping untuk proses mencari banyak kata
                    foreach($niLatihPositif as $positif => $nilai){ // bag of words data latih
                        if($pecahKataUji[$i][$j] == $positif){ // kalo pecah kata uji sama kayak di bagofword
                            $ni = $nilai + 1;
                            $hitungPositif[$i][$j] = $ni / ($NLatihPositif+$dataUnik);
                            break;
                        } else{
                            $ni = 0 + 1;
                            $hitungPositif[$i][$j] = $ni / ($NLatihPositif+$dataUnik);
                        }
                    }
                }
            }

            $hasilPositif = array();
            $hitungArrayPositif = 1;
            $nilaiPositif = 1;
            for($i=0; $i<count($hitungPositif); $i++){
                for($j=0; $j<count($hitungPositif[$i]); $j++){
                    $hitungArrayPositif = $hitungPositif[$i][$j];
                    $nilaiPositif *= $hitungArrayPositif;
                }
                $hasilPositif[$i] = $PvjPositif*$nilaiPositif;
                $hitungArrayPositif = 1;
                $nilaiPositif = 1;
            }

 
            // hitung probabilitas Negatif
            $PvjNegatif = $docLatihNegatif/count($dataLatih);
            
            $hitungNegatif = array();
            // pecah kata uji per kalimat
            $pecahKataUjiNegatif = array();
            for($i=0; $i<count($dataUji); $i++){
                $pecahKataUjiNegatif[$i] = explode(' ', $dataUji[$i]);
                for($j=0; $j<count($pecahKataUjiNegatif[$i]); $j++){
                    foreach($niLatihNegatif as $Negatif => $nilai){
                        if($pecahKataUjiNegatif[$i][$j] == $Negatif){
                            $ni = $nilai + 1;
                            $hitungNegatif[$i][$j] = $ni / ($NLatihNegatif+$dataUnik);
                            break;
                        } else{
                            $ni = 0 + 1;
                            $hitungNegatif[$i][$j] = $ni / ($NLatihNegatif+$dataUnik);
                        }
                    }
                }
            }
            
            $hasilNegatif = array();
            $hitungArrayNegatif = 1;
            $nilaiNegatif = 1;
            for($i=0; $i<count($hitungNegatif); $i++){
                for($j=0; $j<count($hitungNegatif[$i]); $j++){
                    $hitungArrayNegatif = $hitungNegatif[$i][$j];
                    $nilaiNegatif *= $hitungArrayNegatif;
                }
                $hasilNegatif[$i] = $PvjNegatif*$nilaiNegatif;
                $hitungArrayNegatif = 1;
                $nilaiNegatif = 1;
            }

         
           // =================== Prediksi ===================
           $labelPrediksi = array();

           for($i=0; $i<count($dataUji); $i++){
               if($hasilPositif[$i] > $hasilNegatif[$i]){
                   $labelPrediksi[$i] = "positif";
               } else{
                   $labelPrediksi[$i] = "negatif";
               }
           }

           // =================== Confusion Matrix ===================
            $TP = 0; $TN=0; $FP=0; $FN=0;
            for($i=0; $i<count($dataUji); $i++)  {
                
                if ($labelUji[$i]=="positif" && $labelPrediksi[$i]=="positif" ){
                    $TP +=1; 
                }
                elseif ($labelUji[$i]=="positif" && $labelPrediksi[$i]=="negatif"){
                    $FN +=1;
                }
                elseif ($labelUji[$i]=="negatif" && $labelPrediksi[$i]=="negatif"){
                    $TN +=1;
                }
                elseif ($labelUji[$i]=="negatif" && $labelPrediksi[$i]=="positif"){
                    $FP +=1;
                }
            }

            $akurasi = ($TP+$TN)/($TP+$FP+$FN+$TN); 
            $presisi = ($TP)/($TP+$FP); 
            $recall = ($TP)/($TP+$FN);    


            $labelNegatifUji = 0;
            $labelPositifUji = 0;
    
            for($i = 0; $i<count($dataUji); $i++){
                if($labelUji[$i] == 'negatif'){
                    $labelNegatifUji += 1;
                } else{
                    $labelPositifUji += 1;
                }
            }

            $sentimenDataLatihP = round((($docLatihPositif/count($dataLatih))*100),2);
            $sentimenDataLatihN = round((($docLatihNegatif/count($dataLatih))*100),2);
            $sentimendatasetP = round((($datasetPositif/$cekData)*100),2);
            $sentimendatasetN = round((($datasetNegatif/$cekData)*100),2);
            $sentimenDataUjiP = round((($labelPositifUji/count($dataUji))*100),2);
            $sentimenDataUjiN = round((($labelNegatifUji/count($dataUji))*100),2);

            return view('master', [
                'title' => 'Naive Bayes',
                'preprocesing' => $getData,
                'dataLatih' => $dataLatih,
                'labelLatih' => $labelLatih,
                'dataUji' => $dataUji,
                'labelUji' => $labelUji,
                'prediksiLabel' => $labelPrediksi,
                'labelNegatifLatih' => $sentimenDataLatihN,
                'labelPositifLatih' => $sentimenDataLatihP,
                'labelNegatifUji' => $sentimenDataUjiN,
                'labelPositifUji' => $sentimenDataUjiP,
                'datasetNegatif' => $sentimendatasetN,
                'datasetPositif' => $sentimendatasetP,
                'TP' => $TP,
                'FP' => $FP,
                'FN' => $FN,
                'TN' => $TN,
                'akurasi' => $akurasi,
                'presisi' => $presisi,
                'recall' => $recall,
                'bowPositif' => $niLatihPositif,
                'bowNegatif' => $niLatihNegatif,
                'data' => 'aman',
            ]);
        }

    }  

}
