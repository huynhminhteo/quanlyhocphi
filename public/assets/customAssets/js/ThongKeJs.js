$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function  () {
    let temp

    (async function(){
        temp = await getAll_Hoc_Phi_Hoc_Vien();

    })();

    let table = $('#thongKeTable').DataTable({
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



    var timer = setInterval(myFunction, 100);
    function myFunction() {
        if(temp) {
            console.log(temp)

            temp.data.forEach(el => {
                table.row.add([
                    el.STT,
                    el.MA_HOC_VIEN,
                    el.DOT_HOC,
                    el.HO_TEN,
                    addCommas(el.TIEN_CON_THIEU),
                    renderTienDo(el.TIEN_DO),
                    renderTinhTrang(el.TIEN_DO),
                ]).draw(false);
            });

            clearInterval(timer);
            return;
        }
    }

    function renderTienDo($tiendo){
        if($tiendo==100){
            return (
               ` <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar bg-success" style="width: ${$tiendo}%"></div>
                </div>`
            );
        }
        else if($tiendo==0){
            return (
               `<div class="progress progress-xs" >
                    <div class="progress-bar bg-danger progress-bar-danger" style="width: ${$tiendo}%"></div>
                </div>`
            );
        }
        else {
            return (
               `<div class="progress progress-xs">
                    <div class="progress-bar bg-warning" style="width: ${$tiendo}%"></div>
                </div>`
            );
        }
    }

    function renderTinhTrang($tinhtrang){
        if($tinhtrang==100){
            return (
               `<span class="badge bg-success">${$tinhtrang}%</span>`
            );
        }
        else if($tinhtrang==0){
            return (
               ` <span class="badge bg-danger">${$tinhtrang}%</span>`
            );
        }
        else {
            return (
               `<span class="badge bg-warning">${$tinhtrang}%</span>`
            );
        }
    }

});
async function getAll_Hoc_Phi_Hoc_Vien(){
    $('.overlay').show()
    return $.ajax({
        type: 'POST',
        url: "/admin/getAllThongKe",
        success: function (data) {
            data.data
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

