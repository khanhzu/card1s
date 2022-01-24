<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "ĐỔI MẬT KHẨU - ".$JTech->setting('website_name');

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>

<!-- Overview -->
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Đổi mật khẩu</h2>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/account/change-password.php" href="<?= FULL_URL('/account/change-password'); ?>" method="POST">
                    <div class="form-group">
                        <label>Mật khẩu hiện tại</label>
                        <input type="password" class="form-control form-control-alt" name="old_password" placeholder="Mật khẩu hiện tại">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu mới</label>
                        <input type="password" class="form-control form-control-alt" name="new_password" placeholder="Mật khẩu mới">
                    </div>
                    <div class="form-group">
                        <label>Xác nhận mật khẩu</label>
                        <input type="password" class="form-control form-control-alt" name="renew_password" placeholder="Xác nhận mật khẩu">
                    </div>
                    <div class="form-group">
                        <button type="submit" href="<?= FULL_URL('/account/change-password'); ?>" class="btn btn-success">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    require('../../layout/main/foot.php');
?>