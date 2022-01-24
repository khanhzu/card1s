<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "THÔNG TIN TÀI KHOẢN - ".$JTech->setting('website_name');

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>
<!-- Overview -->
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Thông tin tài khoản</h2>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Tên đăng nhập:</td>
                                <td><strong><?= $JTech->user('username'); ?></strong></td>
                            </tr>
                            <tr>
                                <td>Họ và tên:</td>
                                <td><?= $JTech->user('full_name'); ?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>
                                    <?php
                                        if($JTech->user('email') == '') {
                                    ?>
                                    <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/client/action/update-email.php" href="<?= FULL_URL('/account/profile'); ?>" method="POST">
                                        <div class="input-group">
                                            <input type="email" class="form-control form-control-alt" name="email" placeholder="Email của bạn" />
                                            <button type="submit" href="<?= FULL_URL('/account/profile'); ?>" class="btn btn-success" style="text-transform: uppercase;">CẬP NHẬT</button>
                                        </div>
                                        <span class="text-danger" style="font-style: italic">Cập nhật email để có thể khôi phục tài khoản</span>
                                    </form>
                                    <?php
                                        }else{
                                            echo $JTech->user('email');
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số điện thoại:</td>
                                <td>
                                    <?php
                                        if($JTech->user('phone') == '') {
                                    ?>
                                    <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/client/action/update-phone.php" href="<?= FULL_URL('/account/profile'); ?>" method="POST">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-alt" name="phone" placeholder="Số điện thoại của bạn" />
                                            <button type="submit" href="<?= FULL_URL('/account/profile'); ?>" class="btn btn-success" style="text-transform: uppercase;">CẬP NHẬT</button>
                                        </div>
                                    </form>
                                    <?php
                                        }else{
                                            echo $JTech->user('phone');
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Cấp bậc:</td>
                                <td>
                                    <?php 
                                        if(typeRank($JTech->user('rank')) == '') {
                                            echo 'Thành viên';
                                        }else{
                                            echo typeRank($JTech->user('rank'));
                                        }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Ngày đăng ký:</td>
                                <td><?= formatDate($JTech->user('created_time')); ?></td>
                            </tr>
                            <tr>
                                <td>Số dư khả dụng:</td>
                                <td>
                                    <span class="text-success"><b><?= number_format($JTech->user('cash')); ?>đ</b></span><br />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="/account/change-password" class="btn btn-danger btn-sm">Đổi mật khẩu</a>
                <br><br>
            </div>
        </div>
    </div>
    
</div>
<a href="https://social-unlock.com/7fFbX">Bấm vào <a>đây</a> để lấy code dvfb</a> 
</br>
<a href="https://social-unlock.com/MqXfe">Bấm vào <a>đây</a> để lấy code giới tbt</a> 
<?php
    require('../../layout/main/foot.php');
?>