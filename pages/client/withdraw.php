<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "RÚT TIỀN - ".$JTech->setting('website_name');
    $required_datatable = true;
    $select2 = true;

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Rút tiền </h2>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <?php if($JTech->isMobile()) { ?>
                <h3 class="block-title">TẠO YÊU CẦU RÚT TIỀN <a class="btn btn-secondary btn-sm">PHÍ RÚT TIỀN: 100đ</a></h3>
                <?php } else { ?>
                <h3 class="block-title">TẠO YÊU CẦU RÚT TIỀN</h3>
                <div calss="block-options">
                    <a class="btn btn-secondary btn-sm">PHÍ RÚT TIỀN: <?= number_format($JTech->setting('fee_cash_withdraw')); ?>đ</a>
                </div>
                <?php } ?>
            </div>
            <div class="block-content">
                <?php
                    $num_bank = $JTech->db_num_rows("SELECT * FROM `bank-users` WHERE `username` = '".$JTech->user('username')."' ");
                    if($num_bank <= 0) { 
                ?>
                <div class="text-center" id="welcome_add">
                    <img src="/frontend/main/assets/media/logo/add-bank.png" style="width: 120px;">
                    <div style="margin-top: 10px; margin-right: 30px; margin-left: 30px;">
                        Thêm thông tin rút tiền ngay để sử dụng toàn bộ chức năng rút tiền.
                    </div>
                    <div style="margin-top: 15px; margin-bottom: 30px;">
                        <a class="btn btn-hero-danger" onclick="showPanelAdd()">Thêm ngay</a>
                    </div>
                </div>
                <div id="panel_add" style="display: none;">
                    <div class="text-center" style="margin-bottom: 35px;">
                        <h4 style="margin-bottom: 0;">THÊM THÔNG TIN RÚT TIỀN</h4>
                        <span class="text-muted">Bắt đầu thêm thông tin rút tiền ngay hôm nay.</span>
                    </div>
                    <div>
                        <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/client/action/add-bank.php" href="<?= FULL_URL('/withdraw'); ?>" method="POST">
                            <div class="form-group">
                                <select class="js-select2 form-control" id="example-select2" name="bank_name" style="width: 100%;" data-placeholder="Chọn ngân hàng">
                                    <option></option>
                                    <?php
                                        foreach (bank_data() as $key => $value) {
                                    ?>
                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-alt" name="owner" placeholder="Chủ tài khoản">
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-alt" name="number_account" placeholder="Số tài khoản">
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-alt" name="branch" placeholder="Chi nhánh">
                            </div>

                            <div class="form-group">
                                <button type="submit" href="<?= FULL_URL('/withdraw'); ?>" class="btn btn-hero-primary btn-block">THÊM NGÂN HÀNg</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } else { ?>
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/main/client/withdraw.php" href="<?= FULL_URL('/withdraw'); ?>" method="POST">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Số dư khả dụng:</td>
                                <td class="text-danger" style="font-weight: bold; font-size: 20px;">
                                    <?= number_format($JTech->user('cash')); ?>đ
                                </td>
                            </tr>
                            <tr>
                                <td>Số tiền cần rút:</td>
                                <td>
                                    <input type="number" class="form-control form-control-alt" name="cash" placeholder="Số tiền cần rút" value="" />
                                    <small class="text-danger">Tối thiểu <?= number_format($JTech->setting('min_cash_withdraw')); ?>đ , Tối đa <?= number_format($JTech->setting('max_cash_withdraw')); ?>đ</small>
                                </td>
                            </tr>
                            <tr>
                                <td>Chọn ngân hàng:</td>
                                <td>
                                    <select class="js-select2 form-control" id="example-select2" name="bank_data" style="width: 100%;" data-placeholder="Chọn ngân hàng">
                                        <option></option>
                                        <?php
                                            $query = $JTech->db_query("SELECT * FROM `bank-users` WHERE `username` = '".$JTech->user('username')."' ORDER BY `id` DESC ");
                                            while($bank = mysqli_fetch_assoc($query)){
                                        ?>
                                        <option value="<?= $bank['key']; ?>"><?= $bank['bank_name']; ?> - <?= $bank['number_account']; ?> - <?= $bank['owner']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Nội dung:</td>
                                <td>
                                    <textarea name="description" class="form-control form-control-alt" placeholder="Nội dung rút (nếu có)"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="form-group">
                        <button type="submit" href="<?= FULL_URL('/withdraw'); ?>" class="btn btn-hero-primary">RÚT TIỀN NGAY</button>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">NGÂN HÀNG CỦA BẠN</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>Ngân hàng</th>
                                <th>Chủ tài khoản</th>
                                <th>Số tài khoản</th>
                                <th>Chi nhánh</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $JTech->db_query("SELECT * FROM `bank-users` WHERE `username` = '".$JTech->user('username')."' ORDER BY `id` DESC ");
                                while($bank = mysqli_fetch_assoc($query)){
                            ?>
                            <tr id="bank_<?= $bank['key']; ?>">
                                <td class="text-success" style="font-weight: bold;"><?= $bank['bank_name']; ?></td>
                                <td class="text-danger" style="font-weight: bold;"><?= $bank['owner']; ?></td>
                                <td class="text-info" style="font-weight: bold;"><?= $bank['number_account']; ?></td>
                                <td class="text-secondary" style="font-weight: bold;"><?= $bank['branch']; ?></td>
                                <td>
                                    <button class="btn btn-hero-danger" data-key="<?= $bank['key']; ?>" onclick="deleteBank(this)"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lịch sử rút tiền</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>
                                    Mã GD
                                </th>
                                <th>
                                    Ngân hàng
                                </th>
                                <th>
                                    Chủ tài khoản
                                </th>
                                <th>
                                    Số tài khoản
                                </th>
                                <th>
                                    Chi nhánh
                                </th>
                                <th>
                                    Số tiền rút
                                </th>
                                <th>
                                    Nội dung
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                <th>
                                    Thời gian tạo
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = $JTech->db_query("SELECT * FROM `withdraw` WHERE `username` = '".$JTech->user('username')."' ORDER BY `id` DESC LIMIT 20");
                                while($with = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $with['withdraw_code']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['bank_name']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['owner']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['number_account']; ?>  
                                    </td>
                                    <td>
                                        <?= $with['branch']; ?>  
                                    </td>
                                    <td class="text-danger" style="font-weight: bold;">
                                        <?= number_format($with['cash_withdraw']); ?>đ  
                                    </td>
                                    <td>
                                        <?= $with['description']; ?>  
                                    </td>
                                    <td>
                                        <?= status_withdraw($with['status']); ?>
                                    </td>
                                    <td>
                                        <?= formatDate($with['created_time']); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function showPanelAdd() {
        $("#welcome_add").remove()
        $("#panel_add").show()
    }

    function deleteBank(data) {
        var key = $(data).attr('data-key')
        
        $.ajax({
            type: "POST",
            url: "/ajaxs/main/client/action/delete-bank.php",
            data: {
                key
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
                    $("#bank_" + key).remove()
                }else{
                    swal(res.message, "error")
                }
            }
        });
    }
    
    
</script>

<?php
    require('../../layout/main/foot.php');
?>