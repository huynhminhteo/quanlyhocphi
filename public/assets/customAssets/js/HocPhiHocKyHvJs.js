$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    let table = $('#hocPhiHocKyTable').DataTable({
        dom: 'Blfrtip',
        bLengthChange: true,
        lengthMenu: [[10, 20, 30, -1], [10, 20, 30, "All"]],
        buttons: ["copy", "excel"],
        bInfo: false,
        language: {
            "sSearch": "Tìm kiếm:",
            "sLengthMenu":    "Số lượng _MENU_ hiển thị",
            "paginate": {
                "previous": "Trước",
                "next":"Sau"
            }
        }
    })


    // chuyển thêm nút add  vào datatable
    // $('#nganhTable_filter')
    // .append(
    //         `
    //         <button type="button" class=" ThemDsDongTien_Btn btn btn-outline-success" data-toggle="modal" data-target="#modal-addNganh">
    //         <i class="fa fa-plus">Thêm mới</i></button>
    //         </button>
    //         `
    //         )

    //import hoc phi

    // Lấy toàn bộ ngành khi mới zo trang
    getAll_Hoc_Phi_Hoc_Vien();

    let formData
    //Bấm add model hiệnf lên
    $('input[name=file]').change(function(e) {
        formData = new FormData();
        for(var i = 0; i < this.files.length; i++){
            formData.append('file', this.files[i]);
        }
        console.log('e: ',e.target.files)
        console.log('formData: ',this.files)
    });

    $('.importBtn').on('click',function(e){
        $.ajax({
            url : '/admin/importHocphiExcel',
            type : 'post',
            data : formData,
            cache: false,
            contentType: false,
            processData: false,
            success : function (res) {
                if(res.status==200){
                    alert(res.msg)
                }
                else{
                    alert(res.msg)
                }
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                $('#post').html(msg);
            },
        })
    })

    $('.ThemDsDongTien_Btn').on('click',function(){
        $('#modal-addNganh').removeAttr('hidden')
    })
    $('.nganhTab').on('click',function(){
        getAll_Hoc_Phi_Hoc_Vien();
    })
    function getAll_Hoc_Phi_Hoc_Vien(){
        $('.overlay').show()
        $.ajax({
            type: 'POST',
            url: "/admin/getAll_Hoc_Phi_Hoc_Vien",
            success: function (data) {
                if (data.status == 200) {
                    table.clear().draw()
                    data.data.forEach(el => {
                        table.row.add([
                            el.DOT_HOC,
                            el.MA_HOC_VIEN,
                            el.HO +' '+ el.TEN,
                            el.TONG_SO_TIN_CHI,
                            addCommas(el.HOC_PHI)
                            // `<button class=" deleteNganhBtn btn btn-success btn-sm rounded-0" value='${el.ID}' type="button" data-toggle="tooltip"><i class="fa fa-edit"></i></button>
                            // <button class="updateNganhBtn btn btn-danger btn-sm rounded-0" value='${el.ID}' type="button" data-toggle="tooltip"><i class="fa fa-trash"></i></button>`
                        ]).draw(false);
                    });
                }
                $('.overlay').hide()
            }
        });
    }
    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
});
