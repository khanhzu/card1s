<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Cài đặt chuyển tiền - ".$JTech->setting('website_name');

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-transfer'); ?>" method="POST">
                    <div class="form-group">
                        <label>Tối thiểu chuyển</label>
                        <input class="form-control" name="min_cash_transfer" value="<?= $JTech->setting('min_cash_transfer'); ?>">
                    </div>

                    <div class="form-group">
                        <label>Tối đa chuyển</label>
                        <input class="form-control" name="max_cash_transfer" value="<?= $JTech->setting('max_cash_transfer'); ?>">
                    </div>

                    <div class="form-group">
                        <label>Phí chuyển tiền</label>
                        <input class="form-control" name="fee_cash_transfer" value="<?= $JTech->setting('fee_cash_transfer'); ?>">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-transfer'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    require('../../../layout/admin/foot.php');
?>