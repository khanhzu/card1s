<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "CHUYỂN TIỀN - ".$JTech->setting('website_name');
    $wizard_form = true;

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>

<style>
    .success_background {
        background-image: url(/frontend/main/assets/media/jzon/soft.svg); 
        z-index: 1; 
        background-repeat: no-repeat; 
        background-size: auto 33%;
        background-position: left top; 
    }
</style>

<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Chuyển tiền</h2>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="block block-rounded" data-loading="block block-rounded block-mode-loading" id="transfer_panel">
            <div class="block-header block-header-default">
                <h3 class="block-title">Giao dịch chuyển tiền</h3>
            </div>
            <div class="block-content">
                <div class="form-group">
                    <label>Tài khoản nhận:</label>
                    <input class="form-control form-control-alt" id="reciever" placeholder="Nhập email hoặc số điện thoại hoặc username">
                </div>
                <div class="form-group">
                    <label>Số tiền chuyển:</label>
                    <input class="form-control form-control-alt" id="cash" placeholder="đ">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea class="form-control form-control-alt" id="description" placeholder="Nội dung"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-hero-danger btn-block" id="next_section" onclick="nextSection(this)">TIẾP TỤC</button>
                </div>
            </div>
        </div>
        <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)" id="confirm_transfer" data-loading="block block-rounded block-mode-loading" style="display: none;">
            <div class="block-content block-content-full bg-gd-sea">
                <img class="img-avatar img-avatar-thumb" src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/media/avatars/avatar8.jpg" alt="" />
            </div>
            <div class="block-content block-content-full block-content-sm bg-gd-sea-op">
                <p class="font-w600 text-white mb-0" id="full_name_confirm">undefined</p>
                <p class="font-size-sm font-italic text-white-75 mb-0" id="info_bank">
                    undefined
                </p>
            </div>
            <div class="block-content block-content-full">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-6 text-left">
                        Tài khoản nhận
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="reciever_confirm">
                        undefined
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-6 text-left">
                        Số tiền chuyển
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="cash_confirm">
                        undefined
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        Nội dung
                    </div>
                    <div class="col-6 text-right text-danger" style="font-weight: bold;" id="description_confirm">
                        
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-6 text-left">
                        Phí chuyển tiền
                    </div>
                    <div class="col-6 text-right text-primary" style="font-weight: bold;">
                        <?php if($JTech->setting('fee_cash_transfer') == 0) { ?>
                            MIỄN PHÍ
                        <?php }else{ ?>
                            <?= number_format($JTech->setting('fee_cash_transfer')); ?>đ
                        <?php } ?>
                    </div>
                </div>
                <button class="btn btn-hero-success btn-block" onclick="transfer(this)">CHUYỂN TIỀN</button>
                <button class="btn btn-hero-secondary btn-block" onclick="cancelTransfer()">HỦY GIAO DỊCH</button>
            </div>
        </a>

        <div class="block block-rounded" id="success_panel" style="display: none;">
            <div class="block-content success_background">
                <div class="text-center">
                    <i class="fas fa-check-circle" style="font-size: 60px; color: #28a745;"></i>
                    <div style="margin-top: 15px; margin-bottom: 30px;">
                        <h5 style="font-weight: bold; color: #28a745;">Giao dịch thành công</h5>
                        <h3 style="font-weight: bold; margin-top: -10px;" id="cash_success">undefined</h3>

                        <div class="alert alert-info d-flex align-items-center" role="alert" style="margin-top: -10px; margin-right: 35px; margin-left: 35px;">
                            <div class="flex-00-auto">
                                <i class="fa fa-fw fa-info-circle"></i>
                            </div>
                            <div class="flex-fill ml-3">
                                <p class="mb-0"><span id="full_name_success">undefined</span> đã nhận được tiền từ bạn</p>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-right: 35px; margin-left: 35px;">
                        <div class="col-6 text-left">Thời gian thanh toán</div>
                        <div class="col-6 text-right text-danger" style="font-weight: bold;" id="time_success">undefined</div>
                    </div>
                    <hr style="margin-right: 35px; margin-left: 35px;">
                    <div class="row" style="margin-right: 35px; margin-left: 35px; margin-bottom: 40px;">
                        <div class="col-6 text-left">Mã giao dịch</div>
                        <div class="col-6 text-right text-danger" style="font-weight: bold;" id="transaction_code_success">undefined</div>
                    </div>
                    <div style="margin-bottom: 30px; margin-right: 35px; margin-left: 35px;">
                        <a class="btn btn-hero-primary btn-block" href="">TRỞ VỀ TRANG CHỦ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="block block-rounded bg-gd-sea">
            <div class="block-content">
                <p class="text-white text-uppercase font-size-sm font-w700 text-center mt-2 mb-4">
                    PHÍ CHUYỂN TIỀN
                </p>
                <a class="block block-rounded bg-black-10 mb-2" href="javascript:void(0)">
                    <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                        <div class="mr-3">
                            <p class="text-white font-size-h3 font-w300 mb-0">
                                <?php if($JTech->setting('fee_cash_transfer') == 0) { ?>
                                    MIỄN PHÍ
                                <?php }else{ ?>
                                    <?= number_format($JTech->setting('fee_cash_transfer')); ?>đ
                                <?php } ?>
                            </p>
                            <p class="text-white-75 mb-0">
                                Phí cố định
                            </p>
                        </div>
                        <div class="item">
                            <i class="fas fa-2x fa-coins text-black-50"></i>
                        </div>
                    </div>
                </a>
                <a class="block block-rounded bg-black-10 mb-2" href="javascript:void(0)">
                    <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                        <div class="mr-3">
                            <p class="text-white font-size-h3 font-w300 mb-0">
                                <?= number_format($JTech->setting('min_cash_transfer')); ?>đ
                            </p>
                            <p class="text-white-75 mb-0">
                                Số tiền chuyển tối thiểu
                            </p>
                        </div>
                        <div class="item">
                            <i class="fas fa-2x fa-money-bill text-black-50"></i>
                        </div>
                    </div>
                </a>
                <a class="block block-rounded bg-black-10" href="javascript:void(0)">
                    <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                        <div class="mr-3">
                            <p class="text-white font-size-h3 font-w300 mb-0">
                                <?= number_format($JTech->setting('max_cash_transfer')); ?>đ
                            </p>
                            <p class="text-white-75 mb-0">
                                Số tiền chuyển tối đa
                            </p>
                        </div>
                        <div class="item">
                            <i class="fas fa-2x fa-money-check-alt text-black-50"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lịch sử giao dịch</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>
                                    Mã GD
                                </th>
                                <th>
                                    Số tiền
                                </th>
                                <th>
                                    Tài khoản gửi/nhận
                                </th>
                                <th>
                                    Thời gian tạo
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                <th>
                                    Nội dung
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `transfer-receipt` WHERE `sender` = '".$JTech->user('username')."' OR `reciever` = '".$JTech->user('username')."' ORDER BY `id` DESC LIMIT 20");
                                while($transfer = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $transfer['transaction_code']; ?>  
                                    </td>
                                    <td>
                                        <?php if($transfer['sender'] == $JTech->user('username')) { ?>
                                        <b class="text-danger">-<?= number_format($transfer['cash_transfer']); ?>đ</b>
                                        <?php } else { ?>
                                        <b class="text-success">+<?= number_format($transfer['cash_transfer']); ?>đ</b>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($transfer['sender'] == $JTech->user('username')) {
                                                echo $JTech->getUser($transfer['reciever'], 'full_name')."<br><span class='text-muted'>".$transfer['reciever']."</span>";
                                            }else{
                                                echo $JTech->getUser($transfer['sender'], 'full_name')."<br><span class='text-muted'>".$transfer['sender']."</span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?= formatDate($transfer['created_time']); ?>  
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Thành công</span>
                                    </td>
                                    <td>
                                        <?= $transfer['description']; ?>
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

    function cancelTransfer() {
        Swal.fire({
            title: 'XÁC NHẬN',
            html: "Bạn có muốn hủy giao dịch bây giờ ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hủy ngay',
            cancelButtonText: 'Đóng'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='/transfer'
            }
        })
    }

    function transfer(data) {
        var reciever = $("#reciever").val()
        var cash = $("#cash").val()
        var description = $("#description").val()

        var class_old;
        var panel_loading = $("#confirm_transfer").attr('data-loading')

        $.ajax({
            type: "POST",
            url: "/ajaxs/main/client/transfer.php",
            data: {
                reciever,
                cash,
                description
            },
            dataType: "json",
            beforeSend: function(){
                Dashmix.layout('header_loader_on');
                $(data).html("VUI LÒNG CHỜ...").attr('disabled', 'disabled')
                class_old = $("#confirm_transfer").attr('class')
                $("#confirm_transfer").removeAttr('class').attr('class', panel_loading)
            },
            complete: function(){
                Dashmix.layout('header_loader_off');
                $(data).html('CHUYỂN TIỀN').removeAttr('disabled')
                $("#confirm_transfer").removeAttr('class').attr('class', class_old)
            },
            success: function (res) {
                if(res.status) {
                    $("#cash_success").text(res.cash)
                    $("#full_name_success").text(res.full_name)
                    $("#time_success").text(res.time)
                    $("#transaction_code_success").text(res.transaction_code)

                    $("#confirm_transfer").hide()
                    $("#success_panel").show()
                    // swal(res.message, "error")
                }else{
                    swal(res.message, "error")
                }
            }
        });
    }

    function nextSection(data) {
        var reciever = $("#reciever").val()
        var cash = $("#cash").val()
        var description = $("#description").val()

        var class_old;
        var panel_loading = $("#conf").attr('data-loading')

        $.ajax({
            type: "POST",
            url: "/ajaxs/main/client/check-transfer.php",
            data: {
                reciever,
                cash,
                description
            },
            dataType: "json",
            beforeSend: function(){
                Dashmix.layout('header_loader_on');
                $(data).html("VUI LÒNG CHỜ...").attr('disabled', 'disabled')
                class_old = $("#transfer_panel").attr('class')
                $("#transfer_panel").removeAttr('class').attr('class', panel_loading)
            },
            complete: function(){
                Dashmix.layout('header_loader_off');
                $(data).html('TIẾP TỤC').removeAttr('disabled')
                $("#transfer_panel").removeAttr('class').attr('class', class_old)
            },
            success: function (res) {
                if(res.status) {
                    $("#full_name_confirm").text(res.full_name)
                    $("#info_bank").text(reciever)
                    $("#reciever_confirm").text(reciever)
                    $("#cash_confirm").text(formatNumber(cash) + "đ")
                    $("#description_confirm").text(description)
                    $("#transfer_panel").hide()
                    $("#confirm_transfer").show()
                }else{
                    swal(res.message, "error")
                }
            }
        });
    }
</script>

<?php
    require('../../layout/main/foot.php');
?>