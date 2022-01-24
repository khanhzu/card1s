<?php
    if(isset($_GET['status']) && isset($_GET['request_id'])) {
        $status = $_GET['status'];
        $request_id = $_GET['request_id'];

        $telco = $_GET['telco']; // NHÀ MẠNG
        $pin = $_GET['pin']; // MÃ THẺ
        $serial = $_GET['serial']; // SERIAL
        $amount = intval($_GET['amount']); // MỆNH GIÁ GỬI
        $amount_real = intval($_GET['amount_real']); // MỆNH GIÁ THỰC
        $amount_recieve = intval($_GET['amount_recieve']); // SỐ TIỀN NHẬN ĐƯỢC

        if($status == 'success') {
            // Thẻ đúng
        } else if($status == 'wrong_amount') {
            // Sai mệnh giá
        } else if($status == 'fail') {
            // Thẻ sai
        }
    }
?>