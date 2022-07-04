<?

		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$actxt01 = $row["actxt01"]; // 회사명
		$cmp_num = $row["cmp_num"]; // 사업자 번호
		$cmp_adr = $row["cmp_adr"]; // 소재지
		$ceo_nm = $row["ceo_nm"]; // 대표이사 성함

		$rDate = date('Y'); // 현재날짜 년
		$rDate2 = date('m'); // 현재날짜 월
		$rDate3 = date('d'); // 현재날짜 일

		if($type == 'edit' && $uid){
			$sql = "select * from wo_leave where uid='$uid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$userid = $row['userid'];
		}
?>

<style type='text/css'>
	input::-webkit-input-placeholder { font-size: 12px;color:#ccc; }
	input::-moz-placeholder { font-size: 12px;color:#ccc; }
	input:-ms-input-placeholder { font-size: 12px;color:#ccc; }
	input:-moz-placeholder { font-size: 12px;color:#ccc; }

	.gTable2 input {background-color:#eee;}
	.r_date_wrap input {width:50px;}
</style>

<!-- 캘린더 스크립트, css -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- 여기까지 -->

<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/js/daterangepicker/moment-with-locales.js"></script> <!-- 언어 파일 -->
<script type="text/javascript" src="/js/daterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="/js/daterangepicker/daterangepicker.css" />


<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<!-- <script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script> -->

<script language='javascript'>
  
  function check_form(){

	form = document.FRM;
	
	if(isFrmEmpty(form.userid,"성명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.acting,"직무대행자을 선택해 주십시오"))	return;
	if(isFrmEmpty(form.gubun,"사용용도를 선택해 주십시오"))	return;
  
  	form.action = 'proc.php';
	form.submit();
}

function check_form(){

	form = document.FRM;
	
	if(isFrmEmpty(form.userid,"성명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.acting,"직무대행자을 선택해 주십시오"))	return;
	if(isFrmEmpty(form.gubun,"사용용도를 선택해 주십시오"))	return;

	//oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);
	 
	form.action = 'proc.php';
	form.submit();
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(){
	
	if(confirm('해당 데이터를 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}
}

function setUserID() {
  
  userid = $("#userid option:selected").val(); // userid가 select됐을때 작용
  $('#team').val(''); // 소속
	$('#affil').val(''); // 직위
	$('#mobile').val(''); // 연락처
  
  if(userid){
		$.post('./jsonUser.php',{'userid':userid}, function(req){ // json 방식으로 전송하여 리턴값 받기.
      
      parData = JSON.parse(req); // 문자열 구문 분석, 객체생성
      team = parData['team']; // 소속
			affil = parData['affil'];  // 직위
			mobile = parData['mobile']; // 연락처
      
      $('#team').val(team); // 소속
			$('#affil').val(affil); // 직위
			$('#mobile').val(mobile); // 연락처
    });
	}
}

//캘린더 제이쿼리
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});

$(function() {
moment.locale('ko'); //언어를 한국어로 설정함!
  $('#daterange').daterangepicker(
    {
      timePicker: false,
      timePicker24Hour: true,
      timePickerSeconds: true,
      singleDatePicker: false,
      locale :{ 
        format: 'YYYY-MM-DD',
        separator: ' ~ ',
        applyLabel: "적용",
        cancelLabel: "닫기"
      },
    });
});

</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='mtype' value='<?=$mtype?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='type' value='<?=$type?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>
<input type='hidden' name='f_site' value='<?=$f_site?>'>
<input type='hidden' name='f_naverID' value='<?=$f_naverID?>'>
<input type='hidden' name='f_daumID' value='<?=$f_daumID?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>
<!-- /검색관련 -->


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">성  명</th>
		<td>
			<select name='userid' id="userid" onchange="setUserID()">
				<option value=''>::직원목록::</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
					if($userid == $arr_userid[$i])		$chk = 'selected';
					else										$chk = '';
			?>
				<option value='<?=$arr_userid[$i]?>' <?=$chk?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
		
			<select name='acting'>
				<option value=''>::직무대행자::</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_member[$i]?>' <?if($acting==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
					
			<select name='gubun'>
				<option value=''>::사용용도::</option>
				<option value='연차'<? echo $gubun =='연차' ? 'selected':''?>>연차</option>
				<option value='경조'<? echo $gubun =='경조' ? 'selected':''?>>경조</option>
				<option value='보건'<? echo $gubun =='보건' ? 'selected':''?>>보건</option>
				<option value='기타'<? echo $gubun =='기타' ? 'selected':''?>>기타</option>
			</select>
		</td>
	</tr>    
	<tr>
		<th>소  속</th>
		<td>
			<input type='text' id="team" name='team' value='<?=$team?>' readonly>
		</td>
	</tr>

	<tr>
		<th>직  위</th>
		<td>
			<input type='text' id="affil" name='affil' value='<?=$affil?>' readonly>
		</td>
	</tr>
	<tr>
		<th>연락처</th>
		<td>
			<input type='text' id='mobile' name='mobile' style='width:180px;' value='<?=$mobile?>' readonly>
		</td>
	</tr>
  <tr>
		<th>휴가기간</th>
		<td>
      <input type="text" name="daterange" id="daterange"  style='width:180px; text-align:center;'/>
     </td>
  </tr>
  <tr>
		<th>회 사 명</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' id='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>대표이사 </th>
		<td><input type='text' name='team' style='width:50px;' value='<?=$ceo_nm?>' readonly></td>
	</tr>
</table>
  
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
  <tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>

				<tr>				

					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form();"><img src="../../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="../../img/board/delete1.gif" border=0></a>&nbsp;

<?
}
?>
						<a href="javascript:reg_list();"><img src="../../img/board/list01.gif" border=0></a>&nbsp;

					</td>

				</tr>
			</table>
		</td>
	</tr>
</table> 
</form>

<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>


<link type='text/css' rel='stylesheet' href='/skins/js/placeholder.css'><!-- 웹킷브라우져용 -->
<script src="/skins/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
<script type="text/javascript">
$('input, textarea').placeholder();
</script>  
  
  
  
  
  
