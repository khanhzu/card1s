<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "TOP ĐỔI THẺ - ".$JTech->setting('website_name');

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
    $limitTop = 10; // CUSTOM RANK
    
?>
<style>
    @media screen and (min-width: 800px) {
        .center_desktop {
            margin-left: 25%;
        }
    }
</style>
<div style="margin-bottom: 20px;">
    <h2 class="h3 mb-0 text-center" style="font-weight: bold;">Top <?= $limitTop; ?> thành viên nạp tháng <?= date('m'); ?></h2>
</div>
<div class="row">
    <div class="col-lg-6 center_desktop">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-borderless table-vcenter fs-sm text-center">
                        <thead>
                            <tr>
                                <th>THỨ HẠNG</th>
                                <th>NGƯỜI DÙNG</th>
                                <th>TỔNG TIỀN</th>
                            </tr>
                        </thead>
                        <tbody style="font-weight: bold;">
                            <?php
                                $i = 1;
                                $query = $JTech->db_query("SELECT * FROM `rank` ORDER BY `cash` DESC LIMIT 0, $limitTop ");
                                while($top = mysqli_fetch_assoc($query)) { 
                            ?>

                                <tr>
                                    <td >
                                        <?= $i; ?>
                                    </td>
                                    <td class="text-danger">
                                        <?= show_name_rank($top['username']); ?>
                                    </td>
                                    <td class="text-primary">
                                        <?= number_format($top['cash']); ?>đ
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require('../../layout/main/foot.php');
?>