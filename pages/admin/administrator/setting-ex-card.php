<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Cài đặt đổi thẻ - ".$JTech->setting('website_name');

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-ex-card'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Partner ID</label>
                                <input class="form-control" name="partner_id" value="<?= $JTech->setting('partner_id'); ?>">
                            </div>
                            <div class="form-group">
                                <label>Partner Key</label>
                                <input class="form-control" name="partner_key" value="<?= $JTech->setting('partner_key'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Máy chủ đổi thẻ:</label> <br />
                                <div class="custom-control custom-block custom-control-danger mb-2">
                                    <input type="radio" class="custom-control-input" id="tcv" name="server_ex_card" value="tcv" />
                                    <label class="custom-control-label text-center" for="tcv">
                                        THECAOVIP.XYZ
                                    </label>
                                    <span class="custom-block-indicator">
                                        <i class="fa fa-check"></i>
                                    </span>
                                </div>
                               
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-ex-card'); ?>">Lưu thay đổi</button>
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