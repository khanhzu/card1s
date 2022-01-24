<?php
    require('../../../core/database.php');
    require('../../../core/function.php');

    $title = "LỊCH SỬ MUA THẺ - ".$JTech->setting('website_name');

    require('../../../layout/main/head.php');
    require('../../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Lịch sử mua thẻ</h2>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
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
<?php
    require('../../../layout/main/foot.php');
?>