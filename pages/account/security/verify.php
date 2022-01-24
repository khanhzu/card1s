<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $title = "XÁC THỰC TÀI KHOẢN - ".$JTech->setting('website_name');
    require('../../../layout/main/head.php');
    
    $JTech->checkToken('verify');

?>
<body>
    <div id="page-container">
        <main id="main-container">
            <div class="row no-gutters justify-content-center bg-body-dark">
                <div class="hero-static col-sm-10 col-md-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
                    <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image" style="background-image: url('https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/media/photos/photo20@2x.jpg');">
                        <div class="row no-gutters">
                            <div class="col-md-6 order-md-1 bg-white">
                                <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                    <div class="mb-2 text-center">
                                        <!-- <a class="link-fx font-w700 font-size-h1" href="" style="text-transform: uppercase;"> <span class="text-dark"><?= explode('.', $_SERVER['SERVER_NAME'])[0]; ?></span><span class="text-primary"><?= explode('.', $_SERVER['SERVER_NAME'])[1]; ?></span> </a> -->
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">XÁC THỰC TÀI KHOẢN</p>
                                    </div>
                                    <form class="js-validation-signin" submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/account/security/2fa-auth.php" href="<?= FULL_URL('/'); ?>" method="POST">
                                        <input type="hidden" value="check" name="type">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-alt" name="token" placeholder="Mã đăng nhập" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" href="<?= FULL_URL('/'); ?>" class="btn btn-block btn-hero-danger"><i class="fas fa-lock-open"></i> XÁC THỰC</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php if(!isMobile()) { ?>
                                <div class="col-md-6 order-md-0 bg-danger-dark-op d-flex align-items-center">
                                    <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                        <div class="media">
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/js/script.js?<?= time(); ?>"></script>
    
</body>
</html>

