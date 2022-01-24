<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Danh sách giao dịch chuyển tiền - ".$JTech->setting('website_name');
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
                                    Mã GD
                                </th>
                                <th>
                                    Người chuyển
                                </th>
                                <th>
                                    Người nhận
                                </th>
                                <th>
                                    Số tiền chuyển
                                </th>
                                <th>
                                    Nội dung
                                </th>
                                <th>
                                    Ngày chuyển
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `transfer-receipt` ORDER BY `id` DESC");
                                while($transfer = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $transfer['transaction_code']; ?>  
                                    </td>
                                    <td>
                                        <b class="text-danger"><?= $transfer['sender']; ?></b>  
                                    </td>
                                    <td>
                                        <b class="text-success"><?= $transfer['reciever']; ?></b>  
                                    </td>
                                    <td>
                                        <?= number_format($transfer['cash_transfer']); ?>đ  
                                    </td>
                                    <td>
                                        <?= $transfer['description']; ?>  
                                    </td>
                                    <td>
                                        <?= formatDate($transfer['created_time']); ?>
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