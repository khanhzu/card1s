<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Cài đặt mua thẻ & nạp điện thoại - ".$JTech->setting('website_name');

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-buy-topup-card'); ?>" method="POST">
                    <div class="form-group">
                        <label>Email đăng nhập (<a href="https://napthe365.com" target="_blank">NAPTHE365</a>)</label>
                        <input class="form-control" name="email_napthe365" value="<?= $JTech->setting('email_napthe365'); ?>">
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu đăng nhập (<a href="https://napthe365.com" target="_blank">NAPTHE365</a>)</label>
                        <input class="form-control" name="password_napthe365" value="<?= $JTech->setting('password_napthe365'); ?>">
                    </div>

                    <div class="form-group">
                        <label>Khóa bảo mật</label>
                        <input class="form-control" name="security_napthe365" value="<?= $JTech->setting('security_napthe365'); ?>">
                        <span class="text-danger">Để lấy khóa bảo mật, vui lòng liên hệ hỗ trợ NAPTHE365.COM để được cấp khóa bảo mật.</span>
                    </div>

                    <div class="form-group">
                        <label>Số thẻ mua tối đa / lần</label>
                        <input class="form-control" name="max_amount_buy_card" value="<?= $JTech->setting('max_amount_buy_card'); ?>">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-buy-topup-card'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#<?= $JTech->setting('server_ex_card'); ?>").trigger('click');
    })
</script>
<?php
    require('../../../layout/admin/foot.php');
?>