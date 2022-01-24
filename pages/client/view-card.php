<?php
    require('../../core/database.php');
    require('../../core/function.php');

    if(isset($_GET['order_code'])) {
        $order_code = xss($_GET['order_code']);

        $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `buy-card-order` WHERE `order_code` = '$order_code' AND `username` = '".$JTech->user('username')."' "));

        if($info) {
                
            $title = "ĐƠN HÀNG ".$info['order_code'];

            require('../../layout/main/head.php');
            require('../../layout/main/navbar.php');

            $JTech->checkToken('client');
?>

<!-- Overview -->
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">ĐƠN HÀNG: <?= $info['order_code']; ?></h2>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">THÔNG TIN DỊCH VỤ</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>
                                    Tên sản phẩm
                                </th>
                                <th>
                                    Mã thẻ
                                </th>
                                <th>
                                    Serial
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `buy-card-data` WHERE `order_code` = '".$info['order_code']."' ORDER BY `id` DESC ");
                                while($card = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $info['telco']; ?> <?= number_format($info['price']); ?>đ  
                                    </td>
                                    <td>
                                        <?= $card['pin']; ?> <button class="btn btn-rounded btn-sm btn-light" data-toggle="click-ripple" onclick="copyText('<?= $card['pin']; ?>')"><i class="fas fa-copy"></i></button>
                                    </td>
                                    <td>
                                        <?= $card['serial']; ?> <button class="btn btn-rounded btn-sm btn-light" data-toggle="click-ripple" onclick="copyText('<?= $card['serial']; ?>')"><i class="fas fa-copy"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">THÔNG TIN ĐƠN HÀNG</h3>
            </div>
            <div class="block-content">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Tổng số tiền:</td>
                            <td>
                                <b>
                                    <?= number_format($info['total_pay']); ?>đ
                                </b>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>Thanh toán:</td>
                            <td>
                                <span class="badge badge-success">Đã thanh toán</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Thời gian tạo:</td>
                            <td><?= formatDate($info['created_time']); ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<?php
        } else {
            header('Location: /buy-card');
        }
    } else {
        header('Location: /buy-card');
    }
    require('../../layout/main/foot.php');
?>