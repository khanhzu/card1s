<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "MUA MÃ THẺ - ".$JTech->setting('website_name');

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>

<script>
    let amountMax = <?= $JTech->setting('max_amount_buy_card'); ?>; // SỐ LƯỢNG TỐI ĐA MUA THẺ
</script>

<style>
    .btn-telco {
        background-color: white;
    }

    .btn-telco:hover {
        background-color: white!important;
    }

    .active-telco {
        border-color: #f25a23;
        border-width: 2px;
    }

    .active-telco:hover {
        border-color: #f25a23;
        border-width: 2px;
    }

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

    /* .amount_panel {
        display: table;
        padding-right: 4px;
        margin-bottom: 10px;
    } */

    .amount_box { 
        border-radius: 6px;
        border: 1px solid #e3e3e3;
        padding: 4px 10px;
        color: #000;
        text-align: center;
        width: 50px;
    }

    
</style>
<!-- Overview -->
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Mua mã thẻ</h2>
</div>
<div class="row">
    <div class="col-md-8 col-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Chọn nhà mạng</h3>
            </div>
            <div class="block-content">
                <div class="block block-rounded">
                    <input type="hidden" id="telco" onchange="loadPrice(this)">
                    <input type="hidden" id="price" onchange="totalPay()">
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab-phone">Thẻ điện thoại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-game">Thẻ game</a>
                        </li>
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <div class="tab-pane fade fade-up show active" id="tab-phone" role="tabpanel">
                            <div class="row text-center">
                                <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                                    <a class="btn btn-alt-secondary btn-telco" data-telco="Viettel">
                                        <img src="/frontend/main/assets/media/telco/viettel.png" width="100" height="50">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                                    <a class="btn btn-alt-secondary btn-telco" data-telco="Vinaphone">
                                        <img src="/frontend/main/assets/media/telco/vinaphone.jpeg" width="100" height="50">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                                    <a class="btn btn-alt-secondary btn-telco" data-telco="Vietnammobile">
                                        <img src="/frontend/main/assets/media/telco/vietnammobile.jpeg" width="100" height="50">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                                    <a class="btn btn-alt-secondary btn-telco" data-telco="Mobifone">
                                        <img src="/frontend/main/assets/media/telco/mobifone.jpeg" width="100" height="50">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade fade-up" id="tab-game" role="tabpanel">
                            <div class="row text-center">
                                <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                                    <a class="btn btn-alt-secondary btn-telco" data-telco="Zing">
                                        <img src="/frontend/main/assets/media/telco/zing.png" width="100" height="50">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                                    <a class="btn btn-alt-secondary btn-telco" data-telco="Vcoin">
                                        <img src="/frontend/main/assets/media/telco/vcoin.png" width="100" height="50">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                                    <a class="btn btn-alt-secondary btn-telco" data-telco="Gate">
                                        <img src="/frontend/main/assets/media/telco/gate.png" width="100" height="50">
                                    </a>
                                </div>
                                <div class="col-md-3 col-6" style="margin-bottom: 15px;">
                                    <a class="btn btn-alt-secondary btn-telco" data-telco="Garena">
                                        <img src="/frontend/main/assets/media/telco/garena.png" width="100" height="50">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Chọn mệnh giá</h3>
            </div>
            <div class="block-content" id="price_handle">
                <div class="text-center">
                    <h4 class="text-danger">Vui lòng chọn nhà mạng</h4>
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
                        Nhà mạng
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="telco_detail">
                        
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-6 text-left">
                        Mệnh giá thẻ
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="price_detail">
                        
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-6 text-left">
                        Số lượng
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="amount_detail">
                        1
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
                        <button type="button" id="btn_purchase" class="btn btn-hero-primary btn-block" data-toggle="click-ripple" onclick="buyCard(this)" disabled>THANH TOÁN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lịch sử mua thẻ</h3>
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
                                    Sản phẩm
                                </th>
                                <th>
                                    Thanh toán
                                </th>
                                <th>
                                    Tổng tiền
                                </th>
                                <th>
                                    Thời gian tạo
                                </th>
                                <th>
                                    Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `buy-card-order` WHERE `username` = '".$JTech->user('username')."' ORDER BY `id` DESC LIMIT 20 ");
                                while($card = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $card['order_code']; ?>  
                                    </td>
                                    <td>
                                        <b><?= $card['amount']; ?></b> <?= $card['telco']; ?> <?= number_format($card['price']); ?>đ
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Đã thanh toán</span>
                                    </td>
                                    <td>
                                        <?= number_format($card['total_pay']); ?>đ  
                                    </td>
                                    <td>
                                        <?= formatDate($card['created_time']); ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="/view-card/<?= $card['order_code']; ?>">XEM</a>
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
    $(".btn-telco").on("click", function(e){
        var telco = $(this).attr('data-telco')

        $(".btn-telco").removeClass('active-telco')
        $(this).addClass('active-telco')

        $("#telco_detail").text(telco)

        $("#telco").val(telco).trigger('change')

        // RESET
        $("#price").val('')
        $("#price_detail").text('')
        $("#amount_detail").text('1')
        $("#total_pay").text('0đ')

        btnPurchase()
    })

    function selectPrice(data) {
        var price = $(data).attr('data-price')
        var text_price = $(data).text()
        
        $(".btn-price").removeClass('active-price')
        $(data).addClass('active-price')

        $("#price_detail").text(text_price)
        $("#price").val(price).trigger('change')

        btnPurchase()
    }

    function loadPrice(data) {
        var telco = $(data).val()

        $.ajax({
            type: "POST",
            url: "/ajaxs/main/load/PriceCard.php",
            data: {
                telco
            },
            dataType: "text",
            beforeSend: function(){
                Dashmix.layout('header_loader_on');
            },
            complete: function(){
                Dashmix.layout('header_loader_off');
            },
            success: function (res) {
                $("#price_handle").html(res)
            }
        });

        btnPurchase()
    }

    function decreaseAmount() {
        var amount = $("#amount_box").val()
        var price = $("#price").val()

        if(price != "" || price > 0) {
            if(amount <= 1) {
                $("#increase_btn").removeAttr('disabled')
                $("#decrease_btn").attr('disabled', 'disabled')
                return
            }else{
                $("#increase_btn").removeAttr('disabled')
                $('#amount_box').val( function(i, old_amount) {
                    return --old_amount;
                });
            }
            $("#amount_detail").text($("#amount_box").val())

            totalPay()
        }else{
            swal('Vui lòng chọn mệnh giá', 'error')
            return
        }

        btnPurchase()
    }

    function increaseAmount() {
        var amount = $("#amount_box").val()
        var price = $("#price").val()

        if(price != "" || price > 0) {
            if(amount >= amountMax) {
                $("#decrease_btn").removeAttr('disabled')
                $("#increase_btn").attr('disabled', 'disabled')
                return
            }else{
                $("#decrease_btn").removeAttr('disabled')
                $('#amount_box').val( function(i, old_amount) {
                    return ++old_amount;
                });
            }
            $("#amount_detail").text($("#amount_box").val())
            totalPay()
        }else{
            swal('Vui lòng chọn mệnh giá', 'error')
            return
        }

        btnPurchase()
    }

    function totalPay() {
        var amount = $("#amount_box").val()
        var price = $("#price").val()

        console.log(amount + " " + price)

        if(amount <= 0 || price <= 0 || amount == "" || price == "") {
            swal('Vui lòng tải lại trang và thử lại', 'error')
            return
        }else{
            $("#total_pay").text(formatNumber(price * amount) + "đ")
        }

        btnPurchase()
    }

    function btnPurchase(){
        if($("#telco").val() == '' || $("#price").val() == '' || $("#amount_box").val() <= 0 || $("#amount_box").val() == '') {
            $("#btn_purchase").attr('disabled', 'disabled')
        }else{
            $("#btn_purchase").removeAttr('disabled')
        }
    }

    function buyCard(data) {
        Swal.fire({
            title: 'XÁC NHẬN',
            html: "Bạn có chắn chắn mua <b>" + $("#amount_box").val() + "</b> thẻ <b>" + $("#telco").val() + " " + $("#price_detail").text() + "</b> với tổng tiền là " + $("#total_pay").text(),
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
                    url: "/ajaxs/main/client/buy-card.php",
                    data: {
                        telco: $("#telco").val(),
                        price: $("#price").val(),
                        amount: $("#amount_box").val()
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
                            setTimeout(function(){
                                window.location.href = "/view-card/" + res.order_code
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