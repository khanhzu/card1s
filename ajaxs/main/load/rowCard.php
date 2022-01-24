<?php
    require('../../../core/database.php');
    require('../../../core/function.php');

    $code = md5(rand_string(10));
?>
<div class="row form_card" data-row="<?= $code; ?>">
    <div class="col-sm-3">
        <select class="form-control telco" data-row="<?= $code; ?>" onchange="telco_select(this)">
            <?php
                $telco_query = $JTech->db_query("SELECT * FROM `telco-rate` ");
                while($telco = mysqli_fetch_assoc($telco_query)) {
            ?>
            <option value="<?= $telco['telco']; ?>"><?= $telco['name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-sm-3">
        <input class="form-control pin" placeholder="Mã thẻ" data-row="<?= $code; ?>">
    </div>
    <div class="col-sm-3">
        <input class="form-control serial" placeholder="Số serial" data-row="<?= $code; ?>">
    </div>
    <div class="col-sm-2">
        <select class="form-control amount" data-row="<?= $code; ?>" onchange="total_receive(this)">
            <option value="">-- Mệnh giá --</option>
            <?php
                foreach (amount_data() as $key => $value) {
            ?>
            <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-sm-1">
        <a class="btn btn-danger btn-sm btn-action" onclick="removeChild__('<?= $code; ?>')"><i class="fas fa-trash"></i></a>
    </div>
</div>