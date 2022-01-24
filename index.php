<?php
    require('core/database.php');
    require('core/function.php');

    $title = "TRANG CHỦ - ".$JTech->setting('website_name');
    $required_datatable = true;

    require('layout/main/head.php');
    require('layout/main/navbar.php');

    if($JTech->checkToken('request', true)) {
        if($JTech->user('2fa_code', true) != '' && !$JTech->user('is_verify', true)) {
            exit('<script>document.location = "/account/security/verify";</script>');
        }
    }
?>

<style>
    .btn-action {
        height: calc(1.5em + .75rem + 2px); 
        padding: .375rem .75rem;
    }
    .form_card {
        margin-bottom: 15px;
    }

    div.box-price>div.price-content {
        padding: 20px;
        margin-bottom: 13px;
        text-align: center;
        border-radius: 10px;
        border: 1.5px solid #27aae8;
        background-color: #f9f9f9;
    }

    div.box-price>div.price-content>.price-text {
        font-size: 20px;
        font-weight: 700;
    }
    div.box-price>div.price-content>.price-over-text {
        color: #000;
    }
</style>

<script>
    <?php if($JTech->user('rank') == 'vip') { ?>
        let telco_rate = {
            <?php
                $telco_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                while($telco = mysqli_fetch_assoc($telco_query)) {
            ?>
            "<?= $telco['telco']; ?>": {
                "10000": "<?= $telco['vip_10000']; ?>",
                "20000": "<?= $telco['vip_20000']; ?>",
                "30000": "<?= $telco['vip_30000']; ?>",
                "50000": "<?= $telco['vip_50000']; ?>",
                "100000": "<?= $telco['vip_100000']; ?>",
                "200000": "<?= $telco['vip_200000']; ?>",
                "300000": "<?= $telco['vip_300000']; ?>",
                "500000": "<?= $telco['vip_500000']; ?>",
                "1000000": "<?= $telco['vip_1000000']; ?>"
            },
            <?php } ?>
        }
    <?php } else if($JTech->user('rank') == 'agency') { ?>
        let telco_rate = {
            <?php
                $telco_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                while($telco = mysqli_fetch_assoc($telco_query)) {
            ?>
            "<?= $telco['telco']; ?>": {
                "10000": "<?= $telco['agency_10000']; ?>",
                "20000": "<?= $telco['agency_20000']; ?>",
                "30000": "<?= $telco['agency_30000']; ?>",
                "50000": "<?= $telco['agency_50000']; ?>",
                "100000": "<?= $telco['agency_100000']; ?>",
                "200000": "<?= $telco['agency_200000']; ?>",
                "300000": "<?= $telco['agency_300000']; ?>",
                "500000": "<?= $telco['agency_500000']; ?>",
                "1000000": "<?= $telco['agency_1000000']; ?>"
            },
            <?php } ?>
        }
    <?php } else { ?>
        let telco_rate = {
            <?php
                $telco_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                while($telco = mysqli_fetch_assoc($telco_query)) {
            ?>
            "<?= $telco['telco']; ?>": {
                "10000": "<?= $telco['member_10000']; ?>",
                "20000": "<?= $telco['member_20000']; ?>",
                "30000": "<?= $telco['member_30000']; ?>",
                "50000": "<?= $telco['member_50000']; ?>",
                "100000": "<?= $telco['member_100000']; ?>",
                "200000": "<?= $telco['member_200000']; ?>",
                "300000": "<?= $telco['member_300000']; ?>",
                "500000": "<?= $telco['member_500000']; ?>",
                "1000000": "<?= $telco['member_1000000']; ?>"
            },
            <?php } ?>
        }
    <?php } ?>
</script>

<div class="modal fade" id="noficationHomeModal" tabindex="-1" role="dialog" aria-labelledby="noficationHomeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">THÔNG BÁO</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content" style="margin-bottom: 20px;">
                    <?= $JTech->setting('nofication_home'); ?>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="hideNofication()">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Overview -->
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Đổi thẻ cào thành tiền mặt</h2>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="nofication_ex_card">
                    <?= $JTech->setting('nofication_ex_card'); ?>
                </div>
                <div calss="panel_ex_card" style="margin-bottom: 30px;">
                    <div id="result_here"></div>
                    <div class="list_row">
                        <div class="row form_card" data-row="1">
                            <div class="col-sm-3">
                                <select class="form-control telco" data-row="1" onchange="telco_select(this)">
                                    <?php
                                        $telco_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                                        while($telco = mysqli_fetch_assoc($telco_query)) {
                                    ?>
                                    <option value="<?= $telco['telco']; ?>"><?= $telco['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input class="form-control pin" placeholder="Mã thẻ" data-row="1">
                            </div>
                            <div class="col-sm-3">
                                <input class="form-control serial" placeholder="Số serial" data-row="1">
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control amount" data-row="1" onchange="total_receive(this)">
                                    <option value="">-- Mệnh giá --</option>
                                    <?php
                                        foreach (amount_data() as $key => $value) {
                                    ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <a class="btn btn-success btn-sm btn-action" onclick="addRow(this)"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="box-price font-vie">
                        <div class="price-content">
                            <span class="price-full dp"></span>
                            <span class="price-text">
                                <span class="text-danger">Tổng thực nhận: </span>
                                <span class="price-count text-primary">
                                    <span id="total_recieve">0</span>đ
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-hero-success" onclick="submitCard(this)"><i class="fas fa-asterisk"></i> Đổi thẻ cào</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($JTech->checkToken('request')) { ?>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lịch sử đổi thẻ</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TRẠNG THÁI</th>
                                <th>NHÀ MẠNG</th>
                                <th>MÃ THẺ</th>
                                <th>SERIAL</th>
                                <th>KHAI</th>
                                <th>THỰC</th>
                                <th>NHẬN</th>
                                <th>THỜI GIAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                $card_query = $JTech->db_query("SELECT * FROM `card-data` WHERE `username` = '".$JTech->user('username')."' ORDER BY `id` DESC ");
                                while($card = mysqli_fetch_assoc($card_query)) {
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <?= status_card($card['status']); ?>
                                </td>
                                <td>
                                    <?= getTelco($card['telco'], 'name'); ?>
                                </td>
                                <td>
                                    <?= $card['pin']; ?>
                                </td>
                                <td>
                                    <?= $card['serial']; ?>
                                </td>
                                <td>
                                    <?= number_format($card['amount']); ?>đ
                                </td>
                                <td>
                                    <?= number_format($card['amount_real']); ?>đ
                                </td>
                                <td>
                                    <?= number_format($card['amount_recieve']); ?>đ
                                </td>
                                <td>
                                    <?= formatDate($card['created_time']); ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Bảng phí đổi thẻ cào</h3>
            </div>
            <div class="block-content">
                <div class="block block-rounded">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        <?php 
                            $i = 0;
                            $title_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                            while($title = mysqli_fetch_assoc($title_query)) { 
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($i == 0) echo 'active'; ?>" href="#rate_<?= $i++; ?>"><?= strtoupper($title['name']); ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <?php 
                            $x = 0;
                            $rate_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                            while($rate = mysqli_fetch_assoc($rate_query)) { 
                        ?>
                        <div class="tab-pane fade show <?php if($x == 0) echo 'active'; ?>" id="rate_<?= $x++; ?>" role="tabpanel" aria-labelledby="rate_<?= $i++; ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                Cấp bậc
                                            </th>
                                            <th>
                                                Thẻ 10,000đ
                                            </th>
                                            <th>
                                                Thẻ 20,000đ
                                            </th>
                                            <th>
                                                Thẻ 30,000đ
                                            </th>
                                            <th>
                                                Thẻ 50,000đ
                                            </th>
                                            <th>
                                                Thẻ 100,000đ
                                            </th>
                                            <th>
                                                Thẻ 200,000đ
                                            </th>
                                            <th>
                                                Thẻ 300,000đ
                                            </th>
                                            <th>
                                                Thẻ 500,000đ
                                            </th>
                                            <th>
                                                Thẻ 1,000,000đ
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td style="font-weight: bold;">
                                                <span class="badge badge-danger" style="font-size: 15px;">ĐẠI LÝ</span>
                                            </td>
                                            <td>
                                                <?= $rate['agency_10000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['agency_20000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['agency_30000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['agency_50000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['agency_100000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['agency_200000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['agency_300000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['agency_500000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['agency_1000000']; ?>%
                                            
                                            </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td style="font-weight: bold;">
                                                <span class="badge badge-info" style="font-size: 15px;">THÀNH VIÊN</span>
                                            </td>
                                            <td>
                                                <?= $rate['member_10000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['member_20000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['member_30000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['member_50000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['member_100000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['member_200000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['member_300000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['member_500000']; ?>%
                                            </td>
                                            <td>
                                                <?= $rate['member_1000000']; ?>%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- END Overview -->
<script>
    $(function() {
        if (!getCookie('hide_nofication')) {
            $('#noficationHomeModal').modal('show');
        }
    })

    function hideNofication() {
        setCookie('hide_nofication', true, 1);
    }

    function removeChild__(code) {
        $(".form_card[data-row=" + code + "]").remove()
    }

    function addRow(data) {
        if($('.list_row .form_card').length > 9) {
            swal('Thêm tối đa 10 dòng', 'error')
            return
        }
        $.ajax({
            url: '/ajaxs/main/load/rowCard.php',
            beforeSend: function () {
                $(data).html('<div class="spinner-border spinner-border-sm text-light" role="status"> <span class="visually-hidden"></span></div>');
                $(data).attr('onclick', 'return false;')
            },
            success: function (res) {
                $(data).html('<i class="fas fa-plus"></i>');
                $(data).removeAttr('onclick').attr('onclick', 'addRow(this)')
                $('.list_row').append(res);
            }
        });
    }

    function submitCard(data) {
        var lstDataSubmit = [];
        var i = 1;
        $('.list_row .form_card').each(function() {
            var dataRow = $(this).attr('data-row');
            var dataOne = {
                telco: $(".telco[data-row=" + dataRow + "]").val(),
                pin: $(".pin[data-row=" + dataRow + "]").val(),
                serial: $(".serial[data-row=" + dataRow + "]").val(),
                amount: $(".amount[data-row=" + dataRow + "]").val(),
            };
            lstDataSubmit.push(dataOne);
        });
        if (lstDataSubmit.length > 0) {
            $.ajax({
                url: '/ajaxs/main/client/exchangeCard.php',
                type: 'POST',
                dataType: 'text',
                data: {
                    'data': lstDataSubmit
                },
                beforeSend: function() {
                    Dashmix.layout('header_loader_on');
                    $(data).attr('disabled', 'disabled').html('<i class="fas fa-asterisk fa-spin"></i> Vui lòng chờ')
                },
                complete: function(){
                    Dashmix.layout('header_loader_off');
                    $(data).removeAttr('disabled').html('<i class="fas fa-asterisk"></i> Đổi thẻ cào')
                },
                success: function(res) {
                    $("#result_here").html(res)
                    $('html, body').animate({ scrollTop: $("#result_here").position().top}, 100);
                }
            });
        }
    }

    let amount_sl_arr = {}

    function telco_select(data) {
        var row_code = $(data).attr('data-row')
        $(".amount[data-row=" + row_code + "]").trigger('change')
    }

    function total_receive(data) {
        var text = $("#total_recieve").text()
        var replace = text.replaceAll(',', '')
        var amount = $(data).val()
        var row_code = $(data).attr('data-row')
        var telco = $(".telco[data-row=" + row_code + "]").val()

        if(!amount || !telco){
            return
        }

        var rate = telco_rate[telco][amount]
        var amount_rate = amount * ((100 - rate) / 100)

        if(amount_sl_arr.hasOwnProperty(row_code)) {
            var total_recieve = formatNumber(( Number(replace) - Number(amount_sl_arr[row_code]) ) + Number(amount_rate))
            amount_sl_arr[row_code] = amount_rate
        }else{
            var total_recieve = formatNumber(Number(replace) + Number(amount_rate))
            amount_sl_arr[row_code] = amount_rate
        }

        $("#total_recieve").text(total_recieve)
    }
</script>
<?php
    require('layout/main/foot.php');
?>