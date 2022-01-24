<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Cài đặt website - ".$JTech->setting('website_name');
    $editor = true;

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Tổng thể website</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-website'); ?>" method="POST">
                    <div class="form-group">
                        <label>Tên website</label>
                        <input class="form-control" name="website_name" value="<?= $JTech->setting('website_name'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <input class="form-control" name="description" value="<?= $JTech->setting('description'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Favicon</label>
                        <input class="form-control" name="favicon" value="<?= $JTech->setting('favicon'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Og Image (<b class="text-danger">ẢNH ĐẠI DIỆN</b>)</label>
                        <input class="form-control" name="og_image" value="<?= $JTech->setting('og_image'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <input class="form-control" name="logo" value="<?= $JTech->setting('logo'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Thông báo POPUP</label>
                        <textarea rows="10" name="nofication_home" id="nofication_home"><?= $JTech->setting('nofication_home'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Thông báo ĐỔI THẺ (<b class="text-danger">HOME</b>)</label>
                        <textarea rows="10" name="nofication_ex_card" id="nofication_ex_card"><?= $JTech->setting('nofication_ex_card'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Màu giao diện</label>
                        <select class="form-control" name="theme_mode">
                            <option value="" <?php if($JTech->setting('theme_mode') == '') echo 'selected'; ?>>Mặc định</option>
                            <option value="darkgray" <?php if($JTech->setting('theme_mode') == 'darkgray') echo 'selected'; ?>>Xám tối</option>
                            <option value="darkgray2" <?php if($JTech->setting('theme_mode') == 'darkgray2') echo 'selected'; ?>>Xám tối (V2)</option>
                            <option value="darkgray3" <?php if($JTech->setting('theme_mode') == 'darkgray3') echo 'selected'; ?>>Xám tối (V3)</option>
                            <option value="darkblue" <?php if($JTech->setting('theme_mode') == 'darkblue') echo 'selected'; ?>>Xanh dương tối</option>
                            <option value="darkblue2" <?php if($JTech->setting('theme_mode') == 'darkblue2') echo 'selected'; ?>>Xanh dương tối (V2)</option>
                            <option value="darkgreen" <?php if($JTech->setting('theme_mode') == 'darkgreen') echo 'selected'; ?>>Xanh lá tối</option>
                            <option value="smoothpurple" <?php if($JTech->setting('theme_mode') == 'smoothpurple') echo 'selected'; ?>>Tím mộng mơ</option>
                            <option value="inspiregreen" <?php if($JTech->setting('theme_mode') == 'inspiregreen') echo 'selected'; ?>>Xanh rêu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Plugin Script</label>
                        <textarea name="plugin_script" rows="10" cols="50" class="form-control" style="background-color: #222222;color: #e5b567;"><?= $JTech->setting('plugin_script'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-website'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Truyền thông / Cá nhân</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-setting.php" href="<?= FULL_URL('/admin/administrator/setting-website'); ?>" method="POST">
                    <div class="form-group">
                        <label>Email của bạn</label>
                        <input class="form-control" name="email_admin" value="<?= $JTech->setting('email_admin'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại của bạn</label>
                        <input class="form-control" name="phone_admin" value="<?= $JTech->setting('phone_admin'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Đường dẫn MXH (<b class="text-danger">Hiện ở SEO Tags</b>)</label>
                        <input class="form-control" name="social_admin" value="<?= $JTech->setting('social_admin'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Hotline (<b class="text-danger">Hiện ở Footer</b>)</label>
                        <input class="form-control" name="hotline" value="<?= $JTech->setting('hotline'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Facebook URL (<b class="text-danger">Hiện ở icon FB Footer</b>)</label>
                        <input class="form-control" name="facebook_url" value="<?= $JTech->setting('facebook_url'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Youtube URL (<b class="text-danger">Hiện ở icon YTB Footer</b>)</label>
                        <input class="form-control" name="youtube_url" value="<?= $JTech->setting('youtube_url'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Website URL (<b class="text-danger">Hiện ở icon WEB Footer</b>)</label>
                        <input class="form-control" name="website_url" value="<?= $JTech->setting('website_url'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Giờ làm việc (<b class="text-danger">Hiện ở Footer</b>)</label>
                        <input class="form-control" name="work_time" value="<?= $JTech->setting('work_time'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Website liên kết (<b class="text-danger">Hiện ở Footer, mỗi dòng 1 liên kết</b>)</label>
                        <textarea rows="5" class="form-control" name="info_url"><?= $JTech->setting('info_url'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" href="<?= FULL_URL('/admin/administrator/setting-website'); ?>">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#nofication_home').summernote();
        $('#nofication_ex_card').summernote();
    });
    
</script>
<?php
    require('../../../layout/admin/foot.php');
?>