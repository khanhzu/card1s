<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "NẠP ĐIỆN THOẠI - ".$JTech->setting('website_name');

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>

<style>
    .btn-price {
        background-color: white;
    }

    .btn-price:hover {
        background-color: white!important;
    }

    .active-price {
        border-color: #f25a23;
        border-width: 2px;
    }

    .active-price:hover {
        border-color: #f25a23;
        border-width: 2px;
    }
    
</style>

<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Nạp điện thoại</h2>
</div>
<div class="row">
    <div class="col-md-8 col-12">
        <input type="hidden" id="price" onchange="totalPay()">
        <input type="hidden" id="dial">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Thông tin thuê bao</h3>
            </div>
            <div class="block-content">
                <div class="block block-rounded">
                    <div class="row">
                        <div class="col-6">
                            <div class="custom-control custom-block custom-control-danger mb-1">
                                <input type="radio" class="custom-control-input" id="thuebao_tratruoc" name="select_thuebao" data-dial="tratruoc" onclick="selectDial(this)">
                                <label class="custom-control-label" for="thuebao_tratruoc">
                                    <span class="d-block font-w400 text-center my-3">
                                        <span class="font-size-h4 font-w600">Thuê bao trả trước</span>
                                    </span>
                                </label>
                                <span class="custom-block-indicator">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="custom-control custom-block custom-control-danger mb-1">
                                <input type="radio" class="custom-control-input" id="thuebao_trasau" name="select_thuebao" data-dial="trasau" onclick="selectDial(this)">
                                <label class="custom-control-label" for="thuebao_trasau">
                                    <span class="d-block font-w400 text-center my-3">
                                        <span class="font-size-h4 font-w600">Thuê bao trả sau</span>
                                    </span>
                                </label>
                                <span class="custom-block-indicator">
                                    <i class="fa fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-6">
                            Số điện thoại nạp tiền:
                        </div>
                        <div class="col-6">
                            <input class="form-control form-control-alt" style="color: green;" id="phone" placeholder="* Bắt buộc" type="number" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); fillPhone(this)">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Chọn mệnh giá</h3>
            </div>
            <div class="block-content">
                <div class="block block-rounded">
                    <div class="row text-center">
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="10000" onclick="selectPrice(this)">
                                10.000đ
                            </a>
                        </div>
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="20000" onclick="selectPrice(this)">
                                20.000đ
                            </a>
                        </div>
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="30000" onclick="selectPrice(this)">
                                30.000đ
                            </a>
                        </div>
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="50000" onclick="selectPrice(this)">
                                50.000đ
                            </a>
                        </div>
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="100000" onclick="selectPrice(this)">
                                100.000đ
                            </a>
                        </div>
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="200000" onclick="selectPrice(this)">
                                200.000đ
                            </a>
                        </div>
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="300000" onclick="selectPrice(this)">
                                300.000đ
                            </a>
                        </div>
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="10000" onclick="selectPrice(this)">
                                10.000đ
                            </a>
                        </div>
                        <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                            <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="500000" onclick="selectPrice(this)">
                                500.000đ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Chi tiết giao dịch</h3>
            </div>
            <div class="block-content">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-6 text-left">
                        Loại thuê bao
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="dial_detail">
                        
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-6 text-left">
                        Mệnh giá nạp
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="price_detail">
                        
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-6 text-left">
                        Số điện thoại nạp tiền
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="phone_detail">
                        
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-6 text-left">
                        Tổng tiền
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="total_pay">
                        0đ
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px; margin-top: 50px;">
                    <div class="col-12">
                        <button type="button" id="btn_purchase" class="btn btn-hero-primary btn-block" data-toggle="click-ripple" onclick="topupMobile(this)" disabled>THANH TOÁN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lịch sử nạp điện thoại</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>
                                    Mã đơn
                                </th>
                                <th>
                                    Số điện thoại
                                </th>
                                <th>
                                    TT Thuê bao
                                </th>
                                <th>
                                    Tiền nạp
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                <th>
                                    Thời gian tạo
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `topup-mobile` WHERE `username` = '".$JTech->user('username')."' ORDER BY `id` DESC LIMIT 20 ");
                                while($topup = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $topup['order_code']; ?>  
                                    </td>
                                    <td>
                                        <b><?= $topup['phone']; ?></b>
                                    </td>
                                    <td>
                                        <?= detectTelco($topup['phone']); ?>_<?= $topup['dial']; ?>
                                    </td>
                                    <td>
                                        <?= number_format($topup['price']); ?>đ  
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Thành công</span>
                                    </td>
                                    <td>
                                        <?= formatDate($topup['created_time']); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function selectPrice(data) {
        var price = $(data).attr('data-price')
        var text_price = $(data).text()
        
        $(".btn-price").removeClass('active-price')
        $(data).addClass('active-price')

        $("#price_detail").text(text_price)
        $("#price").val(price).trigger('change')
        
        btnPurchase()
    }

    function selectDial(data) {
        var dial = $(data).attr('data-dial')
        $("#dial").val(dial)

        if(dial == 'tratruoc') {
            $("#dial_detail").text('Thuê bao trả trước')
        }

        if(dial == 'trasau') {
            $("#dial_detail").text('Thuê bao trả sau')
        }

        btnPurchase()
    }

    function fillPhone(data) {
        $("#phone_detail").text($(data).val())
        btnPurchase()
    }

    function totalPay() {
        var price = $("#price").val()
        $("#total_pay").html(formatNumber(price) + "đ")
    }

    function btnPurchase() {
        var phone = $("#phone").val()
        if($("#price").val() == '' || $("#dial").val() == '' || phone.length < 10 || phone.length > 11) {
            $("#btn_purchase").attr('disabled', 'disabled')
        }else{
            $("#btn_purchase").removeAttr('disabled')
        }
    }

    function topupMobile(data) {
        Swal.fire({
            title: 'XÁC NHẬN',
            html: "Bạn có chắc chắn nạp <b>" + $("#price_detail").text() + "</b> cho <b>" + $("#phone").val() + "</b> với loại <b>" + $("#dial_detail").text() + "</b>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/ajaxs/main/client/topup.php",
                    data: {
                        dial: $("#dial").val(),
                        price: $("#price").val(),
                        phone: $("#phone").val()
                    },
                    dataType: "json",
                    beforeSend: function(){
                        Dashmix.layout('header_loader_on');
                        $(data).html("VUI LÒNG CHỜ...").attr('disabled', 'disabled')  
                    },
                    complete: function(){
                        Dashmix.layout('header_loader_off');
                        $(data).html('THANH TOÁN').removeAttr('disabled')   
                    },
                    success: function (res) {
                        if(res.status) {
                            swal(res.message, "success")
                            setTimeout(function() {
                                window.location.reload()
                            }, 1200)
                        }else{
                            swal(res.message, "error")
                        }
                    }
                });
            }
        })
    }
</script>

<?php
    require('../../layout/main/foot.php');
?>