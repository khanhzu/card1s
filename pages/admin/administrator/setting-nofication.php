<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Cài đặt gửi thông báo - ".$JTech->setting('website_name');
    $switch = true;

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Cấu hình Telegram</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-nofication'); ?>" method="POST">
                    <div class="form-group">
                        <label>Telegram ID</label>
                        <input class="form-control" name="tele_chatid" value="<?= $JTech->setting('tele_chatid'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Telegram Token</label>
                        <input class="form-control" name="tele_token" value="<?= $JTech->setting('tele_token'); ?>">
                    </div>

                    <div class="form-group">
                        <div class="alert alert-danger">
                            - Video hướng dẫn cách lấy Telegram ID và Token => <a href="https://www.youtube.com/watch?v=TBoCKTAXE00" target="_blank">tại đây</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-nofication'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Vùng gửi thông báo</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-nofication'); ?>" method="POST">
                    
                    <input type="hidden" name="nofication_auth" value="<?= $JTech->setting('nofication_auth'); ?>">
                    <input type="hidden" name="nofication_res_card" value="<?= $JTech->setting('nofication_res_card'); ?>">
                    <input type="hidden" name="nofication_buy_card" value="<?= $JTech->setting('nofication_buy_card'); ?>">
                    <input type="hidden" name="nofication_topup" value="<?= $JTech->setting('nofication_topup'); ?>">
                    <input type="hidden" name="nofication_recharge" value="<?= $JTech->setting('nofication_recharge'); ?>">
                    <input type="hidden" name="nofication_withdraw" value="<?= $JTech->setting('nofication_withdraw'); ?>">
                    <input type="hidden" name="nofication_transfer" value="<?= $JTech->setting('nofication_transfer'); ?>">
                    <input type="hidden" name="nofication_api_partner" value="<?= $JTech->setting('nofication_api_partner'); ?>">
                    <input type="hidden" name="nofication_callback" value="<?= $JTech->setting('nofication_callback'); ?>">
                    


                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_auth'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_auth">
                        <label style="margin-left: 10px;">Thành viên đăng kí / đăng nhập / đổi mật khẩu</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_res_card'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_res_card">
                        <label style="margin-left: 10px;">Kết quả đổi thẻ</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_buy_card'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_buy_card">
                        <label style="margin-left: 10px;">Mua thẻ cào</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_topup'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_topup">
                        <label style="margin-left: 10px;">Nạp điện thoại</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_recharge'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_recharge">
                        <label style="margin-left: 10px;">Nạp tiền tự động</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_withdraw'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_withdraw">
                        <label style="margin-left: 10px;">Đơn rút tiền</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_transfer'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_transfer">
                        <label style="margin-left: 10px;">Giao dịch chuyển tiền</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_api_partner'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_api_partner">
                        <label style="margin-left: 10px;">Tạo đối tác API</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" <?= noficationSelect('nofication_callback'); ?> data-size="sm" data-toggle="toggle" data-on="Bật" data-off="Tắt" data-onstyle="success" data-offstyle="danger" setting="nofication_callback">
                        <label style="margin-left: 10px;">Kết quả callback về đối tác API</label>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-nofication'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $("input[type='checkbox']").on('change', function(){
        var setting = $(this).attr('setting')
        if($(this).is(':checked')) {
            $("input[name='" + setting + "']").val('yes')
        }else{
            $("input[name='" + setting + "']").val('no')
        }
    })
</script>
<?php
    require('../../../layout/admin/foot.php');
?>