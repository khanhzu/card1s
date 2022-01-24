<?php
    $id = intval($_GET['detail']);
    $info = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `withdraw` WHERE `id` = '$id' "));
    if(!$info) {
        echo '<h1 style="margin: 0 auto;" class="text-danger">Không tìm thấy đơn rút tiền</h1>';
    }else{
        $title_new = "Chi tiết rút tiền #".$id." - ".$JTech->setting('website_name');
?>
<div class="col-md-12">
    <div class="block block-rounded">
        <div class="block-content">
            <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/list/withdraw.php" href="<?= FULL_URL('/admin/list/withdraw?detail='.$id); ?>" method="POST">
                <input type="hidden" value="<?= $info['id']; ?>" name="id" />
                <div class="form-group">
                    <label for="">Mã đơn:</label>
                    <input type="text" class="form-control" value="<?= $info['withdraw_code']; ?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="">Tên ngân hàng:</label>
                    <select class="js-select2 form-control" id="example-select2" name="bank_name" style="width: 100%;" data-placeholder="Chọn ngân hàng">
                        <?php
                            foreach (bank_data() as $key => $value) {
                        ?>
                        <option value="<?= $key; ?>" <?php if($key == $info['bank_name']) echo 'selected'; ?>><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Chủ tài khoản:</label>
                    <input type="text" class="form-control" value="<?= $info['owner']; ?>" name="owner" />
                </div>
                <div class="form-group">
                    <label for="">Số tài khoản:</label>
                    <input type="text" class="form-control" value="<?= $info['number_account']; ?>" name="number_account" />
                </div>
                <div class="form-group">
                    <label for="">Chi nhánh:</label>
                    <input type="text" class="form-control" value="<?= $info['branch']; ?>" name="branch" />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Số tiền gốc:</label>
                            <input type="text" class="form-control" value="<?= $info['cash_original']; ?>" readonly/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Số tiền rút (<b class="text-danger">đã trừ phí</b>):</label>
                            <input type="text" class="form-control" value="<?= $info['cash_withdraw']; ?>" readonly/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái:</label>
                    <select name="status" class="form-control">
                        <option value="wait" <?php if($info['status'] == 'wait') echo 'selected'; ?> >Chờ duyệt</option>
                        <option value="success" <?php if($info['status'] == 'success') echo 'selected'; ?>>Thành công</option>
                        <option value="cancel" <?php if($info['status'] == 'cancel') echo 'selected'; ?>>Đã hủy</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" href="<?= FULL_URL('/admin/list/withdraw?detail='.$id); ?>" class="btn btn-hero-primary btn-block">LƯU THAY ĐỔI</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>