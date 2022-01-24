-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 31, 2021 lúc 03:38 PM
-- Phiên bản máy phục vụ: 10.3.32-MariaDB-log-cll-lve
-- Phiên bản PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `todoicodesite_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api-partner`
--

CREATE TABLE `api-partner` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `partner_id` text NOT NULL,
  `partner_key` text NOT NULL,
  `callback_url` text NOT NULL,
  `status` text NOT NULL,
  `created_time` text NOT NULL,
  `last_used` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `auto-momo`
--

CREATE TABLE `auto-momo` (
  `id` int(11) NOT NULL,
  `mode` text NOT NULL,
  `username` text NOT NULL,
  `tranId` text NOT NULL,
  `partnerId` text NOT NULL,
  `partnerName` text NOT NULL,
  `amount` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_time` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `auto-zalo-pay`
--

CREATE TABLE `auto-zalo-pay` (
  `id` int(11) NOT NULL,
  `mode` text NOT NULL,
  `username` text NOT NULL,
  `transid` text NOT NULL,
  `owner` text NOT NULL,
  `amount` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_time` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank-users`
--

CREATE TABLE `bank-users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `key` text NOT NULL,
  `logo` text NOT NULL,
  `number_account` text NOT NULL,
  `owner` text NOT NULL,
  `bank_name` text NOT NULL,
  `branch` text NOT NULL,
  `noti` text NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buy-card-data`
--

CREATE TABLE `buy-card-data` (
  `id` int(11) NOT NULL,
  `order_code` text NOT NULL,
  `trace_3rd` text NOT NULL,
  `telco` text NOT NULL,
  `price` int(11) NOT NULL,
  `pin` text NOT NULL,
  `serial` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buy-card-order`
--

CREATE TABLE `buy-card-order` (
  `id` int(11) NOT NULL,
  `order_code` text NOT NULL,
  `username` text NOT NULL,
  `telco` text NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `card-data`
--

CREATE TABLE `card-data` (
  `id` int(11) NOT NULL,
  `server` text NOT NULL,
  `request_id` text NOT NULL,
  `partner_key` text NOT NULL,
  `username` text NOT NULL,
  `telco` text NOT NULL,
  `pin` text NOT NULL,
  `serial` text NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_real` int(11) NOT NULL,
  `amount_recieve` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `callback` text NOT NULL,
  `callback_response` longtext NOT NULL,
  `status` text NOT NULL,
  `created_time` text NOT NULL,
  `day` text NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `card-data`
--

INSERT INTO `card-data` (`id`, `server`, `request_id`, `partner_key`, `username`, `telco`, `pin`, `serial`, `amount`, `amount_real`, `amount_recieve`, `profit`, `callback`, `callback_response`, `status`, `created_time`, `day`, `month`, `year`) VALUES
(1, 'tcv', '98MZ0TUUU52', '', 'vhgamer2006', 'VIETTEL', '419768582049845', '10006100108765', 20000, 20000, 17400, 0, '', '', 'fail', '1640936073', '31', '12', '2021');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rank`
--

CREATE TABLE `rank` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `cash` int(11) NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`) VALUES
(1, 'description', 'Đại lý thẻ điện thoại Viettel, Vinaphone, Mobifone, thẻ game online Pubg, zing, Vcoin, Gate, Carot, Garena, Võ lâm, liên quân mobile.'),
(2, 'website_name', 'THECAOVIP'),
(3, 'og_image', ''),
(4, 'logo', ''),
(4, 'favicon', 'https://i.ibb.co/7R871Z6/Copy-of-Jzon-Tech.png'),
(5, 'email_admin', 'haidkgcf@gmail.com'),
(6, 'phone_admin', '0392603233'),
(7, 'social_admin', 'https://fb.com/haidkert'),
(8, 'nofication_home', '<h2><em><font style=\"background-color: rgb(255, 255, 0);\" color=\"#ff0000\">MÃ NGUỒN GACHTHE 1.0 - KingBone</font></em></h2>'),
(9, 'email_napthe365', 'email_here'),
(10, 'password_napthe365', 'password_here'),
(11, 'security_napthe365', 'security_here'),
(12, 'max_amount_buy_card', '10'),
(13, 'max_cash_transfer', '1000000000'),
(14, 'min_cash_transfer', '10000'),
(15, 'fee_cash_transfer', '100'),
(16, 'min_cash_withdraw', '10000'),
(17, 'max_cash_withdraw', '100000000'),
(18, 'fee_cash_withdraw', '100'),
(19, 'nofication_ex_card', '<h3>THÔNG BÁO ĐỔI THẺ SẼ ĐƯỢC HIỂN THỊ TẠI ĐÂY</h3><p>Mua mã nguồn này liên hệ ZALO 0392603233 (HỖ TRỢ 24/24)</p>'),
(20, 'server_ex_card', 'tcv'),
(21, 'partner_id', '3215545661'),
(22, 'partner_key', 'c7d5fb023695152d2bb11e75e10f7a30'),
(23, 'hotline', '0392603233'),
(25, 'facebook_url', 'https://fb.com/haidkert'),
(26, 'youtube_url', 'https://www.youtube.com/channel/UCYC6FjqQCFGPuwh5itJ_A0g'),
(27, 'website_url', 'webcuaban.com'),
(28, 'work_time', '8h30 - 22h'),
(29, 'info_url', 'https://fb.com/haidkert'),
(30, 'theme_mode', ''),
(31, 'momo_phone', '0382440207'),
(32, 'momo_owner', 'Tadvn'),
(33, 'momo_noti', 'Vui lòng nhập đúng nội dung khi chuyển khoản. Nạp xong IB FB ADMIN. phí 5,000d tránh rửa tiền!'),
(34, 'momo_token', 'token_here'),
(35, 'memo_mode', 'uid'),
(36, 'memo_name', 'GACHTHE '),
(37, 'zalo_token', 'token_here'),
(38, 'zalo_owner', 'PHAM DUC THANH'),
(39, 'zalo_phone', '0966142061'),
(40, 'zalo_noti', 'Vui lòng nhập đúng nội dung khi chuyển khoản. Nạp xong IB FB ADMIN. phí 5,000d tránh rửa tiền!'),
(41, 'recharge_fee', '100'),
(42, 'nofication_auth', 'no'),
(43, 'nofication_res_card', 'no'),
(44, 'nofication_buy_card', 'no'),
(45, 'nofication_topup', 'no'),
(46, 'nofication_recharge', 'no'),
(47, 'nofication_withdraw', 'no'),
(48, 'nofication_transfer', 'no'),
(49, 'nofication_api_partner', 'no'),
(50, 'nofication_callback', 'no'),
(51, 'tele_token', ''),
(52, 'tele_chatid', ''),
(53, 'code_log', '- Phiên bản 1.0 GACHTHE đã được ra mắt <br>\n- Hiện tại chưa có cập nhật, bạn hãy kiểm tra cập nhật thường xuyên nha ^^'),
(54, 'code_version', '1.0'),
(55, 'google_site_key', ''),
(56, 'google_secret_key', ''),
(57, 'reg_per_ip', '3'),
(57, 'hide_name_rank', 'yes'),
(58, 'plugin_script', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `telco-rate`
--

CREATE TABLE `telco-rate` (
  `id` int(11) NOT NULL,
  `telco` text NOT NULL,
  `name` text NOT NULL,
  `member_10000` float NOT NULL,
  `member_20000` float NOT NULL,
  `member_30000` float NOT NULL,
  `member_50000` float NOT NULL,
  `member_100000` float NOT NULL,
  `member_200000` float NOT NULL,
  `member_300000` float NOT NULL,
  `member_500000` float NOT NULL,
  `member_1000000` float NOT NULL,
  `vip_10000` float NOT NULL,
  `vip_20000` float NOT NULL,
  `vip_30000` float NOT NULL,
  `vip_50000` float NOT NULL,
  `vip_100000` float NOT NULL,
  `vip_200000` float NOT NULL,
  `vip_300000` float NOT NULL,
  `vip_500000` float NOT NULL,
  `vip_1000000` float NOT NULL,
  `agency_10000` float NOT NULL,
  `agency_20000` float NOT NULL,
  `agency_30000` float NOT NULL,
  `agency_50000` float NOT NULL,
  `agency_100000` float NOT NULL,
  `agency_200000` float NOT NULL,
  `agency_300000` float NOT NULL,
  `agency_500000` float NOT NULL,
  `agency_1000000` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `telco-rate`
--

INSERT INTO `telco-rate` (`id`, `telco`, `name`, `member_10000`, `member_20000`, `member_30000`, `member_50000`, `member_100000`, `member_200000`, `member_300000`, `member_500000`, `member_1000000`, `vip_10000`, `vip_20000`, `vip_30000`, `vip_50000`, `vip_100000`, `vip_200000`, `vip_300000`, `vip_500000`, `vip_1000000`, `agency_10000`, `agency_20000`, `agency_30000`, `agency_50000`, `agency_100000`, `agency_200000`, `agency_300000`, `agency_500000`, `agency_1000000`) VALUES
(1, 'VIETTEL', 'Viettel', 14, 13, 13, 12, 12, 13, 13, 15, 15, 12, 12, 12, 11, 11, 12, 12, 14, 14, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'VINAPHONE', 'Vinaphone', 13, 13, 13, 12, 12, 13, 13, 15, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'MOBIFONE', 'Mobifone', 10, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'VNMOBI', 'Vietnammobile', 10, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'ZING', 'Zing', 5, 1, 2, 3, 4, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'GATE', 'GATE', 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topup-mobile`
--

CREATE TABLE `topup-mobile` (
  `id` int(11) NOT NULL,
  `order_code` text NOT NULL,
  `username` text NOT NULL,
  `dial` text NOT NULL,
  `phone` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transfer-receipt`
--

CREATE TABLE `transfer-receipt` (
  `id` int(11) NOT NULL,
  `transaction_code` text NOT NULL,
  `sender` text NOT NULL,
  `reciever` text NOT NULL,
  `cash_original` int(11) NOT NULL,
  `cash_transfer` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `cash` int(11) NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `token` text NOT NULL,
  `rank` text NOT NULL,
  `admin` int(11) NOT NULL,
  `banned` int(11) NOT NULL,
  `2fa_code` text NOT NULL,
  `is_verify` tinyint(1) NOT NULL,
  `ip` text NOT NULL,
  `user_agent` text NOT NULL,
  `created_time` text NOT NULL,
  `last_access` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `cash`, `phone`, `email`, `token`, `rank`, `admin`, `banned`, `2fa_code`, `is_verify`, `ip`, `user_agent`, `created_time`, `last_access`) VALUES
(1, 'DucThanh', 'admin', 'a5681e42512c05fe038992b295ce68c8', 0, '', 'phamducthanhpubg@gmail.com', '4b9c61033435a632c825e70fd5e641febb943d998d3cbdb346', 'agency', 1, 0, '', 0, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36 OPR/78.0.4093.214', '1632498249', '1632499100'),
(2, 'Vũ Quốc Hải', 'vhgamer2006', 'df4e495a0e47c56c5e6dfecaa66f5822', 0, '', 'haidkgcf@gmail.com', 'a1e102b981091ff75e4c30d64e7d82d8bab4c18b4ec72a8bca', 'member', 1, 0, '', 0, '2405:4800:2714:6928:54b8:e1dd:91af:caa3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36', '1640935724', '1640936282');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `withdraw_code` text NOT NULL,
  `username` text NOT NULL,
  `bank_name` text NOT NULL,
  `owner` text NOT NULL,
  `number_account` text NOT NULL,
  `branch` text NOT NULL,
  `cash_original` int(11) NOT NULL,
  `cash_withdraw` int(11) NOT NULL,
  `status` text NOT NULL,
  `created_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `api-partner`
--
ALTER TABLE `api-partner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `auto-momo`
--
ALTER TABLE `auto-momo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `auto-zalo-pay`
--
ALTER TABLE `auto-zalo-pay`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bank-users`
--
ALTER TABLE `bank-users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `buy-card-data`
--
ALTER TABLE `buy-card-data`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `buy-card-order`
--
ALTER TABLE `buy-card-order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `card-data`
--
ALTER TABLE `card-data`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `telco-rate`
--
ALTER TABLE `telco-rate`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `topup-mobile`
--
ALTER TABLE `topup-mobile`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transfer-receipt`
--
ALTER TABLE `transfer-receipt`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `api-partner`
--
ALTER TABLE `api-partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `auto-momo`
--
ALTER TABLE `auto-momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `auto-zalo-pay`
--
ALTER TABLE `auto-zalo-pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bank-users`
--
ALTER TABLE `bank-users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `buy-card-data`
--
ALTER TABLE `buy-card-data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `buy-card-order`
--
ALTER TABLE `buy-card-order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `card-data`
--
ALTER TABLE `card-data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `rank`
--
ALTER TABLE `rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `telco-rate`
--
ALTER TABLE `telco-rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `topup-mobile`
--
ALTER TABLE `topup-mobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `transfer-receipt`
--
ALTER TABLE `transfer-receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
