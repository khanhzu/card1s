<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Cài đặt bảo mật - ".$JTech->setting('website_name');

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Google Captcha V2</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-security'); ?>" method="POST">
                    <div class="form-group">
                        <label>Site Key</label>
                        <input class="form-control" name="google_site_key" value="<?= $JTech->setting('google_site_key'); ?>">
                    </div>

                    <div class="form-group">
                        <label>Secret Key</label>
                        <input class="form-control" name="google_secret_key" value="<?= $JTech->setting('google_secret_key'); ?>">
                    </div>

                    <div class="form-group">
                        <div class="alert alert-danger">
                            - Lấy thông tin kết nối CAPTCHA <a href="https://www.google.com/recaptcha/admin" target="_blank">tại đây</a> <br>
                            - Để trống 1 trong 2 trường sẽ tự động tắt captcha.
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-security'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Xác thực người dùng</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-security'); ?>" method="POST">
                    <div class="form-group">
                        <label>Tối đa tạo tài khoản / IP</label>
                        <input class="form-control" name="reg_per_ip" value="<?= $JTech->setting('reg_per_ip'); ?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-security'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Top nạp</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-security'); ?>" method="POST">
                    <div class="form-group">
                        <label>Ẩn tên người dùng</label>
                        <select class="form-control" name="hide_name_rank">
                            <option value="yes" <?php if($JTech->setting('hide_name_rank') == 'yes') { echo 'selected'; } ?>>Bật</option>
                            <option value="no" <?php if($JTech->setting('hide_name_rank') == 'no') { echo 'selected'; } ?>>Tắt</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-security'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    require('../../../layout/admin/foot.php');
?>