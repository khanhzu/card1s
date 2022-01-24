<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Danh sách rút tiền - ".$JTech->setting('website_name');
    $required_datatable = true;
    $select2 = true;

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');

?>

<div class="row">
        
    <?php 
        if(!isset($_GET['detail'])) {
                    
            if(isset($_GET['success']) && $JTech->checkToken('admin_request')) {
                $id = intval($_GET['success']);
                
                $info = $JTech->db_row("SELECT * FROM `withdraw` WHERE `id` = '$id' AND `status` != 'success' ");

                if($info) {
                    $JTech->db_query("UPDATE `withdraw` SET `status` = 'success' WHERE `id` = '$id' ");
                    $status = "success";
                    $msg = "Duyệt đơn rút tiền thành công (#".$info['withdraw_code'].")";
                }else{
                    $status = "danger";
                    $msg = "Đơn rút tiền này đã được duyệt hoặc không tồn tại";
                }
            }

            if(isset($_GET['cancel']) && $JTech->checkToken('admin_request')) {
                $id = intval($_GET['cancel']);
                
                $info = $JTech->db_row("SELECT * FROM `withdraw` WHERE `id` = '$id' AND `status` != 'cancel' ");

                if($info) {
                    $JTech->db_query("UPDATE `withdraw` SET `status` = 'cancel' WHERE `id` = '$id' ");
                    $status = "success";
                    $msg = "Đã hủy đơn rút tiền thành công (#".$info['withdraw_code'].")";
                }else{
                    $status = "danger";
                    $msg = "Đơn rút tiền này đã được hủy hoặc không tồn tại";
                }
            }
    ?>

    <div class="col-lg-12">
        <?php if(isset($status)) { ?>
            <div class="alert alert-<?= $status; ?>">
                <?= $msg; ?>
            </div>
        <?php } ?>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Đơn rút tiền chưa được duyệt</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>
                                    Mã GD
                                </th>
                                <th>
                                    Người dùng
                                </th>
                                <th>
                                    Ngân hàng
                                </th>
                                <th>
                                    Chủ tài khoản
                                </th>
                                <th>
                                    Số tài khoản
                                </th>
                                <th>
                                    Chi nhánh
                                </th>
                                <th>
                                    Số tiền rút
                                </th>
                                <th>
                                    Nội dung
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                <th>
                                    Thời gian tạo
                                </th>
                                <th>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `withdraw` WHERE `status` = 'wait' ORDER BY `id` DESC");
                                while($with = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $with['withdraw_code']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['username']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['bank_name']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['owner']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['number_account']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['branch']; ?>  
                                    </td>
                                    <td class="text-danger" style="font-weight: bold;">
                                        <?= number_format($with['cash_withdraw']); ?>đ  
                                    </td>
                                    <td>
                                        <?= $with['description']; ?>  
                                    </td>
                                    <td>
                                        <?= status_withdraw($with['status']); ?>
                                    </td>
                                    <td>
                                        <?= formatDate($with['created_time']); ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="?success=<?= $with['id']; ?>">DUYỆT</a>
                                        <a class="btn btn-danger btn-sm" href="?cancel=<?= $with['id']; ?>">HỦY</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Tất cả đơn rút tiền</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>
                                    Mã GD
                                </th>
                                <th>
                                    Người dùng
                                </th>
                                <th>
                                    Ngân hàng
                                </th>
                                <th>
                                    Chủ tài khoản
                                </th>
                                <th>
                                    Số tài khoản
                                </th>
                                <th>
                                    Chi nhánh
                                </th>
                                <th>
                                    Số tiền rút
                                </th>
                                <th>
                                    Nội dung
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                <th>
                                    Thời gian tạo
                                </th>
                                <th>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `withdraw` ORDER BY `id` DESC");
                                while($with = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $with['withdraw_code']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['username']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['bank_name']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['owner']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['number_account']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['branch']; ?>  
                                    </td>
                                    <td class="text-danger" style="font-weight: bold;">
                                        <?= number_format($with['cash_withdraw']); ?>đ  
                                    </td>
                                    <td>
                                        <?= $with['description']; ?>  
                                    </td>
                                    <td>
                                        <?= status_withdraw($with['status']); ?>
                                    </td>
                                    <td>
                                        <?= formatDate($with['created_time']); ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="?detail=<?= $with['id']; ?>"><i class="fas fa-eye"></i> CHI TIẾT</a>
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
        }else{
            require('../detail/withdraw.php');
        }
    ?>
</div>

<script>
    <?php if(isset($_GET['success']) || isset($_GET['cancel'])) { ?>
        $(function(){
            const state = {}
            const newTitle = ''
            const newURL = '/admin/list/withdraw'

            history.pushState(state, newTitle, newURL)
        })
    <?php } ?>
</script>

<?php
    require('../../../layout/admin/foot.php');
?>