<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Naive Bayes</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            @if (Session::has('success')) 
            <div class="pt-4 col-5">
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Proses Preprocessing Berhasil!</strong>
              </div>
            </div>
            @endif
            @if (Session::has('error')) 
            <div class="pt-4 col-5">
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error : Dataset Kosong!</strong>
              </div>
            </div>
            @endif
          </div>
          <div class="row">
            <div class="col-12">       
            <div class="card">
                <div class="row">
                    <div class="card-header col-12">
                        <div class="ml-2 mt-2 float-left">
                            <h3 class="card-title">Tahap Preprocessing</h3>
                        </div>
                        <div class="float-right mr-2">
                        <a href="/AddPreprocessing" class="btn btn-primary">Mulai Preprocesing</a>
                        </div>
                    </div>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>id</th>
                    <th>isi tweet</th>
                    <th>cleaning</th>
                    <th>slangword</th>
                    <th>stopword</th>
                    <th>steming</th>
                    <th>label</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if ($preprocesing == null)
                    <tr>  </tr>
                  @else
                    @foreach ($preprocesing as $pre )                    
                    <tr>
                      <td>{{$pre['predata']['id']}}</td>
                      <td>{{$pre['predata']['tweet']}}</td>
                      <td>{{$pre['cleaning']}}</td>
                      <td>{{$pre['slangword']}}</td>
                      <td>{{$pre['stopword']}}</td>
                      <td>{{$pre['steming']}}</td>
                      <td>{{$pre['label']}}</td>

                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
          </div>

          <!-- data latih -->
          <div class="row">
            @if ($title == "Naive  Bayes")
            <div class="card-body">
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                <h6>Dataset belum ada atau belum melalui tahap Preprocessing</h6>
              </div>
            </div>
           @else
            <div class="col-12">
                <h5 class="mt-3"> Data Latih & Data Uji </h5>
                <hr>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Latih (90%) : {{ count($dataLatih)." " }} data</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap" id="myTable">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>isi tweet</th>
                        <th>label</th>
                      </tr>
                    </thead>
                    <tbody>
                      @for ($i=0; $i<count($dataLatih); $i++)                            
                      <tr>
                        <td> {{ $i+1 }} </td>
                        <td> {{ $dataLatih[$i]}} </td>
                        <td> {{ $labelLatih[$i]}} </td>
                      </tr>
                      @endfor
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <!-- data uji -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Uji (10%) : {{ count($dataUji)." " }} data </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap" id="myTable2">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>isi tweet</th>
                        <th>label</th>
                      </tr>
                    </thead>
                    <tbody>
                      @for ($i=0; $i<count($dataUji); $i++)                            
                        <tr>
                          <td> {{ $i+1 }} </td>
                          <td class="col-7"> {{ $dataUji[$i]}} </td>
                          <td> {{ $labelUji[$i]}} </td>
                        </tr>
                      @endfor
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <!-- hasil uji -->
          <div class="row">
            <div class="col-12">
                <h5 class="mt-3"> Hasil Uji </h5>
                <hr>
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>no</th>
                        <th>isi tweet</th>
                        <th>label</th>
                        <th>label prediksi</th>
                        <th>keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @for ($i=0; $i<count($dataUji); $i++)                            
                              <tr>
                                <td> {{ $i+1 }} </td>
                                <td class="col-7"> {{ $dataUji[$i]}} </td>
                                <td> {{ $labelUji[$i]}} </td>
                                <td> {{ $prediksiLabel[$i]}} </td>
                                <td> 
                                @if ($labelUji[$i]=="positif" && $prediksiLabel[$i]=="positif" )
                                    {{ "TP" }}
                                @elseif ($labelUji[$i]=="positif" && $prediksiLabel[$i]=="negatif")
                                {{ "FN" }}
                                @elseif ($labelUji[$i]=="negatif" && $prediksiLabel[$i]=="negatif")
                                {{ "TN" }}
                                @elseif ($labelUji[$i]=="negatif" && $prediksiLabel[$i]=="positif")
                                {{ "FP" }}
                                @endif
                                </td>
                              </tr>
                              @endfor
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>  
          
          <!--confusion matriks & hasil -->
          <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Confusion Matriks</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped text-center">
                                <tbody>
                                <tr>
                                    <th rowspan="2" colspan="2"></th>
                                    <th colspan="2">Aktual</th>
                                </tr>
                                <tr>
                                    <th> Positif </th>
                                    <th> Negatif </th>
                                </tr>
                                <tr>
                                    <th rowspan="2">Prediksi</th>
                                    <th>Positif</th>
                                    <td class="bg-success"> {{ $TP }} </td>
                                    <td class="bg-danger"> {{ $FP }} </td>
                                </tr>
                                <tr>
                                    <th>Negatif</th>
                                    <td class="bg-danger">{{ $FN }} </td>
                                    <td class="bg-success"> {{ $TN }}</td>
                                </tr>
                              
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">Hasil Evaluasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                        <table class="table table-striped text-center">
                            <thead>
                              <tr>
                                    <th>Akurasi </th>
                                    <th>Presisi </th>
                                    <th>Recall </th>
                                </tr>                   
                            </thead>
                            <tbody>
                            <tr>
                              <td> {{ (number_format($akurasi,3)*100)."%"}} </td>
                              <td> {{ (number_format($presisi,3)*100)."%"}} </td>
                              <td> {{ (number_format($recall,3)*100)."%"}} </td>
                            </tr>
                            </tbody>
                        </table>      
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
          </div>

          <!--Visualisasi data -->

          <div class="row">
            <div class="col-12">
                <h5 class="mt-3"> Visualisasi Data</h5>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <div class="card card-warning">
                            <div class="card-header">
                              <h5 class="card-title">Sentimen Negatif & Positif pada Dataset</h5>
              
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                              <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-success">
                            <div class="card-header">
                              <h5 class="card-title">Sentimen Negatif & Positif pada Data Latih</h5>
              
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                              <canvas id="pieChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </div>
                    <div class="col-4">
                        <div class="card card-danger">
                            <div class="card-header">
                              <h5 class="card-title">Sentimen Negatif & Positif pada Data Uji</h5>
              
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                              <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </div>
                </div>
            </div>
          </div>

        </div>
    </div>
@endif
</div>