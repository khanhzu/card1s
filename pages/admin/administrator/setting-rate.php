<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Cài đặt chiết khấu - ".$JTech->setting('website_name');

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Cấp bậc <span class="badge badge-info">THÀNH VIÊN</span></h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/administrator/setting-rate.php"  method="POST">

                    <input type="hidden" value="member" name="rank">

                    <div class="form-group">
                        <label>Nhà mạng:</label>
                        <select class="form-control" name="telco" data-rank="member" onchange="loadRate(this)">
                            <option value="">-- CHỌN NHÀ MẠNG --</option>
                            <?php
                                $telco_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                                while($telco = mysqli_fetch_assoc($telco_query)) {
                            ?>
                            <option value="<?= $telco['telco']; ?>"><?= $telco['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 10.000đ</label>
                                <input class="form-control" name="member_10000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 20.000đ</label>
                                <input class="form-control" name="member_20000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 30.000đ</label>
                                <input class="form-control" name="member_30000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 50.000đ</label>
                                <input class="form-control" name="member_50000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 100.000đ</label>
                                <input class="form-control" name="member_100000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 200.000đ</label>
                                <input class="form-control" name="member_200000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 300.000đ</label>
                                <input class="form-control" name="member_300000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 500.000đ</label>
                                <input class="form-control" name="member_500000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 1.000.000đ</label>
                                <input class="form-control" name="member_1000000" type="number" step="any">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" >Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Cấp bậc <span class="badge badge-warning">VIP</span></h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/administrator/setting-rate.php"  method="POST">

                    <input type="hidden" value="vip" name="rank">

                    <div class="form-group">
                        <label>Nhà mạng:</label>
                        <select class="form-control" name="telco" data-rank="vip" onchange="loadRate(this)">
                            <option value="">-- CHỌN NHÀ MẠNG --</option>
                            <?php
                                $telco_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                                while($telco = mysqli_fetch_assoc($telco_query)) {
                            ?>
                            <option value="<?= $telco['telco']; ?>"><?= $telco['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 10.000đ</label>
                                <input class="form-control" name="vip_10000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 20.000đ</label>
                                <input class="form-control" name="vip_20000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 30.000đ</label>
                                <input class="form-control" name="vip_30000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 50.000đ</label>
                                <input class="form-control" name="vip_50000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 100.000đ</label>
                                <input class="form-control" name="vip_100000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 200.000đ</label>
                                <input class="form-control" name="vip_200000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 300.000đ</label>
                                <input class="form-control" name="vip_300000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 500.000đ</label>
                                <input class="form-control" name="vip_500000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 1.000.000đ</label>
                                <input class="form-control" name="vip_1000000" type="number" step="any">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" >Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Cấp bậc <span class="badge badge-danger">ĐẠI LÝ</span></h3>
            </div>
            <div class="block-content">
                <form submit-ajax="jtech" action="https://<?= $_SERVER['SERVER_NAME']; ?>/ajaxs/admin/administrator/setting-rate.php"  method="POST">

                    <input type="hidden" value="agency" name="rank">

                    <div class="form-group">
                        <label>Nhà mạng:</label>
                        <select class="form-control" name="telco" data-rank="agency" onchange="loadRate(this)">
                            <option value="">-- CHỌN NHÀ MẠNG --</option>
                            <?php
                                $telco_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                                while($telco = mysqli_fetch_assoc($telco_query)) {
                            ?>
                            <option value="<?= $telco['telco']; ?>"><?= $telco['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 10.000đ</label>
                                <input class="form-control" name="agency_10000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 20.000đ</label>
                                <input class="form-control" name="agency_20000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 30.000đ</label>
                                <input class="form-control" name="agency_30000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 50.000đ</label>
                                <input class="form-control" name="agency_50000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 100.000đ</label>
                                <input class="form-control" name="agency_100000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 200.000đ</label>
                                <input class="form-control" name="agency_200000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 300.000đ</label>
                                <input class="form-control" name="agency_300000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 500.000đ</label>
                                <input class="form-control" name="agency_500000" type="number" step="any">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CK 1.000.000đ</label>
                                <input class="form-control" name="agency_1000000" type="number" step="any">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" >Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function loadRate(data) {
        var rank = $(data).attr('data-rank')
        var telco = $(data).val()
        $.ajax({
            type: "POST",
            url: "/ajaxs/admin/action/load-rate.php",
            data: {
                rank,
                telco
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
                    $("input[name='" + rank + "_10000']").val(res.v_10000)
                    $("input[name='" + rank + "_20000']").val(res.v_20000)
                    $("input[name='" + rank + "_30000']").val(res.v_30000)
                    $("input[name='" + rank + "_50000']").val(res.v_50000)
                    $("input[name='" + rank + "_100000']").val(res.v_100000)
                    $("input[name='" + rank + "_200000']").val(res.v_200000)
                    $("input[name='" + rank + "_300000']").val(res.v_300000)
                    $("input[name='" + rank + "_500000']").val(res.v_500000)
                    $("input[name='" + rank + "_1000000']").val(res.v_1000000)
                }else{
                    swal(res.message, "error")
                }
            }
        });
    }
</script>   
<?php
    require('../../../layout/admin/foot.php');
?>