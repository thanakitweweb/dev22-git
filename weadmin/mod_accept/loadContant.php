<?php
include "../lib/session.php";
include "../lib/config.php";
include "../lib/connect.php";
include "../lib/function.php";
include "../core/incLang.php";
include "config.php";
include "incModLang.php";
// print_pre($_SERVER);
$valNav1 = $langTxt["nav:home2"];
$valLinkNav1 = "../core/index.php";
$valNav2 = getNameMenu($_REQUEST["menukeyid"]);
$valPermission = getUserPermissionOnMenu($_SESSION[$valSiteManage . "core_session_groupid"], $_REQUEST["menukeyid"]);
?>


  <script type="text/javascript" language="javascript">
    function changeRibbon(tablename, statusname, statusid, fileAc) {

      jQuery.blockUI({
        message: jQuery('#tallContent'),
        css: {
          border: 'none',
          padding: '35px',
          backgroundColor: '#000',
          '-webkit-border-radius': '10px',
          '-moz-border-radius': '10px',
          opacity: .9,
          color: '#fff'
        }
      });

      var pin = document.getElementById("inputRibbon").value;
      var TYPE = "POST";
      var URL = fileAc;
      var dataSet = {
        Valuetablename: tablename,
        Valuestatusname: pin,
        Valuestatusid: statusid,
        Valuefilestatus: fileAc
      };


      jQuery.ajax({
        type: TYPE,
        url: URL,
        data: dataSet,
        success: function(html) {

          // jQuery("#" + loadderstatus + "").show();
          // jQuery("#" + loadderstatus + "").html(html)
          setTimeout(jQuery.unblockUI, 200);
        }
      });
    }
  </script>

  <script type="text/javascript" language="javascript">
    // var value = $('.token').data('token');
    // var valtoken = $('.valtoken').text(value);

    $(document).on("click", ".token", function () {
        var value = $(this).data('token');
        $(".modal-body #myInputToken.valtoken").val( value );
    });

    function CopyToken(){
      /* Get the text field */
        var copyText = document.getElementById("myInputToken");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      /* Copy the text inside the text field */
      document.execCommand("copy");

      /* Alert the copied text */
      // alert("Copied the text: " + copyText.value);

      $('#myModal').modal('hide');
    }
  </script>

  <script type="text/javascript" language="javascript">
    // var value = $('.secretkey').data('secretkey');
    // var valtoken = $('.valsecretkey').text(value);

    $(document).on("click", ".secretkey", function () {
        var value = $(this).data('secretkey');
        $(".modal-body #myInputSecretKey.valsecretkey").val( value );
    });

    function CopySecretKey(){
      /* Get the text field */
        var copyText = document.getElementById("myInputSecretKey");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      /* Copy the text inside the text field */
      document.execCommand("copy");

      /* Alert the copied text */
      // alert("Copied the text: " + copyText.value);

      $('#myModalS').modal('hide');
    }
  </script>

  <?php
$module_default_pagesize = 15;
$module_default_pageshow = 1;
$module_sort_number = "DESC";
$contant_orderby = $mod_tb_root . "_credate";
$group_orderby = $mod_tb_root . "_order";

if ($module_pagesize == "") {$module_pagesize = $module_default_pagesize;}
if ($module_pageshow == "") {$module_pageshow = $module_default_pageshow;}
if ($module_adesc == "") {$module_adesc = $module_sort_number;}
if ($module_orderby == "") {$module_orderby = $mod_tb_root . "_credate";}
if ($inputSearch != "") {$inputSearch = trim($inputSearch);}

$sqlSearch = "";
if ($inputSearch != "") {
    $sqlSearch = $sqlSearch . "  AND   (
    " . $mod_tb_root . "_ipaddress LIKE '%$inputSearch%' OR
    " . $mod_tb_root . "_iprouter LIKE '%$inputSearch%'
  ) ";
}

// ".$mod_tb_root_group."_subject LIKE '%$inputSearch%' OR

// if($inputGh>=1) {
//   $sqlSearch = $sqlSearch."  AND    ".$mod_tb_root_group."_id='".$inputGh."'  ";
// }

if ($sdateInput != "") {
    $valSdate = DateFormatInsertNoTime($sdateInput);

    if ($edateInput != "") {
        $valEdate = DateFormatInsertNoTime($edateInput);
    } else {
        $year = date("Y") + 543;
        $valEdate = DateFormatInsertNoTime(date("d-m") . "-" . $year);
    }

    $sqlSearch = $sqlSearch . "  AND  (" . $mod_tb_root . "_credate BETWEEN '" . $valSdate . " 00:00:00' AND '" . $valEdate . " 23:59:59')  ";
}

$sqlSelect = "
    " . $mod_tb_root . "_id ,
    " . $mod_tb_root . "_subject,
    " . $mod_tb_root . "_title,
    " . $mod_tb_root . "_htmlfilename ,
    " . $mod_tb_root . "_credate,
    " . $mod_tb_root . "_lastdate ,
    " . $mod_tb_root . "_crebyid,
    " . $mod_tb_root . "_status,
    " . $mod_tb_root . "_sdate ,
    " . $mod_tb_root . "_edate ,
    " . $mod_tb_root . "_pic  ,
    " . $mod_tb_root . "_groupProoject ,
    " . $mod_tb_root . "_year      ,
    " . $mod_tb_root . "_metatitle       ,
    " . $mod_tb_root . "_description       ,
    " . $mod_tb_root . "_keywords,
    " . $mod_tb_root . "_type ,
    " . $mod_tb_root . "_filevdo ,
    " . $mod_tb_root . "_url,
    " . $mod_tb_root . "_pic2,
    " . $mod_tb_root . "_view,
    " . $mod_tb_root . "_ipaddress as ipaddress,
    " . $mod_tb_root . "_keysite as keysite,
    " . $mod_tb_root . "_countsecretkey as countsecretkey,
    " . $mod_tb_root . "_iprouter as iprouter,
";
// $sqlSelect .= "
//     ".$mod_tb_root_group."_id as group_id,
//     ".$mod_tb_root_group."_subject as group_name,
//     ".$mod_tb_root_group."_url as group_url,
//     ";

$sqlSelect .= "
    " . $mod_tb_root . "_accesstoken as token,
    " . $mod_tb_root . "_secretkeysite as secretkey,
    " . $mod_tb_root . "_browser as sitename
    ";

$sql_export = "SELECT " . $sqlSelect . "  FROM " . $mod_tb_root;
// $sql_export = $sql_export."  INNER JOIN ".$mod_tb_root_group." ON ".$mod_tb_root.".".$mod_tb_root."_secretkeysite = ".$mod_tb_root_group.".".$mod_tb_root_group."_secretkey ";
$sql_export = $sql_export . "  WHERE   " . $mod_tb_root . "_masterkey='" . $_POST["masterkey"] . "'  ";
$sql_export .= $sqlSearch;

$sql_export .= " ORDER BY $module_orderby  DESC ";

// print_pre($sql_export);
// print_pre($_REQUEST);

// Check to set default value #########################
$module_default_pagesize = $core_default_pagesize;
$module_default_maxpage = $core_default_maxpage;
$module_default_reduce = $core_default_reduce;
$module_default_pageshow = 1;
$module_sort_number = $core_sort_number;

if ($_REQUEST['module_pagesize'] == "") {
    $module_pagesize = $module_default_pagesize;
} else {
    $module_pagesize = $_REQUEST['module_pagesize'];
}

if ($_REQUEST['module_pageshow'] == "") {
    $module_pageshow = $module_default_pageshow;
} else {
    $module_pageshow = $_REQUEST['module_pageshow'];
}

if ($_REQUEST['module_adesc'] == "") {
    $module_adesc = $module_sort_number;
} else {
    $module_adesc = $_REQUEST['module_adesc'];
}

if ($_REQUEST['module_orderby'] == "") {
    $module_orderby = $mod_tb_root . "_credate";
} else {
    $module_orderby = $_REQUEST['module_orderby'];
}

if ($_REQUEST['inputSearch'] != "") {
    $inputSearch = trim($_REQUEST['inputSearch']);
} else {
    $inputSearch = $_REQUEST['inputSearch'];
}

?>
  <form action="?" method="post" name="myFormExport" id="myFormExport">
    <input name="sql_export" type="hidden" id="sql_export" value="<?php echo $sql_export?>" />
    <input name="language_export" type="hidden" id="language_export" value="<?php echo $_SESSION['core_session_language']?>" />
    <input name="masterkey" type="hidden" id="masterkey" value="<?php echo $_POST["masterkey"]?>" />
    <input name="menukeyid" type="hidden" id="menukeyid" value="<?php echo $_POST["menukeyid"]?>" />
  </form>

  <form action="?" method="post" name="myForm" id="myForm">
    <input name="masterkey" type="hidden" id="masterkey" value="<?php echo $_REQUEST['masterkey']?>" />
    <input name="menukeyid" type="hidden" id="menukeyid" value="<?php echo $_REQUEST['menukeyid']?>" />
    <input name="module_pageshow" type="hidden" id="module_pageshow" value="<?php echo $module_pageshow?>" />
    <input name="module_pagesize" type="hidden" id="module_pagesize" value="<?php echo $module_pagesize?>" />
    <input name="module_orderby" type="hidden" id="module_orderby" value="<?php echo $module_orderby?>" />

    <div class="divRightNav">
      <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td class="divRightNavTb" align="left"><span class="fontContantTbNav"><a href="<?php echo $valLinkNav1?>" target="_self"><?php echo $valNav1?></a> <img src="../img/btn/nav.png" align="absmiddle" vspace="5" /> <?php echo $valNav2?></span></td>
          <td class="divRightNavTb" align="right">

            <!-- ######### Start Menu Sub Mod ########## -->
            <!-- <div class="menuSubMod">
              <a href="group.php?masterkey=<?php echo $_REQUEST['masterkey']?>&menukeyid=<?php echo $_REQUEST['menukeyid']?>">
                <?php echo $langMod["meu:group"]?>
              </a>
            </div> -->
            <!-- <div class="menuSubMod">
                <a  href="subgroup.php?masterkey=<?php echo $_REQUEST['masterkey']?>&menukeyid=<?php echo $_REQUEST['menukeyid']?>">
                  <?php echo $langMod["meu:subgroup"]?>
                </a>
            </div> -->
            <!-- <div class="menuSubMod active">
              <a href="index.php?masterkey=<?php echo $_REQUEST['masterkey']?>&menukeyid=<?php echo $_REQUEST['menukeyid']?>">
                <?php echo $langMod["meu:contant"]?>
              </a>
            </div> -->
            <!-- ######### End Menu Sub Mod ########## -->

          </td>
        </tr>

      </table>
    </div>
    <div class="divRightHeadSearch">

      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:20px;" align="center">
        <tr>


          <td class="selectSearch1">
            <input name="sdateInputSe" type="text"  id="sdateInputH" autocomplete="off"  placeholder="<?php echo $langMod["tit:sSedate"]?>" value="<?php echo trim($_REQUEST['sdateInput'])?>" class="formInputSearchStyle" />
          </td>
          <td  class="selectSearch1">
            <input name="edateInputSe" type="text"  id="edateInputH" autocomplete="off"  placeholder="<?php echo $langMod["tit:eSedate"]?>" value="<?php echo trim($_REQUEST['edateInput'])?>" class="formInputSearchStyle" />
          </td>

          <td id="boxSelectTest" style="width: 48%;">
            <input name="inputSearch" type="text" id="inputSearch" value="<?php echo trim($_REQUEST['inputSearch'])?>" class="formInputSearchStyle" placeholder="<?php echo $langTxt["sch:search"]?>" />
          </td>
          <td class="bottonSearchStyle" align="right">
            <input name="searchOk" id="searchOk" onClick="document.myForm.submit();" type="button" class="btnSearch" value=" " />
          </td>
        </tr>

      </table>

    </div>
    <div class="divRightHead">
      <table width="96%" border="0" cellspacing="0" cellpadding="0" class="borderBottom" align="center">
        <tr>
          <td height="77" align="left"><span class="fontHeadRight"><?php echo $valNav2?></span></td>
          <td align="left">
            <table border="0" cellspacing="0" cellpadding="0" align="right">
              <tr>
                <td align="right">
                  <?php if ($valPermission == "RW") { ?>
                  <div class="btnDel" title="<?php echo $langTxt["btn:del"]?>" onclick="
                    if(Paging_CountChecked('CheckBoxID',document.myForm.TotalCheckBoxID.value)>0) {
                      if(confirm('<?php echo $langTxt["mg:delpermis"]?>')) {
                              delContactNew('deleteContant.php');
                      }
                    } else {
                        alert('<?php echo $langTxt["mg:selpermis"]?>');
                    }
                    ">
                  </div>
                    <div class="btnExport" title="<?php echo $langTxt["btn:export"]?>" onclick="
                        document.myFormExport.action ='exportReport.php';
                        document.myFormExport.submit();
                    ">
                    </div>
                </td>
              <?php } ?>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
    <div class="divRightMain">


      <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="tbBoxListwBorder">
        <tr>
          <td width="3%" class="divRightTitleTbL" valign="middle" align="center">
            <input name="CheckBoxAll" type="checkbox" id="CheckBoxAll" value="Yes" onClick="Paging_CheckAll(this,'CheckBoxID',document.myForm.TotalCheckBoxID.value)" class="formCheckboxHead" /> </td>

          <td class="divRightTitleTb" valign="middle" align="left"><span class="fontTitlTbRight"><?php echo $langMod["tit:ipaddress"]?></span></td>
          <td width="24%" class="divRightTitleTb" valign="middle" align="center"><span class="fontTitlTbRight"><?php echo $langMod["tit:token"]?></span></td>
          <td width="24%" class="divRightTitleTb" valign="middle" align="center"><span class="fontTitlTbRight"><?php echo $langTxt["us:credate"]?></span></td>
        </tr>
        <?php
// SQL SELECT #########################
$sql = "SELECT
" . $mod_tb_root . "_id,
" . $mod_tb_root . "_subject,
" . $mod_tb_root . "_lastdate,
" . $mod_tb_root . "_status,
" . $mod_tb_root . "_pic,
" . $mod_tb_root . "_view,
" . $mod_tb_root . "_groupProoject,
" . $mod_tb_root . "_masterkey,
" . $mod_tb_root . "_credate as credate,
" . $mod_tb_root . "_ipaddress as ipaddress,
" . $mod_tb_root . "_keysite as keysite,
" . $mod_tb_root . "_countsecretkey as countsecretkey,
" . $mod_tb_root . "_iprouter as iprouter,
";

// $sql .= "
//   ".$mod_tb_root_group."_id as group_id,
//   ".$mod_tb_root_group."_subject as group_name,
//   ".$mod_tb_root_group."_url as group_url,
// ";

$sql .= "
" . $mod_tb_root . "_accesstoken as token,
" . $mod_tb_root . "_secretkeysite as secretkey,
" . $mod_tb_root . "_browser as sitename


FROM " . $mod_tb_root;
// $sql = $sql."  INNER JOIN ".$mod_tb_root_group." ON ".$mod_tb_root.".".$mod_tb_root."_secretkeysite = ".$mod_tb_root_group.".".$mod_tb_root_group."_secretkey ";
$sql = $sql . "  WHERE " . $mod_tb_root . "_masterkey ='" . $_REQUEST['masterkey'] . "' ";

// if($_REQUEST['inputGh']>=1) {
// $sql = $sql."  AND ".$mod_tb_root_group."_id ='".$_REQUEST['inputGh']."'   ";

// }

/*if($_REQUEST['inputTh']>=1) {
$sql = $sql."  AND ".$mod_tb_root."_tid ='".$_REQUEST['inputTh']."'   ";
}*/

if ($_REQUEST['sdateInput'] != "") {
    $valSdate = DateFormatInsertNoTimeAccpet($_REQUEST['sdateInput']);

    if ($_REQUEST['edateInput'] != "") {
        $valEdate = DateFormatInsertNoTimeAccpet($_REQUEST['edateInput']);
    } else {
        $year = date("Y") + 543;
        $valEdate = DateFormatInsertNoTimeAccpet(date("d-m") . "-" . $year);
    }

    $sql = $sql . "  AND  (" . $mod_tb_root . "_credate BETWEEN '" . $valSdate . " 00:00:00' AND '" . $valEdate . " 23:59:59')  ";
}

if ($inputSearch != "") {
    $sql = $sql . "  AND  (
      " . $mod_tb_root . "_ipaddress LIKE '%$inputSearch%' OR
      " . $mod_tb_root . "_iprouter LIKE '%$inputSearch%'
    ) ";
}

// OR
// ".$mod_tb_root_group."_subject LIKE '%$inputSearch%' OR
// ".$mod_tb_root."_subjecten LIKE '%$inputSearch%'

// print_pre($sql);
$query = wewebQueryDB($coreLanguageSQL, $sql);

$count_totalrecord = wewebNumRowsDB($coreLanguageSQL, $query);

// Find max page size #########################
if ($count_totalrecord > $module_pagesize) {
    $numberofpage = ceil($count_totalrecord / $module_pagesize);
} else {
    $numberofpage = 1;
}

// Recover page show into range #########################
if ($module_pageshow > $numberofpage) {$module_pageshow = $numberofpage;}

// Select only paging range #########################
$recordstart = ($module_pageshow - 1) * $module_pagesize;

$sql .= " ORDER BY $module_orderby $module_adesc LIMIT $recordstart , $module_pagesize ";
// print_pre($sql);
$query = wewebQueryDB($coreLanguageSQL, $sql);
$count_record = wewebNumRowsDB($coreLanguageSQL, $query);

$index = 1;
$valDivTr = "divSubOverTb";
if ($count_record > 0) {
    while ($index < $count_record + 1) {
        $row = wewebFetchArrayDB($coreLanguageSQL, $query);
        $valID = $row[0];
        // $valName=rechangeQuot($row[1]);
        $valName = rechangeQuot($row[1]);
        $valDateLastdate = dateFormatReal($row[2]);
        $valTimeLastdate = timeFormatReal($row[2]);
        $valStatus = $row[3];
        // $valNameEn=rechangeQuot($row[4]);
        // $valNameEn=chechNullVal($valNameEn);
        $valPic = $mod_path_office . "/" . $row[4];
        if (is_file($valPic)) {
            $valPic = $valPic;
        } else {
            $valPic = "../img/btn/nopic.jpg";
        }

        $valView = number_format($row[5]);
        $valGid = $row[6];
        $valMasterkeys = $row[7];

        if ($valStatus == "Enable" || $valStatus == "Accept") {
            $valStatusClass = "fontContantTbEnable";
        } else if ($valStatus == "Home") {
            $valStatusClass = "fontContantTbHomeSt";
        } else {
            $valStatusClass = "fontContantTbDisable";
        }

        if ($valDivTr == "divSubOverTb") {
            $valDivTr = "divOverTb";
            $valImgCycle = "boxprofile_l.png";
        } else {
            $valDivTr = "divSubOverTb";
            $valImgCycle = "boxprofile_w.png";
        }

        $valDateCredate = dateFormatReal($row['credate']);
        $valTimeCredate = timeFormatReal($row['credate']);
        $valIP = $row['ipaddress'];
        $valKeySite = $row['keysite'];
        $valCountSecretKey = $row['countsecretkey'];
        $valIProuter = $row['iprouter'];
        $valGroupID = $row['group_id'];
        $valGroupName = $row['group_name'];
        $valGroupUrl = trim($row['group_url']);
        if ($valGroupUrl != '' && $valGroupUrl != '#') {
            $valURL = $valGroupUrl;
        } else {
            $valURL = "-";
        }
        $valToken = $row['token'];
        $valSecretKey = $row['secretkey'];
        $valBrowser = $row['sitename'];

        ?>
        <tr class="<?php echo $valDivTr?>">
          <td class="divRightContantOverTbL" valign="top" align="center"><input id="CheckBoxID<?php echo $index?>" name="CheckBoxID<?php echo $index?>" type="checkbox" class="formCheckboxList" onClick="Paging_CheckAllHandle(document.myForm.CheckBoxAll,'CheckBoxID',document.myForm.TotalCheckBoxID.value)" value="<?php echo $valID?>" /> </td>
          
          <td class="divRightContantOverTb" valign="top" align="left" style="display: none;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                
                <td align="left" style="padding-left:10px; " valign="top">
                  <a href="javascript:void(0)" onclick="
                    document.myFormHome.inputLt.value='Thai';
                    document.myFormHome.valEditID.value=<?php echo $valID?>;
                    viewContactNew('viewContant.php');">
                      <?php echo $valGroupName?>
                      <br />
                      <span class="fontContantTbTime" >
                        <?php echo $langTxt['txt:url']?> <a <?php if ($valGroupUrl != '' && $valGroupUrl != '#') { ?> href="<?php echo $valURL ?>" <?php } ?> class="fontLinksub" target="_blank"><?php echo $valURL ?></a>
                      </span>
                  </a>
                  <br />
                  <?php
$path_detail_id = str_replace('|id|', $valID, $mod_url_search_front);
        $path_detail_gid = str_replace('|gid|', $valGid, $path_detail_id);
        $path_detail_Masterkeys = str_replace('|masterkey|', $valMasterkeys, $path_detail_gid);
        // print_pre($path_detail);
        ?>
                  <span class="fontContantTbTime" style="display: none;">
                    <?php echo $langTxt["txt:url"]?><a href="<?php echo $path_detail_Masterkeys ?>" class="fontLinksub" target="_blank"><?php echo $path_detail_Masterkeys ?></a>
                  </span>
                </td>
              </tr>
            </table>
          </td>


          <td class="divRightContantOverTb" valign="top" align="left"><span class="fontContantTbupdate"><?php echo $valIP?></span></td>
          <td class="divRightContantOverTb" valign="top" align="center" >
            <div class="input-key">
              <div>
                <span class="fontContantTbupdate"><?php echo $valToken?></span>
              </div>
                <button type="button" class="btn btn-primary token" data-toggle="modal" data-target="#myModal" data-token="<?php echo $valToken?>">
                  เพิ่มเติม
                </button>
            </div>
          </td>

          <td class="divRightContantOverTb" valign="top" align="center">
            <span class="fontContantTbupdate"><?php echo $valDateCredate?></span><br />
            <span class="fontContantTbTime"><?php echo $valTimeCredate?></span> </td>
          <td class="divRightContantOverTbR" valign="top" align="center" style="display: none;">

          <td class="divRightContantOverTbR" valign="top" align="center" style="display: none;">
            <?php if ($valPermission == "RW") { ?>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>

                <?php //if($_REQUEST['inputGh'] != 0){
            ?>
                <td valign="top" align="center" width="30">

                  <div class="divRightManage" title="<?php echo $langTxt["btn:top"]?>" onclick="
   document.myFormHome.inputLt.value='Thai';
   document.myFormHome.valEditID.value=<?php echo $valID?>;
    editContactNew('topUpdateContant.php');">
                    <img src="../img/btn/topbtn.png" /><br />
                    <span class="fontContantTbManage"><?php echo $langTxt["btn:top"]?>
                      <?php if ($_SESSION[$valSiteManage . 'core_session_languageT'] == 2 || $_SESSION[$valSiteManage . 'core_session_languageT'] == 3) { ?><br />
                      (<?php echo $langTxt["lg:all"]?>)
                      <?php } ?></span></div>
                </td>
                <td valign="top" align="center" width="30">
                  <div class="divRightManage" title="<?php echo $langTxt["btn:edit"]?>" onclick="
   document.myFormHome.inputLt.value='Thai';
   document.myFormHome.valEditID.value=<?php echo $valID?>;
    editContactNew('editContant.php');">
                    <img src="../img/btn/edit.png" /><br />
                    <span class="fontContantTbManage"><?php echo $langTxt["btn:edit"]?>
                      <?php if ($_SESSION[$valSiteManage . 'core_session_languageT'] == 2 || $_SESSION[$valSiteManage . 'core_session_languageT'] == 3) { ?><br />
                      (<?php echo $langTxt["lg:thai"]?>)
                      <?php } ?></span> </div>
                </td>
                <?php if ($_SESSION[$valSiteManage . 'core_session_languageT'] == 2 || $_SESSION[$valSiteManage . 'core_session_languageT'] == 3) { ?>
                <td valign="top" align="center" width="30">
                  <div class="divRightManage" title="<?php echo $langTxt["btn:edit"]?>" onclick="
   document.myFormHome.inputLt.value='Eng';
   document.myFormHome.valEditID.value=<?php echo $valID?>;
    editContactNew('editContant.php');">
                    <img src="../img/btn/edit.png" /><br />
                    <span class="fontContantTbManage"><?php echo $langTxt["btn:edit"]?><br />
                      (<?php echo $langTxt["lg:eng"]?>)</span> </div>
                </td>
                <?php } ?>
                <?php if ($_SESSION[$valSiteManage . 'core_session_languageT'] == 3) { ?>
                <td valign="top" align="center" width="30">
                  <div class="divRightManage" title="<?php echo $langTxt["btn:edit"]?>" onclick="
   document.myFormHome.inputLt.value='Chi';
   document.myFormHome.valEditID.value=<?php echo $valID?>;
    editContactNew('editContant.php');">
                    <img src="../img/btn/edit.png" /><br />
                    <span class="fontContantTbManage"><?php echo $langTxt["btn:edit"]?><br />
                      (<?php echo $langTxt["lg:chi"]?>)</span> </div>
                </td>
                <?php } ?>
                <td valign="top" align="center" width="30">
                  <div class="divRightManage" title="<?php echo $langTxt["btn:del"]?>" onClick="
            if(confirm('<?php echo $langTxt["mg:delpermis"]?>')) {
            Paging_CheckedThisItem( document.myForm.CheckBoxAll, <?php echo $index?>, 'CheckBoxID', document.myForm.TotalCheckBoxID.value );
          delContactNew('deleteContant.php');
            }
            ">
                    <img src="../img/btn/delete.png" /><br />
                    <span class="fontContantTbManage"><?php echo $langTxt["btn:del"]?>
                      <?php if ($_SESSION[$valSiteManage . 'core_session_languageT'] == 2 || $_SESSION[$valSiteManage . 'core_session_languageT'] == 3) { ?><br />
                      (<?php echo $langTxt["lg:all"]?>)
                      <?php } ?></span> </div>
                </td>
              </tr>
            </table>
            <?php } ?>
          </td>
        </tr>

        <?php
        $index++;
    }
} else { ?>
        <tr>
          <td colspan="7" align="center" valign="middle" class="divRightContantTbRL" style="padding-top:150px; padding-bottom:150px;"><?php echo $langTxt["mg:nodate"]?></td>
        </tr>
        <?php } ?>

        <tr>
          <td colspan="8" align="center" valign="middle" class="divRightContantTbRL">
            <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td class="divRightNavTb" align="left"><span class="fontContantTbNavPage"><?php echo $langTxt["pr:All"]?> <b><?php echo number_format($count_totalrecord)?></b> <?php echo $langTxt["pr:record"]?></span></td>
                <td class="divRightNavTb" align="right">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="right" style="padding-right:10px;"><span class="fontContantTbNavPage"><?php echo $langTxt["pr:page"]?>
                          <?php if ($numberofpage > 1) { ?>
                          <select name="toolbarPageShow" class="formSelectContantPage" onChange="document.myForm.module_pageshow.value=this.value; document.myForm.submit(); ">
                            <?php
    if ($numberofpage < $module_default_maxpage) {
        // Show page list #########################
        for ($i = 1; $i <= $numberofpage; $i++) {
            echo "<option value=\"$i\"";
            if ($i == $module_pageshow) {echo " selected";}
            echo ">$i</option>";
        }

    } else {
        // # If total page count greater than default max page  value then reduce page select size #########################
        $starti = $module_pageshow - $module_default_reduce;
        if ($starti < 1) {$starti = 1;}
        $endi = $module_pageshow + $module_default_reduce;
        if ($endi > $numberofpage) {$endi = $numberofpage;}
        //#####################
        for ($i = $starti; $i <= $endi; $i++) {
            echo "<option value=\"$i\"";
            if ($i == $module_pageshow) {echo " selected";}
            echo ">$i</option>";
        }
    }
    ?>
                          </select>
                          <?php } else { ?>
                          <b><?php echo $module_pageshow?></b>
                          <?php } ?>
                          <?php echo $langTxt["pr:of"]?> <b><?php echo $numberofpage?></b></span></td>
                      <?php if ($module_pageshow > 1) { ?>
                      <td width="21" align="center"> <img src="../img/controlpage/playset_start.gif" width="21" height="21" onmouseover="this.src='../img/controlpage/playset_start_active.gif'; this.style.cursor='hand';" onmouseout="this.src='../img/controlpage/playset_start.gif';" onclick="document.myForm.module_pageshow.value=1; document.myForm.submit();" style="cursor:pointer;" /></td>
                      <?php } else { ?>
                      <td width="21" align="center"><img src="../img/controlpage/playset_start_disable.gif" width="21" height="21" /></td>
                      <?php } ?>
                      <?php if ($module_pageshow > 1) {
    $valPrePage = $module_pageshow - 1;
    ?>
                      <td width="21" align="center"> <img src="../img/controlpage/playset_backward.gif" width="21" height="21" style="cursor:pointer;" onmouseover="this.src='../img/controlpage/playset_backward_active.gif'; this.style.cursor='hand';" onmouseout="this.src='../img/controlpage/playset_backward.gif';" onclick="document.myForm.module_pageshow.value='<?php echo $valPrePage?>'; document.myForm.submit();" /></td>
                      <?php } else { ?>
                      <td width="21" align="center"><img src="../img/controlpage/playset_backward_disable.gif" width="21" height="21" /></td>
                      <?php } ?>
                      <td width="21" align="center"> <img src="../img/controlpage/playset_stop.gif" width="21" height="21" style="cursor:pointer;" onmouseover="this.src='../img/controlpage/playset_stop_active.gif'; this.style.cursor='hand';" onmouseout="this.src='../img/controlpage/playset_stop.gif';" onclick="
		with(document.myForm) {
		module_pageshow.value='';
		module_pagesize.value='';
		module_orderby.value='';
        document.myForm.submit();
		}
		" /></td>
                      <?php if ($module_pageshow < $numberofpage) {
    $valNextPage = $module_pageshow + 1;
    ?>
                      <td width="21" align="center"> <img src="../img/controlpage/playset_forward.gif" width="21" height="21" style="cursor:pointer;" onmouseover="this.src='../img/controlpage/playset_forward_active.gif'; this.style.cursor='hand';" onmouseout="this.src='../img/controlpage/playset_forward.gif';" onclick="document.myForm.module_pageshow.value='<?php echo $valNextPage?>'; document.myForm.submit();" /></td>
                      <?php } else { ?>
                      <td width="10" align="center"><img src="../img/controlpage/playset_forward_disable.gif" width="21" height="21" /></td>
                      <?php } ?>
                      <?php if ($module_pageshow < $numberofpage) { ?>
                      <td width="10" align="center"><img src="../img/controlpage/playset_end.gif" width="21" height="21" style="cursor:pointer;" onmouseover="this.src='../img/controlpage/playset_end_active.gif'; this.style.cursor='hand';" onmouseout="this.src='../img/controlpage/playset_end.gif';" onclick="document.myForm.module_pageshow.value='<?php echo $numberofpage?>'; document.myForm.submit();" /></td>
                      <?php } else { ?>
                      <td width="10" align="center"><img src="../img/controlpage/playset_end_disable.gif" width="21" height="21" /></td>
                      <?php } ?>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <input name="TotalCheckBoxID" type="hidden" id="TotalCheckBoxID" value="<?php echo $index - 1?>" />
      <div class="divRightContantEnd"></div>
    </div>

  </form>



  <?php if ($_SESSION[$valSiteManage . 'core_session_language'] == "Thai") { ?>
    <script language="JavaScript"  type="text/javascript" src="../js/datepickerThaiH.js"></script>
  <?php } else { ?>
    <script language="JavaScript"  type="text/javascript" src="../js/datepickerEngH.js"></script>
  <?php } ?>

  <?php include "../lib/disconnect.php";?>

  <?php include "modal.php";?>
