<?php
    require('../../../core/database.php');
    require('../../../core/function.php');

    $title = "Bảo mật ứng dụng - ".$JTech->setting('website_name');

    require('../../../layout/main/head.php');
    require('../../../layout/main/navbar.php');

    $JTech->checkToken('client');

    require_once($_SERVER['DOCUMENT_ROOT'].'/api_3rd/googleLib/GoogleAuthenticator.php');
    $ga = new PHPGangsta_GoogleAuthenticator();
?>

<!-- Overview -->
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Cài đặt bảo mật ứng dụng</h2>
</div>
<div class="row">
    <?php if($JTech->user('2fa_code') == '') { ?>
        <div class="col-lg-12">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="text-center" style="margin-bottom: 20px;">
                        <b class="text-danger" style="font-size: 20px;">Khi cài trình bảo mật 2 lớp thì mỗi lần đăng nhập bạn cần phải xác thực người dùng.</b> <br> <br>
                        <img src="/frontend/main/assets/media/jzon/auth.png"> <br> <br>
                        <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/account/security/2fa-auth.php" href="<?= FULL_URL('/account/security/2fa-auth'); ?>" method="POST">
                            <input type="hidden" name="type" value="on">
                            <button type="submit" class="btn btn-hero-primary" href="<?= FULL_URL('/account/security/2fa-auth'); ?>"><i class="fas fa-fingerprint"></i> Bật trình tạo mã</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="col-lg-12">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="text-center" style="margin-bottom: 20px;">
                        <b class="text-danger" style="font-size: 20px;">Khi cài trình bảo mật 2 lớp thì mỗi lần đăng nhập bạn cần phải xác thực người dùng.</b> <br> <br>
                        <img src="<?= $ga->getQRCodeGoogleUrl($JTech->user('username'), $JTech->user('2fa_code')); ?>"> <br> <br>
                        Khóa bảo mật: <b class="text-success"><?= $JTech->user('2fa_code'); ?></b>
                        <br><br>
                        <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/account/security/2fa-auth.php" href="<?= FULL_URL('/account/security/2fa-auth'); ?>" method="POST">
                            <input type="hidden" name="type" value="off">
                            <button type="submit" class="btn btn-hero-danger" href="<?= FULL_URL('/account/security/2fa-auth'); ?>"><i class="fas fa-power-off"></i> Tắt trình tạo mã</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php
    require('../../../layout/main/foot.php');
?>