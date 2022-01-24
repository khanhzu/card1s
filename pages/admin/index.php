<?php
    require('../../core/database.php');
    require('../../core/function.php');
    $JTech->checkToken('admin_page');

    $title = "Bảng điều khiển - ".$JTech->setting('website_name');
    $chart = true; 

    
    require('../../layout/admin/head.php');
    require('../../layout/admin/sidebar.php');
?>

<style>
    .j_text {
        font-size: 25px;
        font-weight: 700;
    }
    .fw-semibold {
        font-weight: 600!important;
    }
    .fs-5 {
        font-size: 1.125rem!important;
    }
    .mb-3 {
        margin-bottom: 1rem!important;
    }
    .fw-bold {
        font-weight: 700!important;
    }
    .fs-2 {
        font-size: calc(1.3125rem + .75vw)!important;
    }
    .highcharts-figure, .highcharts-data-table table {
        min-width: 360px; 
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>

<?php 
    // THỐNG KÊ THÔNG TIN

    # TỔNG THÀNH VIÊN
    $total_member = $JTech->db_num_rows("SELECT * FROM `users` ");
    # TỔNG SỐ DƯ THÀNH VIÊN
    $total_cash_member = mysqli_fetch_assoc($JTech->db_query("SELECT SUM(`cash`) FROM `users` "))['SUM(`cash`)'];
    # TỔNG ĐỐI TÁC API
    $total_partner = $JTech->db_num_rows("SELECT * FROM `api-partner` WHERE `status` = 'active' ");
    # TỔNG THẺ ĐỔI
    $total_ex_card = $JTech->db_num_rows("SELECT * FROM `card-data` ");
    # TỔNG THẺ THÀNH CÔNG
    $total_success_card = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `status` = 'success' ");
    # TỔNG THẺ SAI
    $total_fail_card = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `status` = 'fail' ");
    # TỔNG THẺ SAI MỆNH GIÁ
    $total_wrong_card = $JTech->db_num_rows("SELECT * FROM `card-data` WHERE `status` = 'wrong_amount' ");
    # TỔNG TIỀN ĐỔI THẺ THÀNH CÔNG
    $total_amount_card = mysqli_fetch_assoc($JTech->db_query("SELECT SUM(`amount_recieve`) FROM `card-data` WHERE `status` = 'success' "))['SUM(`amount_recieve`)'];
    # LỢI NHUẬN HÔM NAY
    $profit_today = mysqli_fetch_assoc($JTech->db_query("SELECT SUM(`profit`) FROM `card-data` WHERE `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' AND `status` = 'success' "))['SUM(`profit`)'];
    # LỢI NHUẬN TUẦN NÀY
    $profit_week = mysqli_fetch_assoc($JTech->db_query("SELECT SUM(`profit`) FROM `card-data` WHERE WEEK(DATE_FORMAT(FROM_UNIXTIME(`created_time`), '%Y-%m-%d')) = WEEK(NOW()) "))['SUM(`profit`)'];
    # LỢI NHUẬN THÁNG NAY
    $profit_month = mysqli_fetch_assoc($JTech->db_query("SELECT SUM(`profit`) FROM `card-data` WHERE `month` = '".date('m')."' AND `year` = '".date('Y')."' AND `status` = 'success' "))['SUM(`profit`)'];
?>

<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Bảng điều khiển</h2>
</div>
<div class="row">
    <div class="col-md-4 d-flex flex-column">
        <div class="block block-rounded">
            <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
                <div class="me-3">
                    <p class="fs-3 fw-bold mb-0 j_text">
                        <?= number_format($total_member); ?>
                    </p>
                    <p class="text-muted mb-0">
                        Tổng thành viên
                    </p>
                </div>
                <div class="item rounded-circle bg-body">
                    <i class="fa fa-users fa-lg text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 d-flex flex-column">
        <div class="block block-rounded">
            <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
                <div class="me-3">
                    <p class="fs-3 fw-bold mb-0 j_text">
                        <?= number_format($total_cash_member); ?>
                    </p>
                    <p class="text-muted mb-0">
                        Tổng số dư thành viên
                    </p>
                </div>
                <div class="item rounded-circle bg-body">
                    <i class="fa fa-dollar-sign fa-lg text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 d-flex flex-column">
        <div class="block block-rounded">
            <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
                <div class="me-3">
                    <p class="fs-3 fw-bold mb-0 j_text">
                        <?= number_format($total_partner); ?>
                    </p>
                    <p class="text-muted mb-0">
                        Tổng đối tác API
                    </p>
                </div>
                <div class="item rounded-circle bg-body">
                    <i class="fa fa-laptop-code fa-lg text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 d-flex flex-column">
        <div class="block block-rounded">
            <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
                <div class="me-3">
                    <p class="fs-3 fw-bold mb-0 j_text">
                        <?= number_format($total_ex_card); ?>
                    </p>
                    <p class="text-muted mb-0">
                        Số thẻ đổi
                    </p>
                </div>
                <div class="item rounded-circle bg-body">
                    <i class="fa fa-asterisk fa-lg text-secondary"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 d-flex flex-column">
        <div class="block block-rounded">
            <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
                <div class="me-3">
                    <p class="fs-3 fw-bold mb-0 j_text">
                        <?= number_format($total_success_card); ?>
                    </p>
                    <p class="text-muted mb-0">
                        Số thẻ thành công
                    </p>
                </div>
                <div class="item rounded-circle bg-body">
                    <i class="fa fa-check fa-lg text-success"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 d-flex flex-column">
        <div class="block block-rounded">
            <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
                <div class="me-3">
                    <p class="fs-3 fw-bold mb-0 j_text">
                        <?= number_format($total_fail_card); ?>
                    </p>
                    <p class="text-muted mb-0">
                        Số thẻ sai
                    </p>
                </div>
                <div class="item rounded-circle bg-body">
                    <i class="fa fa-times fa-lg text-danger"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 d-flex flex-column">
        <div class="block block-rounded">
            <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
                <div class="me-3">
                    <p class="fs-3 fw-bold mb-0 j_text">
                        <?= number_format($total_wrong_card); ?>
                    </p>
                    <p class="text-muted mb-0">
                        Số thẻ sai mệnh giá
                    </p>
                </div>
                <div class="item rounded-circle bg-body">
                    <i class="fa fa-sort-numeric-up fa-lg text-info"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3" style="margin-bottom: 10px;">
        <a class="block block-rounded block-fx-pop h-100 mb-0" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="fs-5 fw-semibold text-muted mb-3">Tổng tiền đổi thẻ</div>
                <div class="fs-2 fw-bold"><?= number_format($total_amount_card); ?></div>
            </div>
        </a>
    </div>

    <div class="col-6 col-lg-3" style="margin-bottom: 10px;">
        <a class="block block-rounded block-fx-pop h-100 mb-0" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="fs-5 fw-semibold text-muted mb-3">Lợi nhuận hôm nay</div>
                <div class="fs-2 fw-bold"><?= number_format($profit_today); ?></div>
            </div>
        </a>
    </div>

    <div class="col-6 col-lg-3" style="margin-bottom: 10px;">
        <a class="block block-rounded block-fx-pop h-100 mb-0" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="fs-5 fw-semibold text-muted mb-3">Lợi nhuận tuần</div>
                <div class="fs-2 fw-bold"><?= number_format($profit_week); ?></div>
            </div>
        </a>
    </div>

    <div class="col-6 col-lg-3" style="margin-bottom: 10px;">
        <a class="block block-rounded block-fx-pop h-100 mb-0" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="fs-5 fw-semibold text-muted mb-3">Lợi nhuận tháng</div>
                <div class="fs-2 fw-bold"><?= number_format($profit_month); ?></div>
            </div>
        </a>
    </div>

    <div class="col-lg-12" style="margin-top: 20px;">
        <div class="block block-rounded">
            <div class="block-content">
                <h4 class="text-center">Thống kê nhà mạng sử dụng</h4>
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
        </div>
    </div>

</div>

<script>
    Highcharts.chart("container", {
        chart: {
            type: 'column',
            spacingBottom: 15,
            spacingTop: 20,
            spacingLeft: 5,
            spacingRight: 15,
            borderWidth: 1,
            borderColor: '#ddd'
        },

        title: {
            text: ''
        },
        legend: {
            padding: 0,
            margin: 5
        },
        yAxis: {
            title: {
                text: 'DANH SÁCH NHÀ MẠNG'
            }
        },
        credits: {
            enabled: true
        },
        tooltip: {
            enabled: false
        },
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true,
                    crop: false,
                    overflow: 'none'
                }
            }
        },
        loading: {
            labelStyle: {
                top: '35%',
                fontSize: "2em"
            }
        },
        xAxis: {
            categories: ["VIETTEL", "VINAPHONE", "MOBIFONE", "VIETNAMMOBILE", "ZING", "GATE"]
        },
        series: [{
            "name": "Dữ liệu nhà mạng",
            "data": [{
                "y": <?= total_card('VIETTEL'); ?>
            }, {
                "y": <?= total_card('VINAPHONE'); ?>
            }, {
                "y": <?= total_card('MOBIFONE'); ?>
            }, {
                "y": <?= total_card('VNMOBI'); ?>
            }, {
                "y": <?= total_card('ZING'); ?>
            }, {
                "y": <?= total_card('GATE'); ?>
            }]
        }],
        credits: {
            enabled: false
        },
    });

</script>
<?php
    require('../../layout/admin/foot.php');
?>