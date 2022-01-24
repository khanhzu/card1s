<?php
    require('../../core/database.php');
    require('../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Cập nhật website - ".$JTech->setting('website_name');
    $chart = true; 
    
    require('../../layout/admin/head.php');
    require('../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-12 text-center" id="loading_txt" style="display: none;">
        <h3>Đang tải dữ liệu cập nhật...</h3>        
    </div>
    <div class="col-lg-8">
        <div class="alert alert-info alert-dismissible" role="alert">
            <h4 class="alert-heading fs-4 my-2">Chi tiết phiên bản <?= $JTech->setting('code_version'); ?></h4>
            <p class="mb-0" id="detail_version">
                undefinded
            </p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active" onclick="loadUpdate()">
                Thông tin mã nguồn <i class="fas fa-sync-alt"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                Phiên bản hiện tại: <b id="current_version">undefinded</b>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                Phiên bản mới nhất: <b id="last_version">undefinded</b>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                Trạng thái: <span id="status">undefinded</span>
            </a>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 15px;">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row">
                    <div class="col-md-6" style="margin: 0 auto;">
                        <div class="alert alert-success alert-dismissible" role="alert" id="detail_new_version" style="display: none;">
                            <h4 class="alert-heading fs-4 my-2">Chi tiết cập nhật mới</h4>
                            <p class="mb-0" id="detail_update">
                                - Đang lấy dữ liệu...
                            </p>
                        </div>
                        <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/action/update-website.php" href="<?= FULL_URL('/admin/update'); ?>" method="POST">
                            <div class="form-group">
                                <label>Nhập mã:</label>
                                <input class="form-control form-control-alt" placeholder="Mã kích hoạt cập nhật" name="key">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm btn-block" href="<?= FULL_URL('/admin/update'); ?>">CẬP NHẬT NGAY</button>
                            </div>
                        </form>
                        
                        <div class="form-group">
                            <div class="alert alert-danger">
                                - Để có mã cập nhật phiên bản mới nhất vui lòng liên hệ <a href="https://zalo.me/0966142061" target="_blank">JZONTECH</a> để được cấp.
                                <br>
                                <br>
                                - Mỗi website chỉ được cập nhật 1 lần duy nhất, lần 2 trở lên sẽ xem xét với lý do chính đáng.
                                <br>
                                <br>
                                - Không tải lại trang trong suốt quá trình cập nhật website, nếu cảm thấy quá lâu vui lòng liên hệ <a href="https://zalo.me/0966142061" target="_blank">JZONTECH</a> để hỗ trợ cập nhật.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function(){
        loadUpdate()
    })


    function loadUpdate() {
        $.ajax({
            type: "GET",
            url: "/ajaxs/admin/action/load-update.php",
            dataType: "json",
            beforeSend: function() {
                $("#loading_txt").show()
                $("button[type='submit']").attr('disabled', 'disabled')
            },
            complete: function(){
                $("#loading_txt").hide()
                $("button[type='submit']").removeAttr('disabled')
            },
            success: function (res) {
                if(res.status){
                    $("#detail_version").html(res.detail_version)
                    $("#current_version").html(res.current_version)
                    $("#last_version").html(res.last_version)
                    $("#status").html(res.status_)

                    if(res.detail_new_version != null) {
                        $("#detail_new_version").show()
                        $("#detail_update").html(res.detail_new_version)
                    }
                }else{
                    swal(res.message, "error")
                }
            }
        });
    }
</script>

<?php
    require('../../layout/admin/foot.php');
?>