<body>
    <div id="page-container" class="page-header-dark main-content-boxed">
        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Logo -->
                    <a class="font-w600 text-dual tracking-wide" href="/" style="font-size: 23px; text-transform: uppercase;">
                        <?= $JTech->setting('website_name'); ?>
                    </a>
                    <!-- END Logo -->

                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div>
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-dual dropdown-toggle" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-sm-inline mr-1"><?= displayFullname(); ?></span>
                            <?php 
                                if($JTech->checkToken('request')) { 
                                    echo typeRank($JTech->user('rank'));
                                }
                            ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                            <div class="rounded-top font-w600 text-white text-center bg-image" style="background-image: url('https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/media/photos/photo16.jpg');">
                                <div class="p-3">
                                    <img class="img-avatar img-avatar-thumb" src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/assets/media/avatars/avatar10.jpg" alt="" />
                                </div>
                                <div class="p-3 bg-primary-dark-op">
                                    <a class="text-white font-w600" href="/account/profile" ><?= displayFullname(); ?></a>
                                    <div class="text-white-75"><?= displayCash(); ?></div>
                                </div>
                            </div>
                            <div class="p-2">
                                <?php if($JTech->checkToken('request')) { ?>
                                    <?php if($JTech->user('admin') == 1) { ?>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center text-danger" href="/admin" style="font-weight: bold;">
                                        Quản trị viên
                                        <i class="fa fa-fw fa-tools text-danger-50 ml-1"></i>
                                    </a>
                                    <?php } ?>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/profile">
                                        Thông tin tài khoản
                                        <i class="fa fa-fw fa-user-circle text-primary ml-1"></i>
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/partner">
                                        Kết nối API
                                        <div>
                                            <i class="fa fa-fw fa-code text-black-50 ml-1"></i>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/history/ex-card">
                                        Lịch sử đổi thẻ
                                        <div>
                                            <i class="fa fa-fw fa-history text-black-50 ml-1"></i>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/history/buy-card">
                                        Lịch sử mua thẻ
                                        <div>
                                            <i class="fa fa-fw fa-history text-black-50 ml-1"></i>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/recharge">
                                        Nạp tiền
                                        <div>
                                            <i class="fa fa-fw fa-coins text-black-50 ml-1"></i>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/withdraw">
                                        Rút tiền
                                        <div>
                                            <i class="fa fa-fw fa-donate text-black-50 ml-1"></i>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/transfer">
                                        Chuyển tiền
                                        <div>
                                            <i class="fa fa-fw fa-hand-holding-usd text-black-50 ml-1"></i>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/security">
                                        Bảo mật
                                        <div>
                                            <i class="fa fa-fw fa-user-shield text-black-50 ml-1"></i>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/change-password">
                                        Đổi mật khẩu
                                        <div>
                                            <i class="fa fa-fw fa-key text-black-50 ml-1"></i>
                                        </div>
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/logout">
                                        Đăng xuất
                                        <i class="fa fa-fw fa-sign-out-alt text-danger ml-1"></i>
                                    </a>
                                <?php } else { ?>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/login">
                                        Đăng nhập
                                        <i class="fa fa-fw fa-unlock-alt text-danger ml-1"></i>
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/register">
                                        Đăng ký
                                        <i class="fa fa-fw fa-user text-success ml-1"></i>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-2x fa-spinner fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Navigation -->
            <div class="bg-white">
                <div class="content">
                    <!-- Toggle Main Navigation -->
                    <div class="d-lg-none push">
                        <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                        <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                            Danh mục
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <!-- END Toggle Main Navigation -->

                    <!-- Main Navigation -->
                    <div id="main-navigation" class="d-none d-lg-block push">
                        <ul class="nav-main nav-main-horizontal nav-main-hover">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/">
                                    <i class="nav-main-link-icon fa fa-exchange-alt"></i>
                                    <span class="nav-main-link-name" style="text-transform: uppercase;">Đổi thẻ cào</span>
                                </a>
                            </li>
                            <?php if(!empty($JTech->setting('email_napthe365')) && !empty($JTech->setting('password_napthe365')) && !empty($JTech->setting('security_napthe365'))) { ?>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/buy-card">
                                    <i class="nav-main-link-icon fa fa-shopping-cart"></i>
                                    <span class="nav-main-link-name" style="text-transform: uppercase;">Mua mã thẻ</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/topup">
                                    <i class="nav-main-link-icon fa fa-mobile-alt"></i>
                                    <span class="nav-main-link-name" style="text-transform: uppercase;">Nạp điện thoại</span>
                                </a>
                            </li>
                            <?php } ?>
                            
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/recharge">
                                    <i class="nav-main-link-icon fa fa-coins"></i>
                                    <span class="nav-main-link-name" style="text-transform: uppercase;">Nạp tiền</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/withdraw">
                                    <i class="nav-main-link-icon fa fa-donate"></i>
                                    <span class="nav-main-link-name" style="text-transform: uppercase;">Rút tiền</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/transfer">
                                    <i class="nav-main-link-icon fa fa-hand-holding-usd"></i>
                                    <span class="nav-main-link-name" style="text-transform: uppercase;">Chuyển tiền</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/partner">
                                    <i class="nav-main-link-icon fa fa-code"></i>
                                    <span class="nav-main-link-name" style="text-transform: uppercase;">Kết nối API</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="/rank">
                                    <i class="nav-main-link-icon fa fa-chart-line"></i>
                                    <span class="nav-main-link-name" style="text-transform: uppercase;">Top nạp</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Main Navigation -->
                </div>
            </div>
            <!-- END Navigation -->

            <!-- Page Content -->
            <div class="content content-full">