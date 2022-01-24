<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Danh sách đối tác API - ".$JTech->setting('website_name');
    $required_datatable = true;
    $select2 = true;

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');

    if( isset($_GET['delete']) && $JTech->checkToken('admin_request') ) {
        $id = intval($_GET['delete']);

        $check = $JTech->db_row("SELECT * FROM `api-partner` WHERE `id` = '$id' ");

        if($check){
            $JTech->db_query("DELETE FROM `api-partner` WHERE `id` = '$id' ");

            $status = "success";
            $msg = "Xóa đối tác API thành công";
        }else{
            $status = "danger";
            $msg = "Thao tác thất bại";
        }
    }

    if( isset($_GET['active']) && $JTech->checkToken('admin_request') ) {
        $id = intval($_GET['active']);

        $check = $JTech->db_row("SELECT * FROM `api-partner` WHERE `id` = '$id' AND `status` = 'non-active' ");

        if($check){
            $JTech->db_query("UPDATE `api-partner` SET `status` = 'active' WHERE `id` = '$id' ");
            $status = "success";
            $msg = "Bật đối tác API thành công";
        }else{
            $status = "danger";
            $msg = "Thao tác thất bại";
        }
    }

    if( isset($_GET['non-active']) && $JTech->checkToken('admin_request') ) {
        $id = intval($_GET['non-active']);

        $check = $JTech->db_row("SELECT * FROM `api-partner` WHERE `id` = '$id' AND `status` = 'active' ");

        if($check){
            $JTech->db_query("UPDATE `api-partner` SET `status` = 'non-active' WHERE `id` = '$id' ");
            $status = "success";
            $msg = "Tắt đối tác API thành công";
        }else{
            $status = "danger";
            $msg = "Thao tác thất bại";
        }
    }

?>

<div class="row">
        
    <?php 
        if(!isset($_GET['detail'])) {
    ?>

    <?php if(isset($status)) { ?>
        <div class="col-lg-12">
            <div class="form-group">
                <div class="alert alert-<?= $status; ?>">
                    <?= $msg; ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Tất cả đối tác API</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>
                                    Tên
                                </th>
                                <th>
                                    Thông tin kết nối
                                </th>
                                <th>
                                    Phương thức
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                <th>
                                    Lần cuối thực thi
                                </th>
                                <th>
                                    Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `api-partner` ORDER BY `id` DESC");
                                while($api = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $api['name']; ?>  
                                    </td>
                                    <td>
                                        Partner ID: <?= $api['partner_id']; ?> <br>
                                        Partner Key: <?= $api['partner_key']; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">GET</span> <br>
                                        <small><?= $api['callback_url']; ?></small>
                                    </td>
                                    <td>
                                        <?= status_api($api['status']); ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($api['last_used'] != "") {
                                                echo '<span class="badge badge-info">'.formatDate($api['last_used']).'</span>';
                                            }else{
                                                echo '<span class="badge badge-info">Chưa có dữ liệu</span>';
                                            }
                                        ?>  
                                    </td>
                                    <td>
                                        <?php if($api['status'] == 'non-active') { ?>
                                        <a class="btn btn-success btn-sm" href="?active=<?= $api['id']; ?>">Bật</a>
                                        <?php } else { ?>
                                        <a class="btn btn-secondary btn-sm" href="?non-active=<?= $api['id']; ?>">Tắt</a>
                                        <?php } ?>
                                        <a class="btn btn-danger btn-sm" href="?delete=<?= $api['id']; ?>">Xóa</a>
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
            require('../detail/api-partner.php');
        }
    ?>
</div>

<script>
    <?php if(isset($_GET['active']) || isset($_GET['non-active']) || isset($_GET['delete'])) { ?>
        $(function(){
            const state = {}
            const newTitle = ''
            const newURL = '/admin/list/partner'

            history.pushState(state, newTitle, newURL)
        })
    <?php } ?>
</script>

<?php
    require('../../../layout/admin/foot.php');
?>