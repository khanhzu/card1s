<?php
    require('../../core/database.php');
    require('../../core/function.php');

    $title = "TÀI LIỆU API - ".$JTech->setting('website_name');
    $code_bg = true;

    require('../../layout/main/head.php');
    require('../../layout/main/navbar.php');

    $JTech->checkToken('client');
?>
<style>
    .icon_method {
        margin-right: 10px;
    }

    .url_handle {
        display: inline-block;
        word-break: break-all;
        border: 1px solid rgb(230, 230, 230);
        padding: 6px 10px;
        border-radius: 3px;
        font-size: 12px;
        color: rgb(40, 40, 40);
        background-color: rgb(248, 248, 248);
        margin: 5px 0px 15px;
        width: 100%;
    }
    .bungkus-down {
        color: #fff;
        padding: 10px 23px;
        overflow: hidden;
        display: block;
        border-radius: 5px;
        background: linear-gradient(to right, #b92b27, #1565c0);
    }

    
    @media only screen and (max-width: 600px) {
        .file-info {
            display: block;
            text-align: center!important;
        }
        .mt-jz {
            margin-top: 30px;
        }
        #btn, a#download {
            width: 100%;
        }
    }

    .file-info {
        color: #fff;
        display: inline-block;
        line-height: 21px;
        text-align: left;
    }

    #btn {
        -webkit-transition: 0.5s;
        cursor: pointer;
        padding: 13px 0;
        border: none;
        border-radius: 3px;
        background: #fff0;
        color: #3295b2;
        float: right;
        font-weight: 700;
    }

    a#download {
        -webkit-transition: 0.5s;
        padding: 10px 20px;
        border-radius: 3px;
        background: #fff;
        color: #3294b3;
        float: right;
        text-transform: uppercase;
        font-weight: 700;
        text-align: center;
    }

    a#download:hover {
        border-radius: 31px;
        background: #000;
        color: #fff;
    }

    .row {
        word-break: break-all;
    }
</style>

<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Tài liệu API</h2>
</div>
<div class="row">
    <div class="col-lg-12" style="margin-bottom: 20px;">
        <div class="bungkus-down">
            <div class="embuh">
                <div class="file-info">
                    <br />
                    <div><i class="fas fa-file-code"></i> Hướng dẫn tích hợp code PHP <i class="fas fa-chevron-circle-right"></i></div>
                </div>
                <button id="btn">
                    <a href="/files/example_php.zip" id="download" target="_blank"><i class="fas fa-cloud-download-alt"></i> Tải Về</a>
                </button>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"><span class="badge badge-success icon_method">GET</span> GỬI THẺ LÊN HỆ THỐNG</h3>
            </div>
            <div class="block-content">
                <div class="form-group">
                    <label>Đường dẫn mẫu:</label>
                    <div class="form-group">
                        <div class="url_handle">
                            https://<?= $_SERVER['SERVER_NAME']; ?>/api/send-card?request_id=123456&telco=MOBIFONE&pin=866369080664&serial=093842000012744&amount=10000
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <div style="margin-bottom: 30px;">
                            <label>HEADERS:</label>
                            <div style="border-bottom: 1px solid rgb(236, 236, 236); margin-bottom: 13px;"></div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    partner_id
                                </div>
                                <div class="col-8">
                                    Partner ID
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    partner_key
                                </div>
                                <div class="col-8">
                                    Partner Key
                                </div>
                            </div>
                        </div>
                        <div>
                            <label>PARAMS:</label>
                            <div style="border-bottom: 1px solid rgb(236, 236, 236); margin-bottom: 13px;"></div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    request_id
                                </div>
                                <div class="col-8">
                                    123456
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    telco
                                </div>
                                <div class="col-8">
                                    <small>VIETTEL, VINAPHONE, MOBIFONE, VNMOBI, ZING, GATE</small>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    pin
                                </div>
                                <div class="col-8">
                                    866369080664
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    serial
                                </div>
                                <div class="col-8">
                                    093842000012744
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    amount
                                </div>
                                <div class="col-8">
                                    10000
                                </div>
                            </div>
                        </div>
                            
                    </div>
                    <div class="col-md-6 mt-jz">
                        <label>Kết quả mẫu:</label>
                        <div style="border-bottom: 1px solid rgb(236, 236, 236); margin-bottom: 13px;"></div>
                        <pre><code class="json">{
    "status": "success / fail",
    "message": "Custom message"
}</code></pre>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"><span class="badge badge-success icon_method">GET</span> KẾT QUẢ GỬI VÀO CALLBACK</h3>
            </div>
            <div class="block-content">
                <div class="form-group">
                    <label>Đường dẫn mẫu:</label>
                    <div class="form-group">
                        <div class="url_handle">
                            https://example.com/charge/callback?status=success&request_id=123456&telco=MOBIFONE&pin=866369080664&serial=093842000012744&amount=100000&amount_real=100000&amount_recieve=90000
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <div>
                            <label>PARAMS:</label>
                            <div style="border-bottom: 1px solid rgb(236, 236, 236); margin-bottom: 13px;"></div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    status
                                </div>
                                <div class="col-8">
                                    <b class="text-success">success</b>, <b class="text-danger">fail</b>, <b class="text-info">wrong_amount</b>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    request_id
                                </div>
                                <div class="col-8">
                                    123456
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    telco
                                </div>
                                <div class="col-8">
                                    MOBIFONE
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    pin
                                </div>
                                <div class="col-8">
                                    866369080664
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    serial
                                </div>
                                <div class="col-8">
                                    093842000012744
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    amount
                                </div>
                                <div class="col-8">
                                    100000 (Mệnh giá gửi lên)
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    amount_real
                                </div>
                                <div class="col-8">
                                    100000 (Mệnh giá thực)
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-4" style="font-weight: bold;">
                                    amount_recieve
                                </div>
                                <div class="col-8">
                                    90000 (Số tiền nhận được)
                                </div>
                            </div>
                        </div>
                            
                    </div>
                    <div class="col-md-6 mt-jz">
                        <label>Kết quả mẫu:</label>
                        <div style="border-bottom: 1px solid rgb(236, 236, 236); margin-bottom: 13px;"></div>
                        <pre><code class="json">{
    "status": "success",
    "request_id": "123456",
    "telco": "MOBIFONE",
    "pin": "866369080664",
    "serial": "093842000012744",
    "amount": "100000",
    "amount_real": "100000",
    "amount_recieve": "90000"
}</code></pre>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require('../../layout/main/foot.php');
?>