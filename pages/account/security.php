<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "BẢO MẬT - ".$JTech->setting('website_name');

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>


<!-- Overview -->
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Bảo mật tài khoản</h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-content">
                <table class="table table-striped table-hover table-borderless table-vcenter fs-sm" style="margin-bottom: 0px;">
                    <tbody>
                        <tr data-href="/account/security/2fa-auth" <?php if(isMobile()) { echo 'onclick="securityHref(this)"'; } ?>>
                            <td style="width: 7%; padding-right: 0px !important;">
                                <img src="https://play-lh.googleusercontent.com/HPc5gptPzRw3wFhJE1ZCnTqlvEvuVFBAsV9etfouOhdRbkp-zNtYTzKUmUVPERSZ_lAL" width="50" style="margin: 0 auto; display: block;" />
                            </td>
                            <td style="padding-left: 10px !important; width: 80%;">
                                <span style="font-size: 16px;"><strong>Ứng dụng xác thực</strong></span><br />
                                <span class="small">Khi cài trình bảo mật 2 lớp thì mỗi lần đăng nhập bạn cần phải xác thực người dùng.</span>
                            </td>
                            <?php if(!isMobile()) { ?>
                            <td style="width: 10%;">
                                <a class="btn btn-secondary" href="/account/security/2fa-auth">Cài đặt</a>
                            </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>

                <br>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Truy cập lần cuối</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>
                                    IP
                                </th>
                                <th>
                                    Thời gian
                                </th>
                                <th>
                                    Trình duyệt
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?= $JTech->user('ip'); ?>
                                </td>
                                <td>
                                    <?= formatDate($JTech->user('last_access')); ?>
                                </td>
                                <td>
                                    <?= $JTech->user('user_agent'); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php if(isMobile()) { ?>
<script>
    function securityHref(data) {
        var href = $(data).attr('data-href')
        window.location.href = href
    }
</script>
<?php } ?>

<?php
    require('../../layout/main/foot.php');
?>