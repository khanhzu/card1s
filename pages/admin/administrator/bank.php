<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Ngân hàng của bạn - ".$JTech->setting('website_name');
    $required_datatable = true;

    if( isset($_GET['delete']) && $JTech->checkToken('admin_request') ) {
        $id = intval($_GET['delete']);

        $check = $JTech->db_row("SELECT * FROM `bank-users` WHERE `id` = '$id' AND `username` = 'web' ");

        if($check){
            $JTech->db_query("DELETE FROM `bank-users` WHERE `id` = '$id' AND `username` = 'web' ");

            $status = "success";
            $msg = "Xóa ngân hàng thành công";
        }else{
            $status = "danger";
            $msg = "Thao tác thất bại";
        }
    }

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
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
                <h3 class="block-title">Cấu hình chế độ</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/bank'); ?>" method="POST">
                    <div class="form-group">
                        <label>Chế độ xác thực</label>
                        <select class="form-control" name="memo_mode">
                            <option value="uid" <?php if($JTech->setting('memo_mode') == 'uid') echo 'selected'; ?>>Lấy theo UID người dùng (NAPTIEN 1)</option>
                            <option value="user" <?php if($JTech->setting('memo_mode') == 'user') echo 'selected'; ?>>Lấy theo USERNAME người dùng (NAPTIEN jzondev)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cú pháp chuyển khoản</label>
                        <input class="form-control" name="memo_name" value="<?= $JTech->setting('memo_name'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Phí nạp tiền</label>
                        <input class="form-control" name="recharge_fee" value="<?= $JTech->setting('recharge_fee'); ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/bank'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Cấu hình ví MOMO</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/bank'); ?>" method="POST">
                    <div class="form-group">
                        <label>Token MOMO (<a href="https://api.web2m.com/Register.html?ref=116" target="_blank">API.WEB2M.COM</a>)</label>
                        <input class="form-control" name="momo_token" value="<?= $JTech->setting('momo_token'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Chủ tài khoản</label>
                        <input class="form-control" name="momo_owner" value="<?= $JTech->setting('momo_owner'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" name="momo_phone" value="<?= $JTech->setting('momo_phone'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Lưu ý khi nạp</label>
                        <input class="form-control" name="momo_noti" value="<?= $JTech->setting('momo_noti'); ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/bank'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Cấu hình ví ZALO PAY</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/bank'); ?>" method="POST">
                    <div class="form-group">
                        <label>Token ZALO PAY (<a href="https://api.web2m.com/Register.html?ref=116" target="_blank">API.WEB2M.COM</a>)</label>
                        <input class="form-control" name="zalo_token" value="<?= $JTech->setting('zalo_token'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Chủ tài khoản</label>
                        <input class="form-control" name="zalo_owner" value="<?= $JTech->setting('zalo_owner'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input class="form-control" name="zalo_phone" value="<?= $JTech->setting('zalo_phone'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Lưu ý khi nạp</label>
                        <input class="form-control" name="zalo_noti" value="<?= $JTech->setting('zalo_noti'); ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/bank'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Thêm ngân hàng</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/add-bank.php" href="<?= FULL_URL('/admin/administrator/bank'); ?>" method="POST">
                    <div class="form-group">
                        <label>Logo ngân hàng</label>
                        <input class="form-control" name="logo" placeholder="Chấp nhận link ảnh">
                    </div>
                    <div class="form-group">
                        <label>Chủ tài khoản</label>
                        <input class="form-control" name="owner" placeholder="Nhập chủ tài khoản">
                    </div>
                    <div class="form-group">
                        <label>Số tài khoản</label>
                        <input class="form-control" name="number_account" placeholder="Nhập số tài khoản">
                    </div>
                    <div class="form-group">
                        <label>Lưu ý khi nạp</label>
                        <input class="form-control" name="noti" placeholder="Bạn muốn lưu ý gì với khách khi nạp qua ngân hàng này ?">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/bank'); ?>">Thêm ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Danh sách ngân hàng</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>LOGO</th>
                                <th>CHỦ TK</th>
                                <th>SỐ TK</th>
                                <th>LƯU Ý</th>
                                <th>THỜI GIAN TẠO</th>
                                <th>THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $JTech->db_query("SELECT * FROM `bank-users` WHERE `username` = 'web' ORDER BY `id` DESC ");
                                while($row = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <td>
                                    <img src="<?= $row['logo']; ?>" width="100">
                                </td>
                                <td>
                                    <?= $row['owner']; ?>
                                </td>
                                <td>
                                    <?= $row['number_account']; ?>
                                </td>
                                <td>
                                    <?= $row['noti']; ?>
                                </td>
                                <td>
                                    <?= formatDate($row['created_time']); ?>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="?delete=<?= $row['id']; ?>">Xóa</a>
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
    <?php if(isset($_GET['delete'])) { ?>
        $(function(){
            const state = {}
            const newTitle = ''
            const newURL = '/admin/administrator/bank'

            history.pushState(state, newTitle, newURL)
        })
    <?php } ?>
</script>
<?php
    require('../../../layout/admin/foot.php');
?>