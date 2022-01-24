<?php
    require('../../../core/database.php');
    require('../../../core/function.php');

    $title = "LỊCH SỬ ĐỔI THẺ - ".$JTech->setting('website_name');
    $required_datatable = true;

    require('../../../layout/main/head.php');
    require('../../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>

<style>
    .j_cash {
        font-size: calc(1rem + 1.2vw)!important; 
        font-weight: 700!important;
    }
</style>

<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Thống kê đổi thẻ hôm nay</h2>
</div>
<?php
    $total_cash_ex = mysqli_fetch_assoc($JTech->db_query("SELECT SUM(`amount_recieve`) FROM `card-data` WHERE `status` = 'success' AND `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`amount_recieve`)'];
    $total_card_success = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `status` = 'success' AND `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' ");
    $total_card_fail = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `status` = 'fail' AND `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' ");
?>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-3" style="margin-bottom: 15px;">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
            <div class="block-content block-content-full flex-grow-1">
                <div class="j_cash text-info"><?= number_format($total_cash_ex); ?>đ</div>
                <div class="text-muted mb-3">Tổng thực nhận</div>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-bottom: 15px;">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
            <div class="block-content block-content-full flex-grow-1">
                <div class="j_cash text-success"><?= number_format($total_card_success); ?></div>
                <div class="text-muted mb-3">Tổng thẻ đúng</div>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-bottom: 15px;">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
            <div class="block-content block-content-full flex-grow-1">
                <div class="j_cash text-danger"><?= number_format($total_card_fail); ?></div>
                <div class="text-muted mb-3">Tổng thẻ sai</div>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-bottom: 15px;">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
            <div class="block-content block-content-full flex-grow-1">
                <div class="j_cash text-secondary"><?= number_format($total_card_fail); ?></div>
                <div class="text-muted mb-3">Tổng thẻ đổi</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
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
</div>


<?php
    require('../../../layout/main/foot.php');
?>