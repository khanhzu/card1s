<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Danh sách mua thẻ cào - ".$JTech->setting('website_name');
    $required_datatable = true;

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <?php if(!isset($_GET['detail'])) { ?>
        <div class="col-lg-12">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    <th>
                                        Mã đơn
                                    </th>
                                    <th>
                                        Người mua
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
                                    $query = $JTech->db_query("SELECT * FROM `buy-card-order` ORDER BY `id` DESC ");
                                    while($card = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td>
                                            <?= $card['order_code']; ?>  
                                        </td>
                                        <td>
                                            <?= $card['username']; ?>  
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
                                            <a class="btn btn-info btn-sm" href="?detail=<?= $card['order_code']; ?>">XEM</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        } else { 
            require('../detail/buy-card.php');
        }
    ?>
</div>
<?php
    require('../../../layout/admin/foot.php');
?>