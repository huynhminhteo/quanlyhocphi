@extends('admin.layouts.Admin')
@section('css')
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ URL::asset('assets/defaultAssets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
      <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::asset('assets/defaultAssets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/defaultAssets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/defaultAssets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <style>
        .importExcelDsDongTien_Btn{
            display: inline-flex;
            margin-bottom: 15px;
            height: 75%;
            margin-left: 5%;
        }
        .importExcelDsDongTien_Btn i{
            margin-top: 5px;
        }
        .file{
            width: 60%;
        }
        .flex-wrap{
            margin-left: 60px;
            margin-top :-10px;
        }
        div.dataTables_wrapper div.dataTables_length select{
            width: 50%;
        }

    </style>
@endsection
@section('js')
    <!-- DataTables  & Plugins -->
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> --}}


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


    <!-- overlayScrollbars -->
    <script src="{{ URL::asset('assets/defaultAssets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src=" {{ URL::asset('assets/customAssets/js/HocPhiHocKyHvJs.js') }}"></script>
    <script type="text/javascript" charset="utf8" src=" {{ URL::asset('assets/customAssets/js/DanhSachDaDongTienJs.js') }}"></script>
    <script type="text/javascript" charset="utf8" src=" {{ URL::asset('assets/customAssets/js/DanhSachNoJs.js') }}"></script>
@endsection
@section('content')
    <!-- Main content -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            Trang quản trị

                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Quản trị</a></li>
                            <li class="breadcrumb-item active">Dữ liệu cơ sở</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <h4>Dữ liệu cơ sở </h4>
                    </div>
                    <div class="col-4">
                        <form method="POST" enctype="multipart/form-data"
                            action="/admin/importHocphiExcel" class="btn btn-outline-success importExcelDsDongTien_Btn">
                            <input type="file" name="file" class="file"  data-buttonText="Chọn file" >
                            <i class="fa fa-plus importBtn">Thêm danh sách </i></button>
                        </form>
                    </div>
                </div>

                <!-- /.card-body -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                                    <li class="nav-item nganhTab">
                                        <a class="nav-link active " id="custom-tabs-five-overlay-tab" data-toggle="pill"
                                            href="#nganh" role="tab" aria-controls="custom-tabs-five-overlay"
                                            aria-selected="true">Học phí học kì học viên</a>
                                    </li>
                                    <li class="nav-item khoaTab">
                                        <a class="nav-link " id="custom-tabs-five-overlay-dark-tab" data-toggle="pill"
                                            href="#khoa" role="tab" aria-controls="custom-tabs-five-overlay-dark"
                                            aria-selected="false">Danh sách đã đóng</a>
                                    </li>
                                    <li class="nav-item monTab">
                                        <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill"
                                            href="#mon" role="tab" aria-controls="custom-tabs-five-normal"
                                            aria-selected="false">Danh sách nợ học phí</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    {{-- Học phí học kì học viên --}}
                                    <div class="tab-pane fade show active" id="nganh" role="tabpanel"
                                        aria-labelledby="custom-tabs-five-overlay-tab">
                                        <div class="overlay-wrapper">
                                            <div class="card">
                                                {{-- page mới này --}}
                                                @include(
                                                    'admin.src.ManyTable.HocPhiHocKyHvTable.HocPhiHocKyHv'
                                                )
                                            </div>
                                            <div class="overlay-wrapper">
                                                <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                                    <div class="text-bold pt-2">Loading...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- danh sách đã đóng --}}
                                    <div class="tab-pane fade" id="khoa" role="tabpanel"
                                        aria-labelledby="custom-tabs-five-overlay-dark-tab">
                                        <div class="overlay-wrapper">
                                            <div class="card">
                                                {{-- page mới này --}}
                                                @include(
                                                    'admin.src.ManyTable.DanhSachDaDongTienTable.DanhSachDaDongTien'
                                                )
                                            </div>
                                            <div class="overlay-wrapper">
                                                <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                                    <div class="text-bold pt-2">Loading...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Danh sách nợ học phí --}}
                                    <div class="tab-pane fade" id="mon" role="tabpanel"
                                        aria-labelledby="custom-tabs-five-normal-tab">
                                        <div class="overlay-wrapper">
                                            <div class="card">
                                                {{-- page mới này --}}
                                                @include(
                                                    'admin.src.ManyTable.DanhSachNoTable.DanhSachNo'
                                                )
                                            </div>
                                            <div class="overlay-wrapper">
                                                <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                                    <div class="text-bold pt-2">Loading...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

