<style>
    .text-end{
        text-align: right!important;
    }
    .fw-medium {
        font-weight: 500!important;
    }
    .fs-3 {
        font-size: calc(1.275rem + .3vw)!important;
    }
</style>

<?php
    $id = intval($_GET['detail']);
    $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `users` WHERE `id` = '$id' "));
    if(!$info) {
        echo '<h1 style="margin: 0 auto;" class="text-danger">Không tìm thấy thành viên</h1>';
    }else{
        $title_new = "Chi tiết thành viên #".$id." - ".$JTech->setting('website_name');
        # TỔNG THỰC NHẬN THÀNH CÔNG HOẶC SAI MỆNH GIÁ
        $total_recieve_success = mysqli_fetch_assoc($JTech->db_query("SELECT SUM(`amount_recieve`) FROM `card-data` WHERE `username` = '".$info['username']."' AND `status` = 'success' OR `status` = 'wrong_amount' "))['SUM(`amount_recieve`)'];

        # TỔNG THẺ ĐÚNG
        $total_success_card = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `status` = 'success' AND `username` = '".$info['username']."' ");
        # TỔNG THẺ SAI
        $total_fail_card = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `status` = 'fail' AND `username` = '".$info['username']."' ");
        # TỔNG THẺ SAI MỆNH GIÁ
        $total_wrong_card = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `status` = 'wrong_amount' AND `username` = '".$info['username']."' ");

?>
<div class="col-md-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-2x fa-money-bill text-success"></i>
            </div>
            <div class="ms-3 text-end">
                <p class="fs-3 fw-medium mb-0">
                    <?= number_format($info['cash']); ?>đ
                </p>
                <p class="text-muted mb-0">
                    Số dư hiện tại
                </p>
            </div>
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-2x fa-code-branch text-info"></i>
            </div>
            <div class="ms-3 text-end">
                <p class="fs-3 fw-medium mb-0">
                    <?php
                        if(typeRank($info['rank']) == '') {
                            echo 'Thành viên';
                        }else{
                            echo typeRank($info['rank']);
                        }
                    ?>
                </p>
                <p class="text-muted mb-0">
                    Cấp bậc
                </p>
            </div>
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-2x fa-toggle-on text-secondary"></i>
            </div>
            <div class="ms-3 text-end">
                <p class="fs-3 fw-medium mb-0">
                    <?php
                        if($info['banned'] == 1) {
                            echo '<span class="badge badge-danger">Đã khóa</span>';
                        }else{
                            echo '<span class="badge badge-success">Hoạt động</span>';
                        }
                    ?>
                </p>
                <p class="text-muted mb-0">
                    Trạng thái
                </p>
            </div>
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-2x fa-server text-warning"></i>
            </div>
            <div class="ms-3 text-end">
                <p class="fs-3 fw-medium mb-0">
                    <?= $info['ip']; ?>
                </p>
                <p class="text-muted mb-0">
                    Địa chỉ IP
                </p>
            </div>
        </div>
    </a>
</div>

<div class="col-md-3">
    <a class="block block-rounded block-link-shadow bg-secondary" href="javascript:void(0)">
        <div class="block-content block-content-full align-items-center">
            <div class="ms-3 text-center">
                <p class="text-white fs-3 fw-medium mb-0">
                    <?= number_format($total_recieve_success); ?>đ
                </p>
                <p class="text-white-75 mb-0">
                    Tổng thực nhận
                </p>
            </div>
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="block block-rounded block-link-shadow bg-success" href="javascript:void(0)">
        <div class="block-content block-content-full align-items-center">
            <div class="ms-3 text-center">
                <p class="text-white fs-3 fw-medium mb-0">
                    <?= number_format($total_success_card); ?>
                </p>
                <p class="text-white-75 mb-0">
                    Số thẻ thành công
                </p>
            </div>
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="block block-rounded block-link-shadow bg-danger" href="javascript:void(0)">
        <div class="block-content block-content-full align-items-center">
            <div class="ms-3 text-center">
                <p class="text-white fs-3 fw-medium mb-0">
                    <?= number_format($total_fail_card); ?>
                </p>
                <p class="text-white-75 mb-0">
                    Số thẻ sai
                </p>
            </div>
        </div>
    </a>
</div>
<div class="col-md-3">
    <a class="block block-rounded block-link-shadow bg-info" href="javascript:void(0)">
        <div class="block-content block-content-full align-items-center">
            <div class="ms-3 text-center">
                <p class="text-white fs-3 fw-medium mb-0">
                    <?= number_format($total_wrong_card); ?>
                </p>
                <p class="text-white-75 mb-0">
                    Số thẻ sai mệnh giá
                </p>
            </div>
        </div>
    </a>
</div>

<div class="col-md-6">
    <div class="block block-rounded">
        <div class="block-content">
            <h2 class="content-heading pt-0"><i class="fa fa-fw fa-user-circle text-muted me-1"></i> Thông tin tài khoản</h2>
            <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/list/member.php" href="<?= FULL_URL('/admin/list/member?detail='.$id); ?>" method="POST">
                <input type="hidden" value="<?= $info['id']; ?>" name="id" />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tên đăng nhập:</label>
                            <input type="text" class="form-control" value="<?= $info['username']; ?>" name="username" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Họ và tên:</label>
                            <input type="text" class="form-control" value="<?= $info['full_name']; ?>" name="full_name" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại:</label>
                    <input type="text" class="form-control" value="<?= $info['phone']; ?>" name="phone" />
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ email:</label>
                    <input type="text" class="form-control" value="<?= $info['email']; ?>" name="email" />
                </div>
                <div class="form-group">
                    <label for="">Số dư:</label>
                    <input type="text" class="form-control" value="<?= $info['cash']; ?>" name="cash" />
                </div>
                <div class="form-group">
                    <label for="">Cấp bậc:</label> <br />
                    <div class="custom-control custom-block custom-control-info mb-2">
                        <input type="radio" class="custom-control-input" id="member" name="rank" value="member" />
                        <label class="custom-control-label text-center" for="member">
                            Thành viên
                        </label>
                        <span class="custom-block-indicator">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>

                    <div class="custom-control custom-block custom-control-warning mb-2">
                        <input type="radio" class="custom-control-input" id="vip" name="rank" value="vip" />
                        <label class="custom-control-label text-center" for="vip">
                            VIP
                        </label>
                        <span class="custom-block-indicator">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>

                    <div class="custom-control custom-block custom-control-danger">
                        <input type="radio" class="custom-control-input" id="agency" name="rank" value="agency" />
                        <label class="custom-control-label text-center" for="agency">
                            ĐẠI LÝ
                        </label>
                        <span class="custom-block-indicator">
                            <i class="fa fa-check"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Token đăng nhập:</label>
                    <input type="text" class="form-control" value="<?= $info['token']; ?>" name="token" />
                    <span class="text-danger" style="font-style: italic;">Để trống hoặc nhập bừa để đăng xuất nơi khác</span>
                </div>
                <div class="form-group">
                    <label for="">User Agent:</label>
                    <input type="text" class="form-control" value="<?= $info['user_agent']; ?>" readonly />
                </div>
                <div class="form-group">
                    <button type="submit" href="<?= FULL_URL('/admin/list/member?detail='.$id); ?>" class="btn btn-hero-primary btn-block">LƯU THAY ĐỔI</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="block block-rounded">
        <div class="block-content">
            <h2 class="content-heading pt-0"><i class="fa fa-fw fa-tools text-muted me-1"></i> Thao tác thành viên</h2>

            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-6" style="margin-bottom: 15px;">
                    <?php if($info['banned'] == 1) { ?>
                        <buton onclick="banned(this)" class="btn btn-hero-success btn-block">MỞ KHÓA</button>
                    <?php } else { ?>
                        <buton onclick="banned(this)" class="btn btn-hero-danger btn-block">VÔ HIỆU HÓA</button>
                    <?php } ?>
                </div>
                <div class="col-md-6" style="margin-bottom: 15px;">
                    <buton onclick="delete__(this)" class="btn btn-hero-light btn-block text-danger">XÓA TÀI KHOẢN</button>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-content">
            <h2 class="content-heading pt-0"><i class="fa fa-fw fa-dollar-sign text-muted me-1"></i> Thực thi số dư</h2>
            <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/progress-cash.php" href="<?= FULL_URL('/admin/list/member?detail='.$id); ?>" method="POST">
                <input type="hidden" value="<?= $info['id']; ?>" name="id" />
                <div class="form-group">
                    <label for="">Loại thực thi:</label>
                    <select class="form-control" name="type">
                        <option value="+">CỘNG TIỀN</option>
                        <option value="-">TRỪ TIỀN</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Số tiền:</label>
                    <input type="number" class="form-control" name="cash" placeholder="Nhập số tiền thực thi">
                </div>

                <div class="form-group">
                    <button type="submit"  href="<?= FULL_URL('/admin/list/member?detail='.$id); ?>" class="btn btn-danger">XÁC NHẬN</button>
                </div>
            </form>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-content">
            <h2 class="content-heading pt-0"><i class="fa fa-fw fa-lock text-muted me-1"></i> Reset mật khẩu</h2>
            <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/reset-password.php" href="<?= FULL_URL('/admin/list/member?detail='.$id); ?>" method="POST">
                <input type="hidden" value="<?= $info['id']; ?>" name="id" />
                <div class="form-group">
                    <label for="">Mật khẩu mới:</label>
                    <input type="text" class="form-control" name="password" placeholder="Nhập mật khẩu mới">
                </div>
                <div class="form-group">
                    <button type="submit"  href="<?= FULL_URL('/admin/list/member?detail='.$id); ?>" class="btn btn-danger">XÁC NHẬN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="block block-rounded">
        <div class="block-content">
            <h2 class="content-heading pt-0"><i class="fa fa-fw fa-history text-muted me-1"></i> Lịch sử đổi thẻ</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>TRẠNG THÁI</th>
                            <th>NHÀ MẠNG</th>
                            <th>MÃ THẺ</th>
                            <th>SERIAL</th>
                            <th>MỆNH GIÁ</th>
                            <th>THỰC NHẬN</th>
                            <th>THỜI GIAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            $card_query = $JTech->db_query("SELECT * FROM `card-data` WHERE `username` = '".$info['username']."' ORDER BY `id` DESC ");
                            while($card = mysqli_fetch_assoc($card_query)) {
                        ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                <?= status_card($card['status']); ?>
                            </td>
                            <td>
                                <?= getTelco($card['telco'], 'name'); ?>
                            </td>
                            <td>
                                <?= $card['pin']; ?>
                            </td>
                            <td>
                                <?= $card['serial']; ?>
                            </td>
                            <td>
                                <?= number_format($card['amount']); ?>đ
                            </td>
                            <td>
                                <?= number_format($card['amount_recieve']); ?>đ
                            </td>
                            <td>
                                <?= formatDate($card['created_time']); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(function(){
        $("#<?= $info['rank']; ?>").trigger('click');
        document.title = "<?= $title_new; ?>"
    })

    function banned(data) {
        $.ajax({
            type: "POST",
            url: "/ajaxs/admin/action/banned-member.php",
            data: {
                id: $("input[name='id']").val()
            },
            dataType: "json",
            beforeSend: function(){
                $(data).attr('disabled', 'disabled')  
            },
            complete: function(){
                $(data).removeAttr('disabled')   
            },
            success: function (res) {
                if(res.status){
                    swal(res.message, 'success')
                    setTimeout(function(){
                        window.location.reload()
                    }, 1200)
                }else{
                    swal(res.message, 'error')
                }
            }
        });
    }

    function delete__(data) {
        $.ajax({
            type: "POST",
            url: "/ajaxs/admin/action/delete-member.php",
            data: {
                id: $("input[name='id']").val()
            },
            dataType: "json",
            beforeSend: function(){
                $(data).attr('disabled', 'disabled')  
            },
            complete: function(){
                $(data).removeAttr('disabled')   
            },
            success: function (res) {
                if(res.status){
                    swal(res.message, 'success')
                    setTimeout(function(){
                        window.location.href = "/admin/list/member"
                    }, 1200)
                }else{
                    swal(res.message, 'error')
                }
            }
        });
    }

</script>
<?php } ?>