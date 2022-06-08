@extends('admin.layouts.Admin')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

@endsection
@section('js')

    <!-- MyCustom -->
    <script type="text/javascript" charset="utf8" src=" {{ URL::asset('assets/customAssets/js/CaNhanJs.js') }}"></script>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thông tin cá nhân</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Thông tin cá nhân</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{URL::asset('assets/defaultAssets/dist/img/user4-128x128.jpg')}}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">Nina Mcintire</h3>

                                <p class="text-muted text-center GIOITINH">Sinh viên</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Sinh viên năm</b> <a class="float-right">4</a> <br>
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Mã sinh viên</b> <a class="float-right MSV">412512512</a>
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Số điện thoại</b> <a class="float-right SDT">41254215125</a>
                                    </li>
                                    <li class="list-group-item ">
                                        <b>Email</b> <a class="float-right EMAIL">hv124@gmail.com</a>
                                    </li>
                                </ul>

                                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Chi tiết</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Ngành học</strong>

                                <p class="text-muted">
                                    Công nghệ thông tin
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa chỉ</strong>

                                <p class="text-muted DIACHI">381/23/6/16</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Tổng số tín chỉ  </strong>

                                <p class="text-muted MON"  style="display: flex !important ; flex-direction:column !important">

                                </p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Lời nhắn</strong>

                                <p class="text-muted">...</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Thông tin học phí</a></li>

                                    <li class="nav-item"><a class="nav-link" href="#settings"
                                            data-toggle="tab">Cập nhật thông tin cá nhân</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="card-body">
                                            <div class="row">
                                              <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                                <div class="row">
                                                  <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                      <div class="info-box-content">
                                                        <span class="info-box-text text-center text-muted">Học phí học kì</span>
                                                        <span class="info-box-number text-center text-muted mb-0 TK_hocPhi">2300</span>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                      <div class="info-box-content">
                                                        <span class="info-box-text text-center text-muted">Số tiền đã đóng</span>
                                                        <span class="info-box-number text-center text-muted mb-0 TK_daDong">2000</span>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                      <div class="info-box-content">
                                                        <span class="info-box-text text-center text-muted">Số tiền nợ</span>
                                                        <span class="info-box-number text-center text-muted mb-0 TK_tienNo">20</span>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-12">


                                                    <div class="invoice p-3 mb-3">
                                                        <!-- title row -->
                                                        <div class="row">
                                                          <div class="col-12">
                                                            <h4>
                                                              <i class="fas fa-globe"></i> Danh sách môn học
                                                              <small class="float-right" style="display: flex;width:30%">
                                                                    <span style="width: 50%;padding:5px">Đợt học:</span>
                                                                    <select class="form-control hocKy">

                                                                    </select>
                                                              </small>
                                                            </h4>
                                                          </div>
                                                          <!-- /.col -->
                                                        </div>
                                                        <!-- info row -->
                                                        <div class="row invoice-info" style="margin-top: 10px">
                                                          <div class="col-sm-4 invoice-col">
                                                            <h3>Môn</h3>
                                                            <address class="mon">

                                                            </address>
                                                          </div>
                                                          <!-- /.col -->
                                                          <div class="col-sm-4 invoice-col">
                                                            <h3>Số tín chỉ</h3>
                                                            <address class="tinChi2">

                                                            </address>
                                                          </div>
                                                          <!-- /.col -->
                                                          <div class="col-sm-4 invoice-col">
                                                            <b>Chi phí</b><br>
                                                            <br>
                                                            <b >Học phí:</b> <span class="chiPhi1"></span><br>
                                                            <b >Số tiền đã trã:</b> <span class="chiPhi2"></span><br>
                                                            <b >Tiền nợ:</b> <span class="chiPhi3"></span>
                                                          </div>
                                                          <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->

                                                        <!-- Table row -->
                                                        <div class="row">
                                                          <div class="col-12 table-responsive">
                                                            <table class="table table-striped myTable">
                                                              <thead>
                                                              <tr>
                                                                <th>STT</th>
                                                                <th>Mã môn</th>
                                                                <th>Tên môn</th>
                                                                <th>Số tín chỉ</th>
                                                              </tr>
                                                              </thead>
                                                              <tbody>

                                                              </tbody>
                                                            </table>
                                                          </div>
                                                          <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->

                                                        <div class="row">
                                                          <!-- accepted payments column -->
                                                          <div class="col-6">
                                                            <p class="lead">Phương thức đóng tiền :</p>
                                                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                                              Tài khoản argibank : 0212346574
                                                            </p>
                                                          </div>
                                                        </div>
                                                        <!-- /.row -->


                                                      </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                    </div>


                                    <div class="tab-pane" id="settings">
                                        <form class="form-horizontal changeProfile"  >
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputEmail"
                                                        placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPhone" class="col-sm-2 col-form-label">Số điện thoại</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputPhone"
                                                        placeholder="Số điện thoại">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAddress"
                                                    class="col-sm-2 col-form-label">Địa chỉ</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="inputAddress" placeholder="Địa chỉ"></textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <label for="inputNote" class="col-sm-2 col-form-label">Lời nhắn</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputNote"
                                                        placeholder="Lời nhắn">
                                                </div>
                                            </div> --}}

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Xác nhận đổi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    @endsection






