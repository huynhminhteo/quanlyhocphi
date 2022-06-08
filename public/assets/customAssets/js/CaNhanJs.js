$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    let temp
    let keys
    $.ajax({
        type: 'POST',
        url: "/admin/getAllChiTietCaNhan",
        success: function (data) {
            $('.profile-username').html(data.hocVien[0].HO + ' ' + data.hocVien[0].TEN)
            $('.GIOITINH').html(data.hocVien[0].PHAI)
            $('.MSV').html(data.hocVien[0].MA_HOC_VIEN)
            $('.SDT').html(data.hocVien[0].DIEN_THOAI)
            $('.EMAIL').html(data.hocVien[0].EMAIL)
            $('.DIACHI').html(data.hocVien[0].DIA_CHI)
            let tongHocPhi = 0;
            let tongTienDaTra = 0;
            let tongNo = 0;
            $('.hocKy').append(`<option value="null">--ALL--</option>`)
            $stt = 1
            data.listKey.forEach(el => {
                $('.hocKy').append(`<option value="${el}">${el}</option>`)
                data.data[el].MONS.forEach(mon => {
                    $('.MON').append(`<span class="tag tag-danger"><b>${mon.TEN_MH} </b>: ${ Math.round(mon.SO_TIN_CHI * 100) / 100} tín chỉ </span>`)
                    $('.mon').append(` ${mon.TEN_MH} <br>`)
                    $('.tinChi2').append(` ${mon.SO_TIN_CHI} <br>`)
                    $('.myTable > tbody').append(`
                            <tr>
                                <td>${$stt}</td>
                                <td>${mon.MA_MH}</td>
                                <td>${mon.TEN_MH}</td>
                                <td>${mon.SO_TIN_CHI}</td>
                            </tr>
                        `)
                    $stt++

                });

                tongHocPhi += Number(data.data[el].HOC_PHI[0].HOC_PHI)
                tongNo += Number(data.data[el].NO_HOC_PHI[0].SO_TIEN_NO)
                tongTienDaTra = tongHocPhi - tongNo
            });
            $('.chiPhi1').html(addCommas(tongHocPhi))
            $('.chiPhi2').html(addCommas(tongTienDaTra))
            $('.chiPhi3').html(addCommas(tongNo))

            $('.TK_hocPhi').html(addCommas(tongHocPhi))
            $('.TK_daDong').html(addCommas(tongTienDaTra))
            $('.TK_tienNo').html(addCommas(tongNo))
            // localStorage.setItem('dataKey', data.listKey);
            temp = data.data
            keys = data.listKey
            // console.log(data.data)
        }
    });


    $(".hocKy").change(function (e) {
        var timer = setInterval(function () {
            if (temp) {
                console.log('t nè: ', e.target.value)
                if (e.target.value == 'null') {
                    if(keys){
                        let tongHocPhi2 = 0;
                        let tongTienDaTra2 = 0;
                        let tongNo2 = 0;
                        $stt = 1
                        $('.mon').html(``)
                        $('.tinChi2').html(``)
                        $('.myTable > tbody').html('')
                        keys.forEach(el => {
                            temp[el].MONS.forEach(mon => {
                                $('.mon').append(` ${mon.TEN_MH} <br>`)
                                $('.tinChi2').append(` ${mon.SO_TIN_CHI} <br>`)
                                $('.myTable > tbody').append(`
                                        <tr>
                                            <td>${$stt}</td>
                                            <td>${mon.MA_MH}</td>
                                            <td>${mon.TEN_MH}</td>
                                            <td>${mon.SO_TIN_CHI}</td>
                                        </tr>
                                    `)
                                $stt++

                            });

                            tongHocPhi2 += Number(temp[el].HOC_PHI[0].HOC_PHI)
                            tongNo2 += Number(temp[el].NO_HOC_PHI[0].SO_TIEN_NO)
                            tongTienDaTra2 = tongHocPhi2 - tongNo2
                        });
                        $('.chiPhi1').html(addCommas(tongHocPhi2))
                        $('.chiPhi2').html(addCommas(tongTienDaTra2))
                        $('.chiPhi3').html(addCommas(tongNo2))
                    }
                }
                else {
                    //gán đợt 2
                    let tongHocPhi = 0;
                    let tongTienDaTra = 0;
                    let tongNo = 0;
                    $stt = 1
                    $('.mon').html(``)
                    $('.tinChi2').html(``)
                    $('.myTable > tbody').html('')
                    temp[e.target.value].MONS.forEach(mon => {
                        $('.mon').append(` ${mon.TEN_MH} <br>`)
                        $('.tinChi2').append(` ${mon.SO_TIN_CHI} <br>`)
                        $('.myTable > tbody').append(`
                                                        <tr>
                                                            <td>${$stt}</td>
                                                            <td>${mon.MA_MH}</td>
                                                            <td>${mon.TEN_MH}</td>
                                                            <td>${mon.SO_TIN_CHI}</td>
                                                        </tr>
                                                    `)
                        $stt++
                    });
                    tongHocPhi += Number(temp[e.target.value].HOC_PHI[0].HOC_PHI)
                    tongNo += Number(temp[e.target.value].NO_HOC_PHI[0].SO_TIEN_NO)
                    tongTienDaTra = tongHocPhi - tongNo
                    $('.chiPhi1').html(addCommas(tongHocPhi))
                    $('.chiPhi2').html(addCommas(tongTienDaTra))
                    $('.chiPhi3').html(addCommas(tongNo))
                }

                clearInterval(timer)
                return
            }

        }, 100);
    });
    let inputEmail=''
    let inputPhone=''
    let inputAddress=''
    let inputNote=''
    $('#inputEmail').on('change',function(e){
        inputEmail = e.target.value
        console.log(inputEmail)
    })
    $('#inputPhone').on('change',function(e){
        inputPhone = e.target.value
        console.log(inputPhone)
    })
    $('#inputAddress').on('change',function(e){
        inputAddress = e.target.value
        console.log(inputAddress)
    })
    // $('#inputNote').on('change',function(e){
    //     inputNote = e.target.value
    //     console.log(inputNote)
    // })

    $('.changeProfile').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "/admin/updateChitietCaNhan",
            data : {
                    email :inputEmail,
                    phone:inputPhone,
                    address:inputAddress,
                },
            success: function (res) {
                if(res.status==200){
                    $('.SDT').html(res.data.phone)
                    $('.EMAIL').html(res.data.email)
                    $('.DIACHI').html(res.data.address)
                    console.log(res.data)
                    alert(res.msg)
                }else{
                    alert(res.msg)
                }

            }
        });
    })




});


function addCommas(nStr) {
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
