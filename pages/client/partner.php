<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "KẾT NỐI API - ".$JTech->setting('website_name');

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>

<style>
    @media screen and (min-width: 800px) {
        .center_desktop {
            margin-left: 25%;
        }
    }
</style>

<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Danh sách API</h2>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-content">
                <div style="margin-bottom: 10px;">
                    <a href="/api-docs">Tài liệu hướng dẫn API đổi thẻ cào</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>
                                    Tên
                                </th>
                                <th>
                                    Thông tin kết nối
                                </th>
                                <th>
                                    Phương thức
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                <th>
                                    Lần cuối thực thi
                                </th>
                                <th>
                                    Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `api-partner` WHERE `username` = '".$JTech->user('username')."' ORDER BY `id` DESC");
                                while($api = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr id="partner_<?= $api['id']; ?>">
                                    <td>
                                        <?= $api['name']; ?>  
                                    </td>
                                    <td>
                                        Partner ID: <?= $api['partner_id']; ?> <br>
                                        Partner Key: <?= $api['partner_key']; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">GET</span> <br>
                                        <small><?= $api['callback_url']; ?></small>
                                    </td>
                                    <td>
                                        <?= status_api($api['status']); ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($api['last_used'] != "") {
                                                echo '<span class="badge badge-info">'.formatDate($api['last_used']).'</span>';
                                            }else{
                                                echo '<span class="badge badge-info">Chưa có dữ liệu</span>';
                                            }
                                        ?>  
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" data-id="<?= $api['id']; ?>" onclick="deletePartner(this)">Xóa</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 center_desktop">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Thêm mới</h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/client/action/add-partner.php" href="<?= FULL_URL('/partner'); ?>" method="POST">
                    <div class="form-group">
                        <label>Tên:</label>
                        <input class="form-control form-control-alt" placeholder="Tên mô tả" name="name">
                    </div>
                    <div class="form-group">
                        <label>Đường dẫn nhận dữ liệu (Callback Url):</label>
                        <input class="form-control form-control-alt" placeholder="Ex: https://example.com/callback.php" name="callback_url">
                    </div>
                    <div class="form-group">
                        <button type="submit" href="<?= FULL_URL('/partner'); ?>" class="btn btn-primary">Thêm thông tin kết nối</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function deletePartner(data) {
        Swal.fire({
            title: 'XÁC NHẬN',
            text: "Bạn có chắc chắn thực hiện hành động này?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa ngay'
            }).then((result) => {
            if (result.isConfirmed) {
                var id = $(data).attr('data-id')
                $.ajax({
                    type: "POST",
                    url: "/ajaxs/main/client/action/delete-partner.php",
                    data: {
                        id
                    },
                    dataType: "json",
                    beforeSend: function(){
                        Dashmix.layout('header_loader_on');
                        $(data).attr('disabled', 'disabled')
                    },
                    complete: function(){
                        Dashmix.layout('header_loader_off');
                        $(data).removeAttr('disabled')
                    },
                    success: function (res) {
                        if(res.status) {
                            $("#partner_" + id).remove()
                        }else{
                            swal(res.message, "error")
                        }
                    }
                });
            }
        })
    }
</script>

<?php
    require('../../layout/main/foot.php');
?>