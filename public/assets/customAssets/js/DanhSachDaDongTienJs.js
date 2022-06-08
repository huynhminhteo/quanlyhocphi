$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    let table = $('#danhSachDaDongTable').DataTable({
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
    });

    // chuyển thêm nút add  vào datatable
    // $('#khoaTable_filter').append(
    //                                 `
    //                                 <button type="button" class=" addKhoaBtn btn btn-outline-success" data-toggle="modal" data-target="#modal-addKhoa">
    //                                 <i class="fa fa-plus">Thêm mới</i></button>
    //                                 </button>
    //                                 `
    //                                 )

    // Lấy toàn bộ ngành khi mới zo trang
    // getAll_Import_AGR();

    //Bấm add model hiệnf lên

    $('.addKhoaBtn').on('click',function(){
        $('#modal-addKhoa').removeAttr('hidden')
    })
    $('.khoaTab').on('click',function(){
        getAll_Import_AGR();
    })


    function getAll_Import_AGR(){
        $('.overlay').show()
        $.ajax({
            type: 'POST',
            url: "/admin/getAll_Import_AGR",
            success: function (data) {
                if (data.status == 200) {
                    table.clear().draw()
                    data.data.forEach(el => {
                        table.row.add([
                            el.DOT_HOC,
                            el.NGAY_NOP_HOC_PHI,
                            el.MA_HOC_VIEN,
                            el.HO +' '+ el.TEN,
                            el.NOI_DUNG_AGR_OCB,
                            addCommas(el.SO_TIEN),
                            el.SO_GIAO_DICH,
                            el.NGAN_HANG,
                            el.LOAI_HOC_PHI
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
