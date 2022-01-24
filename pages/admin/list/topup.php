<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Danh sách nạp điện thoại - ".$JTech->setting('website_name');
    $required_datatable = true;

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
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
                                $query = $JTech->db_query("SELECT * FROM `topup-mobile` ORDER BY `id` DESC");
                                while($topup = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $topup['order_code']; ?>  
                                    </td>
                                    <td>
                                        <?= $topup['username']; ?>  
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
<?php
    require('../../../layout/admin/foot.php');
?>