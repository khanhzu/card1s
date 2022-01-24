<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Danh sách thành viên - ".$JTech->setting('website_name');
    $required_datatable = true;

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>
<div class="row">
    <?php if(!isset($_GET['detail'])) { ?>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>USER</th>
                                <th>SỐ DƯ</th>
                                <th>SỐ ĐT</th>
                                <th>EMAIL</th>
                                <th>RANK</th>
                                <th>THỜI GIAN TẠO</th>
                                <th>LẦN CUỐI</th>
                                <th>THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = $JTech->db_query("SELECT * FROM `users` ORDER BY `id` DESC ");
                                while($row = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <td style="font-weight: bold;">
                                    <span class="text-danger"><?= $row['id']; ?></span>
                                </td>
                                <td>
                                    <?= $row['full_name']; ?> <br>
                                    <span class="text-muted"><?= $row['username']; ?></span>
                                </td>
                                <td>
                                    <?= number_format($row['cash']); ?>đ
                                </td>
                                <td>
                                    <?php
                                        if($row['phone'] == '') {
                                            echo '<span class="badge badge-danger">CHƯA CẬP NHẬT</span>';
                                        }else{
                                            echo '<span class="badge badge-info">'.$row['phone'].'</span>';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($row['email'] == '') {
                                            echo '<span class="badge badge-danger">CHƯA CẬP NHẬT</span>';
                                        }else{
                                            echo '<span class="badge badge-success">'.$row['email'].'</span>';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(typeRank($row['rank']) == '') {
                                            echo 'Thành viên';
                                        }else{
                                            echo typeRank($row['rank']);
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?= formatDate($row['created_time']); ?>
                                </td>
                                <td>
                                    <?= formatDate($row['last_access']); ?>
                                </td>

                                <td>
                                    <a class="btn btn-primary btn-sm" href="?detail=<?= $row['id']; ?>"><i class="fas fa-eye"></i> CHI TIẾT</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php 
        } else { 
            require('../detail/member.php');
        }
    ?>
</div>
<?php
    require('../../../layout/admin/foot.php');
?>