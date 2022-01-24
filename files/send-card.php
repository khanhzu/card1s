<?php

    function send_card($request_id, $telco, $pin, $serial, $amount) {

        $domain = "https://website.com"; // THAY THÀNH WEBSITE CẦN ĐẤU

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $domain.'/api/send-card?request_id='.$request_id.'&telco='.$telco.'&pin='.$pin.'&serial='.$serial.'&amount='.$amount,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'partner_id: YOUR_PARTNER_ID',
                'partner_key: YOUR_PARTNER_KEY'
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    $request_id = rand(200000, 900000); // CÓ THỂ SỬ DỤNG STRING
    $telco = "MOBIFONE";                //VIETTEL, VINAPHONE, MOBIFONE, VNMOBI, ZING, GATE
    $pin = "866369080664";              // MÃ THẺ
    $serial = "093842000012744";        // SỐ SERIAL
    $amount = 10000;                    // MỆNH GIÁ


    $data = send_card($request_id, $telco, $pin, $serial, $amount);

    if($data['status'] == 'success') {
        // Gửi thẻ lên hệ thống thành công
    }else{
        // Thất bại
        $message = $data['message'];
    }
