<?php
    require('../../core/database.php');
    require('../../core/function.php');
    $title = "ĐĂNG KÝ - ".$JTech->setting('website_name');
    require('../../layout/main/head.php');
    
    $JTech->checkToken('auth');

?>
<body>
    <div id="page-container">
        <main id="main-container">
            <div class="row no-gutters justify-content-center bg-body-dark">
                <div class="hero-static col-sm-10 col-md-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
                    <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image" style="background-image: url('https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/media/photos/photo12.jpg');">
                        <div class="row no-gutters">
                            <div class="col-md-6 order-md-1 bg-white">
                                <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                    <div class="mb-2 text-center">
                                        <!-- <a class="link-fx text-success font-w700 font-size-h1" href="/" style="text-transform: uppercase;"> <span class="text-dark"><?= explode('.', $_SERVER['SERVER_NAME'])[0]; ?></span><span class="text-success"><?= explode('.', $_SERVER['SERVER_NAME'])[1]; ?></span> </a> -->
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">ĐĂNG KÝ</p>
                                    </div>
                                    <form class="js-validation-signup" submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/account/register.php" href="<?= FULL_URL('/'); ?>" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-alt" name="username" placeholder="Tên đăng nhập" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-alt" name="full_name" placeholder="Họ và tên" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-alt" name="phone_or_email" placeholder="Số điện thoại hoặc email" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-alt" name="password" placeholder="Mật khẩu" />
                                        </div>

                                        <?php if(!empty($JTech->setting('google_site_key')) && !empty($JTech->setting('google_secret_key')) ) { ?>
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-sitekey="<?= $JTech->setting('google_site_key'); ?>" style="transform:scale(0.9);-webkit-transform:scale(0.9);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                                        </div>
                                        <?php } ?>

                                        <div class="form-group">
                                            <button type="submit" href="<?= FULL_URL('/'); ?>" class="btn btn-block btn-hero-success"><i class="fa fa-fw fa-plus mr-1"></i> ĐĂNG KÝ</button>
                                        </div>
                                        <div class="form-group text-center">
                                            Đã có tài khoản? <a href="/account/login">Đăng nhập ngay</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 order-md-0 bg-xeco-op d-flex align-items-center">
                                <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                    <div class="media">
                                        <a class="img-link mr-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar-thumb" src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/media/avatars/avatar3.jpg" alt="" />
                                        </a>
                                        <div class="media-body">
                                            <p class="text-white font-w600 mb-1">
                                                ĐĂNG KÝ TÀI KHOẢN
                                            </p>
                                            <a class="text-white-75 font-w600" href="javascript:void(0)">Tạo ngay tại khoản mới để được hưởng nhiều ưu đãi mới.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/script.js?<?= time(); ?>"></script>
    
</body>
</html>
