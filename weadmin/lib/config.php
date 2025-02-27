<?php
date_default_timezone_set('Asia/Bangkok');
// ini_set('memory_limit', '128M');
// ini_set('upload_max_filesize', '128M');
// ini_set('post_max_size', '128M');
// ini_set('max_file_uploads', '128M');

## nut add 01/03/17 ##
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(1);
## Core Folder Local  ######################################################
$core_pathname_folderlocal = "dev22-git/";

## Core Upload  ######################################################
$core_pathname_upload = "../../upload";
$core_pathname_upload_fornt = "upload";
$core_pathname_mupload = "../core/upload/";
$core_pathname_logs = "../../logs";
$core_pathname_crupload = "../../upload/core";

## Core Path RSS  ##################################################
$core_session_language = $_SESSION[$valSiteManage . 'core_session_language'];

$core_fullpath_rss = "https://" . $_SERVER["HTTP_HOST"] . "" . $core_pathname_folderlocal . "/upload";
$core_variable_charset = "UTF-8";
$core_relativepath_rss = "../../rss";

## Core Path Name  ##################################################
$core_full_path = "https://" . $_SERVER["HTTP_HOST"] . "" . $core_pathname_folderlocal;

## Core Path SQL Language ##################################################
$coreLanguageSQL = "mysqli";

## Core Table  ######################################################
$core_tb_staff = "sy_stf";
$core_tb_menu = "sy_mnu";
$core_tb_group = "sy_grp";
$core_tb_permission = "sy_mis";
$core_tb_box = "sy_box";
$core_tb_search = "sy_sea";
$core_tb_log = "sy_logs";
$core_tb_sort = "sy_stm";
$core_tb_setting = "sy_stt";
$core_tb_usercar = "md_srd";
$core_tb_service = "md_srs";
$core_tb_user = "sy_usr";

## Other Table  ######################################################
$other_tb_geography = "ot_geo";
$other_tb_province = "ot_pro";
$other_tb_amphur = "ot_amp";
$other_tb_district = "ot_dis";
$other_tb_nation = "ot_nat";

## Core Icon  ######################################################
$core_icon_columnsize = 15;
$core_icon_maxsize = 75;
$core_icon_librarypath = "../img/iconmenu";

## Database Connect #################################################
// CORE_ENV จะไป config ต่อที่ connect.php
$GET_ENV = file_get_contents(str_replace("\\", '/', dirname(__FILE__)).'/webservice_json/env.json');
$_ENV = json_decode($GET_ENV, true); // json decode from web service
$CORE_ENV = 'DEV';

$core_db_charecter_set = array(
    'charset' => "utf8",
    'collation' => "utf8_general_ci"
);


## Core Val Setting #############################################
$toolEditorStyle = "ToolbarAll";
$core_default_pagesize = 15;
$core_default_maxpage = 15;
$core_default_reduce = 10;
$core_sort_number = "DESC";
$core_height_leftmenu = 40;

## Core Language #############################################
$coreLanguageThai = "Thai";
$coreLanguageEng = "Eng";

## Core Email #############################################
$core_send_email = "info@unimit.com";
$core_goto_email = "info@unimit.com";

## Core Value #############################################
$coreMonthMem = array("-", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
$coreMonthMemEng = array("-", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$coreTxtSexMember = array("", "ชาย", "หญิง");
$coreTxtSexMemberEn = array("", "Male", "Female");
$core_config_val = 0;
$core_config_transportation = 100;

## Core Theme #############################################
$core_main_theme = array(
    0 => array("color" => "#e74962", "theme" => "theme.css"),
    1 => array("color" => "#e3a224", "theme" => "theme2.css"),
    2 => array("color" => "#d73f92", "theme" => "theme3.css"),
    3 => array("color" => "#c1243f", "theme" => "theme4.css"),
    4 => array("color" => "#04a351", "theme" => "theme5.css"),
    5 => array("color" => "#8c4e9b", "theme" => "theme6.css"),
    6 => array("color" => "#f3403c", "theme" => "theme7.css"),
    7 => array("color" => "#ee1820", "theme" => "theme8.css"),
    8 => array("color" => "#93c765", "theme" => "theme9.css"),
    9 => array("color" => "#e27e30", "theme" => "theme10.css")
);
$colorpatten = array("#e6e6e6", "#f46b23", "#ffb400", "#e7352b", "#8d42a1", "#3853d8", "#20a5ea", "#5cb328", "#7c5e4c", "#484848", "#01d2f9", "#7f8c8d");


## Core path nopic #############################################
$core_nopic_fb = "images/nopic/nopic_fb.jpg";
$core_nopic_tg = "images/nopic/nopic_tg.jpg";
$core_nopic_tr_large = "images/nopic/nopic_tr_large.jpg";
$core_nopic_bn = "images/nopic/nopic_bn.jpg";
$core_nopic_country = "images/nopic/nopic_country.jpg";
$core_nopic_map = "images/nopic/nopic_map.jpg";
$core_nopic_tr = "images/nopic/nopic_tr.jpg";


## Core Value Mail #############################################
$core_default_typemail = 1;

$mod_db_menu = "md_menu";
$mod_db_menu_group = "md_menug";

$modTxtSetLang = array ("Thai", "English", "China");

?>
