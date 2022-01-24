<?php
    require('../../../core/database.php');
    require('../../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Danh sách đổi thẻ cào - ".$JTech->setting('website_name');
    $required_datatable = true;

    require('../../../layout/admin/head.php');
    require('../../../layout/admin/sidebar.php');
?>

<div class="row">
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>USER</th>
                                <th>STATUS</th>
                                <th>TELCO</th>
                                <th>PIN</th>
                                <th>SERIAL</th>
                                <th>AMOUNT</th>
                                <th>REAL</th>
                                <th>RECIEVE</th>
                                <th>PARTNER</th>
                                <th>TIME</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                $card_query = $JTech->db_query("SELECT * FROM `card-data` ORDER BY `id` DESC ");
                                while($card = mysqli_fetch_assoc($card_query)) {
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <?= $card['username']; ?>
                                </td>
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
                                    <?= number_format($card['amount_real']); ?>đ
                                </td>
                                <td>
                                    <?= number_format($card['amount_recieve']); ?>đ
                                </td>
                                <td>
                                    <?php  if($card['partner_key'] == '') { ?>

                                        <span class="badge badge-danger">Không có</span>

                                    <?php }else{ ?>

                                        <button class="btn btn-primary btn-sm" onclick="$('#partner_<?= $card['id']; ?>').modal('show')">Thông tin</button>
                                    
                                    <?php } ?>
                                </td>
                                <td>
                                    <?= formatDate($card['created_time']); ?>
                                </td>
                            </tr>
                            <div class="modal" id="partner_<?= $card['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="partner_<?= $card['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="block block-rounded block-themed block-transparent mb-0">
                                            <div class="block-header bg-primary-dark">
                                                <h3 class="block-title">Thông tin đối tác</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" onclick="$('#partner_<?= $card['id']; ?>').modal('hide')" aria-label="Close">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="block-content">
                                                <div class="row">

                                                    <?php 
                                                        $info_partner = mysqli_fetch_assoc($JTech->db_query("SELECT * FROM `api-partner` WHERE `partner_key` = '".$card['partner_key']."' "));
                                                    ?>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Partner ID:</label>
                                                            <input type="text" class="form-control" readonly value="<?= $info_partner['partner_id']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Partner Key:</label>
                                                            <input type="text" class="form-control" readonly value="<?= $info_partner['partner_key']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Request ID:</label>
                                                            <input type="text" class="form-control" readonly value="<?= $card['request_id']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Callback URL:</label>
                                                            <input type="text" class="form-control" readonly value="<?= $card['callback']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Kết quả gọi về đối tác (<b class="text-danger">Callback Response</b>):</label>
                                                            <textarea class="form-control" cols="30" rows="5" readonly><?= $card['callback_response']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require('../../../layout/admin/foot.php');
?>