<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dataset</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="form-group col-5 mt-3 float-left">
              @if (Session::has('success')) 
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Dataset Berhasil Ditambahkan!</strong>
              </div>
              @elseif ($errors->any()) 
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                @foreach ($errors->all() as $error)
                  <strong>{{ $error }}</strong>
                @endforeach     
              </div>
              @endif
                <form action="/datasetImport" method="POST" enctype="multipart/form-data">
                  @csrf
                <label for="exampleInputFile">Upload File Dataset (.xls dan .xlsx)</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <button type="submit" class="btn btn-primary ml-2">Submit</button>
                </div>
                </form>
              </div>
        </div>
          <div class="row">
            <div class="col-12">
                
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Dataset (belum melalui proses preprocessing)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>id</th>
                    <th>username</th>
                    <th>isi tweet</th>
                    <th>label</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($dataset as $data)
                    <tr>
                      <td>{{ $data['id'] }}</td>
                      <td>{{  $data['username']  }}</td>
                      <td>{{  $data['tweet']  }}</td>
                      <td>{{  $data['label']  }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
          </div>
        </div>
    </div>

</div>