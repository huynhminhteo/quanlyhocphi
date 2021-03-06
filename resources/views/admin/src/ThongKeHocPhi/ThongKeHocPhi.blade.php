@extends('admin.layouts.Admin')
@section('css')
 <!-- DataTables -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
 <!-- DataTables -->
<link rel="stylesheet" href="{{URL::asset('assets/defaultAssets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/defaultAssets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/defaultAssets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('js')

     <!-- DataTables  & Plugins -->
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/jszip/jszip.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/pdfmake/pdfmake.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/pdfmake/vfs_fonts.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
     <script src="{{URL::asset('assets/defaultAssets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- MyCustom -->
     <script type="text/javascript" charset="utf8" src=" {{ URL::asset('assets/customAssets/js/ThongKeJs.js') }}"></script>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Th???ng k??</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang ch???</a></li>
              <li class="breadcrumb-item active">Th???ng k?? t??nh tr???ng ????ng ti???n</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">T??nh tr???ng h???c ph??</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="thongKeTable">
                  <thead>
                    <tr>
                      <th style="width: 10%">STT</th>
                      <th style="width: 10%">M?? sinh vi??n</th>
                      <th style="width: 15%">?????t h???c</th>
                      <th style="width: 15%">H??? t??n</th>
                      <th style="width: 20%">Ti???n n???</th>
                      <th style="width: 20%">T??nh tr???ng</th>
                      <th style="width: 10px">Ti???n ?????</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>

            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->
        </div>




      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

