<?php
    require('../../../core/database.php');
    require('../../../core/function.php');

    if(isset($_POST['telco'])) {
        $telco = xss($_POST['telco']);

        $api = curlGet("https://napthe365.com/user/GetListCardTypeByProviderId?PrividerId=".getProviderID($telco));
        $data = json_decode($api, true);

        if($data['Success'] === true) {
            echo '<div class="row text-center">';
            foreach($data['data'] as $card) {
                echo '<div class="col-md-3 col-6" style="margin-bottom: 15px;">
                        <a class="btn btn-alt-secondary btn-price btn-lg btn-block text-danger" data-price="'.$card['Amount'].'" onclick="selectPrice(this)">
                            '.$card['CardName'].'
                        </a>
                    </div>';
            }
            echo '</div>';
            echo '<div class="row" style="margin-bottom: 20px;">
            <div class="col-6 text-left">
                Số lượng
            </div>
            <div class="col-6 text-right">
                <table style="float: right;">
                    <tr>
                        <td>
                            <button type="button" class="btn btn-rounded btn-hero-secondary btn-sm" data-toggle="click-ripple" id="decrease_btn" style="margin-right: 10px;" onclick="decreaseAmount()">
                                <i class="fas fa-minus"></i>
                            </button>
                        </td>
                        <td>
                            <input class="form-control form-control-alt" style="width: 50px;text-align: center!important;" id="amount_box" value="1" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-rounded btn-hero-secondary btn-sm" data-toggle="click-ripple" id="increase_btn" style="margin-left: 10px;" onclick="increaseAmount()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>';
        }else{
            echo '<div class="text-center">
                <h4 class="text-danger">Lỗi máy chủ, vui lòng liên hệ admin</h4>
            </div>';
        }
    }

?>