<?php
    require('../../core/database.php');
    require('../../core/function.php');
    $title = "ĐÃ VÔ HIỆU HÓA - ".$JTech->setting('website_name');
    require('../../layout/main/head.php');
    
    $JTech->checkToken('banned');

?>
<body>
    <div id="page-container">
        <main id="main-container">
            <div class="bg-image" style="background-image: url('https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/media/photos/photo9@2x.jpg');">
                <div class="row g-0 justify-content-center bg-black-75">
                    <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                        <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                            <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                                <div class="text-center push">
                                    <div class="d-inline-block p-4 rounded bg-body">
                                        <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/media/jzon/lock.png" alt="" width="70" />
                                        <div class="fs-sm fw-semibold text-muted" style="margin-top: 15px;">Tài khoản của bạn đã bị vô hiệu hóa</div>
                                        <div style="margin-top: 10px;">
                                            <a class="btn btn-primary btn-sm" href="/account/logout">ĐĂNG XUẤT</a>
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
