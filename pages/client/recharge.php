<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "NẠP TIỀN - ".$JTech->setting('website_name');

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>
<style>
    .bank-item {
        margin-right: 10px;
        margin-left: 10px;
    }
    .bank-item .icon {
        margin-right: 10px;
    }
    .bank {
        margin-bottom: 20px;
    }
    .bank-item {
        margin-bottom: 5px;
    }
    .logo_bank {
        height: 50px; 
        margin-bottom: 15px;
    }
</style>
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Nạp tiền</h2>
</div>
<div class="row">
    <?php if($JTech->setting('momo_token') != "") { ?>
    <div class="col-md-4">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="bank">
                    <div class="text-center">
                        <img src="/frontend/main/assets/media/logo/momo.png" class="logo_bank">
                        <!-- <h4>VÍ ĐIỆN TỬ MOMO</h4> -->
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-check-square text-success icon"></i>
                        Chủ tài khoản: <b><?= $JTech->setting('momo_owner'); ?></b> 
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-check-square text-success icon"></i>
                        Số điện thoại: <b><?= $JTech->setting('momo_phone'); ?></b> <button class="btn btn-rounded btn-sm btn-light" data-toggle="click-ripple" onclick="copyText('<?= $JTech->setting('momo_phone'); ?>')"><i class="fas fa-copy"></i></button>
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-sticky-note text-danger icon"></i>
                        Nội dung: <b style="color: red;"><?= memo_recharge('page'); ?></b> <button class="btn btn-rounded btn-sm btn-light" data-toggle="click-ripple" onclick="copyText('<?= memo_recharge('page'); ?>')"><i class="fas fa-copy"></i></button>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-muted">
                <?= $JTech->setting('momo_noti'); ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if($JTech->setting('zalo_token') != "") { ?>
    <div class="col-md-4">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="bank">
                    <div class="text-center">
                        <img src="/frontend/main/assets/media/logo/zalopay.svg" class="logo_bank">
                        <!-- <h4>VÍ ĐIỆN TỬ ZALO PAY</h4> -->
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-check-square text-success icon"></i>
                        Chủ tài khoản: <b><?= $JTech->setting('zalo_owner'); ?></b>
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-check-square text-success icon"></i>
                        Số điện thoại: <b><?= $JTech->setting('zalo_phone'); ?></b> <button class="btn btn-rounded btn-sm btn-light" data-toggle="click-ripple" onclick="copyText('<?= $JTech->setting('zalo_phone'); ?>')"><i class="fas fa-copy"></i></button> 
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-sticky-note text-danger icon"></i>
                        Nội dung: <b style="color: red;"><?= memo_recharge('page'); ?></b> <button class="btn btn-rounded btn-sm btn-light" data-toggle="click-ripple" onclick="copyText('<?= memo_recharge('page'); ?>')"><i class="fas fa-copy"></i></button> 
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-muted">
                <?= $JTech->setting('zalo_noti'); ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php 
        $bank_query = $JTech->db_query("SELECT * FROM `bank-users` WHERE `username` = 'web' ");
        while($bank = mysqli_fetch_assoc($bank_query)) {
    ?>
    <div class="col-md-4">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="bank">
                    <div class="text-center">
                        <img src="<?= $bank['logo']; ?>" class="logo_bank">
                        <!-- <h4><?= $bank['bank_name']; ?></h4> -->
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-check-square text-success icon"></i>
                        Chủ tài khoản: <b><?= $bank['owner']; ?></b>
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-check-square text-success icon"></i>
                        Số tài khoản: <b><?= $bank['number_account']; ?></b> <button class="btn btn-rounded btn-sm btn-light" data-toggle="click-ripple" onclick="copyText('<?= $bank['number_account']; ?>')"><i class="fas fa-copy"></i></button> 
                    </div>
                    <div class="bank-item">
                        <i class="fas fa-sticky-note text-danger icon"></i>
                        Nội dung: <b style="color: red;"><?= memo_recharge('page'); ?></b> <button class="btn btn-rounded btn-sm btn-light" data-toggle="click-ripple" onclick="copyText('<?= memo_recharge('page'); ?>')"><i class="fas fa-copy"></i></button> 
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-muted">
                <?= $bank['noti']; ?>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
</div>
<?php
    require('../../layout/main/foot.php');
?>