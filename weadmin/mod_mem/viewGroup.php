<?php
include("../lib/session.php");
include("../lib/config.php");
include("../lib/connect.php");
include("../lib/function.php");
include("../lib/checkMember.php");
include("../core/incLang.php");
include("incModLang.php");
include("config.php");

$valClassNav=2;
$valNav1=$langTxt["nav:home2"];
$valLinkNav1="../core/index.php";



				$sql = "SELECT   ";
				$sql .= "   ".$mod_tb_root_group."_id,
            ".$mod_tb_root_group."_credate ,
            ".$mod_tb_root_group."_crebyid,
            ".$mod_tb_root_group."_status	,
            ".$mod_tb_root_group."_lastdate ,
            ".$mod_tb_root_group."_lastbyid   ";

			if($_REQUEST['inputLt']=="Thai"){
				$sql .= "   , ".$mod_tb_root_group."_subject  ,    ".$mod_tb_root_group."_title   ";
			}else if($_REQUEST['inputLt']=="Eng"){
				$sql .= "  ,".$mod_tb_root_group."_subjecten  ,    ".$mod_tb_root_group."_titleen 	  ";
			}else{
				$sql .= "  ,".$mod_tb_root_group."_subjectcn  ,    ".$mod_tb_root_group."_titlecn 	  ";
			}

			//  $sql .= " ,".$mod_tb_root_group."_pic ";
			 $sql .= " ,".$mod_tb_root_group."_pic ,".$mod_tb_root_group."_pic2,".$mod_tb_root_group."_type, ".$mod_tb_root_group."_url, ".$mod_tb_root_group."_target ";
		 	 $sql .= " FROM ".$mod_tb_root_group." WHERE ".$mod_tb_root_group."_masterkey='".$_REQUEST["masterkey"]."'  AND  ".$mod_tb_root_group."_id='".$_REQUEST['valEditID']."' ";
			$Query=wewebQueryDB($coreLanguageSQL,$sql);
			$Row=wewebFetchArrayDB($coreLanguageSQL,$Query);
			$valID=$Row[0];
			$valCredate=DateFormat($Row[1]);
			$valCreby=$Row[2];
			$valStatus=$Row[3];
			if($valStatus=="Enable"){
				$valStatusClass=	"fontContantTbEnable";
			}else{
				$valStatusClass=	"fontContantTbDisable";
			}

			$valLastdate=DateFormat($Row[4]);
			$valLastby=$Row[5];
			$valSubject=rechangeQuot($Row[6]);
			$valTitle=rechangeQuot($Row[7]);
      $valPicName=$Row[8];
			$valPic=$mod_path_pictures."/".$Row[8];
			$valPicName2=$Row[9];
			$valPic2=$mod_path_pictures."/".$Row[9];
      $valType=$Row[10];
      $valUrl=rechangeQuot($Row[11]);
      $valTarget=$Row[12];
		 	$valPermission= getUserPermissionOnMenu($_SESSION[$valSiteManage."core_session_groupid"],$_REQUEST["menukeyid"]);

			logs_access('3','View Group');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<link href="../css/theme.css" rel="stylesheet"/>

<title><?php echo $core_name_title?></title>
<script language="JavaScript"  type="text/javascript" src="../js/scriptCoreWeweb.js"></script>
</head>

<body>
<form action="?" method="get" name="myForm" id="myForm">
    <input name="execute" type="hidden" id="execute" value="update" />
    <input name="masterkey" type="hidden" id="masterkey" value="<?php echo $_REQUEST['masterkey']?>" />
    <input name="menukeyid" type="hidden" id="menukeyid" value="<?php echo $_REQUEST['menukeyid']?>" />
    <input name="inputSearch" type="hidden" id="inputSearch" value="<?php echo $_REQUEST['inputSearch']?>" />
    <input name="module_pageshow" type="hidden" id="module_pageshow" value="<?php echo $_REQUEST['module_pageshow']?>" />
    <input name="module_pagesize" type="hidden" id="module_pagesize" value="<?php echo $_REQUEST['module_pagesize']?>" />
    <input name="module_orderby" type="hidden" id="module_orderby" value="<?php echo $_REQUEST['module_orderby']?>" />
    <input name="inputGh" type="hidden" id="inputGh" value="<?php echo $_REQUEST['inputGh']?>" />
    <input name="valEditID" type="hidden" id="valEditID" value="<?php echo $_REQUEST['valEditID']?>" />
    <input name="inputLt" type="hidden" id="inputLt" value="<?php echo $_REQUEST['inputLt']?>" />
    <?php if($_REQUEST['viewID']<=0){ ?>
					<div class="divRightNav">
                        <table width="96%" border="0" cellspacing="0" cellpadding="0"  align="center" >
                        <tr>
                        <td  class="divRightNavTb" align="left"  id="defTop" ><span class="fontContantTbNav"><a href="<?php echo $valLinkNav1?>" target="_self"><?php echo $valNav1?></a> <img src="../img/btn/navblack.png" align="absmiddle" vspace="5" /> <a  href="javascript:void(0)"  onclick="btnBackPage('group.php')" target="_self"><?php echo $langMod["meu:group"]?></a> <img src="../img/btn/navblack.png" align="absmiddle" vspace="5" /> <?php echo $langMod["txt:titleviewg"]?><?php if($_SESSION[$valSiteManage.'core_session_languageT']==2 || $_SESSION[$valSiteManage.'core_session_languageT']==3){ ?>(<?php echo getSystemLangTxt($_REQUEST['inputLt'],$langTxt["lg:thai"],$langTxt["lg:eng"],$langTxt["lg:chi"])?>)<?php } ?></span></td>
                        <td  class="divRightNavTb" align="right">



                        </td>
                        </tr>
                        </table>
					</div>
                    <?php } ?>
                            <div class="divRightHead">
                                <table width="96%" border="0" cellspacing="0" cellpadding="0" class="borderBottom" align="center" >
                                  <tr>
                                    <td height="77" align="left"><span class="fontHeadRight"><?php echo $langMod["txt:titleviewg"]?><?php if($_SESSION[$valSiteManage.'core_session_languageT']==2|| $_SESSION[$valSiteManage.'core_session_languageT']==3){ ?>(<?php echo getSystemLangTxt($_REQUEST['inputLt'],$langTxt["lg:thai"],$langTxt["lg:eng"],$langTxt["lg:chi"])?>)<?php } ?></span></td>
                                    <td align="left">
                                            <table  border="0" cellspacing="0" cellpadding="0" align="right">
                                                <tr>
                                                    <td align="right">
													<?php if($_REQUEST['viewID']<=0){ ?>
                                                    <?php if($valPermission=="RW"){ ?>
                                                        <div  class="btnEditView" title="<?php echo $langTxt["btn:edit"]?>" onclick="
                                                        document.myFormHome.valEditID.value=<?php echo $valID?>;
                                                        editContactNew('../<?php echo $mod_fd_root?>/editGroup.php')"></div>
                                                     <?php } ?>
                                                      <div  class="btnBack" title="<?php echo $langTxt["btn:back"]?>" onclick="btnBackPage('group.php')"></div>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                             <div class="divRightMain" >
     <br />
    <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="tbBoxViewBorder ">
                    <tr >
                        <td colspan="7" align="left"  valign="middle" class="formTileTxt tbBoxViewBorderBottom">
    <span class="formFontSubjectTxt"><?php echo $langMod["txt:subjectg"]?></span><br/>
    <span class="formFontTileTxt"><?php echo $langMod["txt:subjectgDe"]?></span>    </td>
    </tr>

      <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langMod["tit:subjectg"]?>:<span class="fontContantAlert"></span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><div class="formDivView"><?php echo $valSubject?></div></td>
  </tr>
        <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langMod["tit:noteg"]?>:<span class="fontContantAlert"></span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><div class="formDivView"><?php echo $valTitle?></div></td>
  </tr>


</table>
   <br />
   <!-- <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="tbBoxViewBorder ">
        <tr >
            <td colspan="7" align="left"  valign="middle" class="formTileTxt tbBoxViewBorderBottom">
                <span class="formFontSubjectTxt"><?php echo  $langMod["txt:groupType"] ?></span><br/>
                <span class="formFontTileTxt"><?php echo  $langMod["txt:groupTypeDe"] ?></span>    </td>
        </tr>
        <tr ><td colspan="7" align="right"  valign="top"   height="15" ></td></tr>
        <tr >
            <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo  $langMod["tit:groupType"] ?>:</td>
            <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
            <div class="formDivView"><?php echo $modGroupType[$valType];?></div>

            </td>
        </tr>

        <tr id="boxInputlink"  <?php if($valType != 2){ ?> style="display:none;" <?php } ?>>
                <td width="18%" align="right"  valign="top"  class="formLeftContantTb" >ขื่อ URL<span class="fontContantAlert"></span></td>
                <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><div class="formDivView"><a href="<?php echo $valUrl?>" target="_blank"><?php echo $valUrl?></a></div><br />
                </td>
            </tr>

         <tr>
            <td width="18%" align="right"  valign="top"  class="formLeftContantTb" >การแสดงผล :</td>
            <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
            <div class="formDivView"><?php echo $modTxtTarget[$valTarget];?></div>

            </td>
        </tr>
    </table>
         <br /> -->

				 <table style="display:none;" width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="tbBoxViewBorder ">
				     <tr >
				     <td colspan="7" align="left"  valign="middle" class="formTileTxt tbBoxViewBorderBottom">
				     <span class="formFontSubjectTxt"><?php echo $langMod["txt:picG"]?></span><br/>
				     <span class="formFontTileTxt"><?php echo $langMod["txt:picGDe"]?></span>    </td>
				     </tr>
				     <tr >
				     <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><span class="fontContantAlert"></span></td>
				     <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><div class="formDivView">
				     <img src="<?php echo $valPic?>"  style="float:left;border:#c8c7cc solid 1px; max-width:600px;"  onerror="this.src='<?php echo "../img/btn/nopic.jpg"?>'"  />
				     </div></td>
				   </tr>

					 <!-- <tr >
					 <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><span class="fontContantAlert"></span></td>
					 <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><div class="formDivView">
					 <img src="<?php echo $valPic2?>"  style="float:left;border:#c8c7cc solid 1px; max-width:600px;"  onerror="this.src='<?php echo "../img/btn/nopic.jpg"?>'"  />
					 </div></td>
				 </tr> -->

				   </table>
				          <!-- <br /> -->


<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="tbBoxViewBorder " >
    <tr >
    <td colspan="7" align="left"  valign="middle" class="formTileTxt tbBoxViewBorderBottom">
    <span class="formFontSubjectTxt"><?php echo $langTxt["us:titleinfo"]?></span><br/>
    <span class="formFontTileTxt"><?php echo $langTxt["us:titleinfoDe"]?></span>     </td>
    </tr>
    <!-- <tr <?php if($valType == 2){ ?> style="display:none;" <?php } ?>>
        <td width="18%" align="right"  valign="top"  class="formLeftContantTb" >URL :<span class="fontContantAlert"></span></td>
        <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><div class="formDivView">
        <?php  if ($_REQUEST['inputLt'] == "Thai") { ?>
        <a href="<?php echo loadGetURLByMod($core_full_path,'th',$mod_fd_frontUrl,$valID,1)?>" target="_blank"><?php echo loadGetURLByMod($core_full_path,'th',$mod_fd_frontUrl,$valID,1)?></a><br />
        <?php }else{ ?>
        <a href="<?php echo loadGetURLByMod($core_full_path,'en',$mod_fd_frontUrl,$valID,1)?>" target="_blank"><?php echo loadGetURLByMod($core_full_path,'en',$mod_fd_frontUrl,$valID,1)?></a><br />
            <?php   }  ?>
            </div></td>
    </tr> -->
  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langTxt["us:credate"]?>:</td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
     <div class="formDivView"><?php echo $valCredate?></div>         </td>
  </tr>
  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langTxt["us:creby"]?>:</td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
     <div class="formDivView">
     <?php
		if($_SESSION[$valSiteManage.'core_session_language']=="Thai"){
			echo getUserThai($valCreby);
		}else if($_SESSION[$valSiteManage.'core_session_language']=="Eng"){
			echo getUserEng($valCreby);
		}


	?>
	 </div>         </td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langTxt["us:lastdate"]?>:</td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
     <div class="formDivView"><?php echo $valLastdate?></div>         </td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langTxt["us:creby"]?>:</td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
     <div class="formDivView">
     <?php
		if($_SESSION[$valSiteManage.'core_session_language']=="Thai"){
			echo getUserThai($valLastby);
		}else if($_SESSION[$valSiteManage.'core_session_language']=="Eng"){
			echo getUserEng($valLastby);
		}


	?>
	 </div>         </td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langTxt["mg:status"]?>:</td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
     <div class="formDivView">

               <?php if($valStatus=="Enable"){ ?>
                   <span class="<?php echo $valStatusClass?>"><?php echo $valStatus?></span>
                <?php }else{ ?>
                    <span class="<?php echo $valStatusClass?>"><?php echo $valStatus?></span>
                <?php } ?>
     </div>         </td>
  </tr>
  </table>
         <br />
      <?php if($_REQUEST['viewID']<=0){ ?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
   <tr >
      <td colspan="7" align="right"  valign="top" height="20"></td>
      </tr>
    <tr >
    <td colspan="7" align="right"  valign="middle" class="formEndContantTb"><a href="#defTop" title="<?php echo $langTxt["btn:gototop"]?>"><?php echo $langTxt["btn:gototop"]?> <img src="../img/btn/top.png"  align="absmiddle"/></a></td>
    </tr>
    <?php } ?>
  </table>
  </div>
</form>
<?php include("../lib/disconnect.php");?>

</body>
</html>
