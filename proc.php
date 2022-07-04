<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Msg.php";


switch($type){

	case 'write' :

		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		//$rArr = explode('-',$rDate);
		//$rTime = mktime(0,0,0,$rArr[1],$rArr[2],$rArr[0]);
		$rDate = date('Y'); // 현재날짜 년
		$rDate2 = date('m'); // 현재날짜 월
		$rDate3 = date('d'); // 현재날짜 일
		$userid = $row["userid"]; // $uid라는 변수가 DB행에 uid를 가져오는 것
		$name = $row["name"]; // 성명
		$affil = $row["affil"]; // 직위
		$team = $row["team"]; // 소속
		$mobie = $row["mobile"]; // 연락처

		$sql = "select * from wo_setup where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result); 

		$actxt01 = $row["actxt01"]; // 회사명
		$cmp_num = $row["cmp_num"]; // 사업자 번호
		$cmp_adr = $row["cmp_adr"]; // 소재지
		$ceo_nm = $row["ceo_nm"]; // 대표이사 성함

		$sql = "select * from wo_leave where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$rDate = date('Y-m-d H:i:s');
		$rTime = time();
		$userip = $_SERVER['REMOTE_ADDR'];
		//$status = "미승인";
		$sql = "insert into wo_leave (uid,userid,name,acting,gubun,vdate01,vdate02,vdate03,vdate04,vdate05,vdate06,daterange) values ('$uid','$userid','$name','$acting','$gubun','$vdate01','$vdate02','$vdate03','$vdate04','$vdate05','$vdate06','$daterange')";
		
		$result = mysql_query($sql);
		$msg = '등록되었습니다';
		$type = 'list';
		
		include '../../job/proc.php';

		break;

	case 'edit' :
		
		$rDate = date('Y'); // 현재날짜 년
		$rDate2 = date('m'); // 현재날짜 월
		$rDate3 = date('d'); // 현재날짜 일

		$sql = "update wo_leave set";
		$sql .= "userid = '$userid', "; // 유저아이디
		$sql .= "name = '$name', "; // 성명
		$sql .= "actxt01 ='$actxt01', "; // 회사명
		$sql .= "cmp_num = '$cmp_num', "; // 사업자번호
		$sql .= "cmp_adr = '$cmp_adr', "; // 소재지
		$sql .= "team = '$team', "; // 소속
		$sql .= "mname = '$mname', "; //
		$sql .= "vdate01 = '$vdate01', "; // 휴가기간1 년 부터
		$sql .= "vdate02 = '$vdate02', "; // 휴가기간2 월 부터
		$sql .= "vdate03 = '$vdate03', "; //휴가기간3 일 부터
		$sql .= "vdate04 = '$vdate04', "; //휴가기간4 일 까지
		$sql .= "vdate05 = '$vdate05', "; //휴가기간5 일 까지
		$sql .= "vdate06 = '$vdate06', "; //휴가기간6 일 까지
		$sql .= "daterange = '$daterange', "; //휴가기간6 일 까지
		$sql .= "rArr = '$rArr', "; // 현재날짜
		$sql .= "gubun = '$gubun', "; // 사용용도
		$sql .= "ceo_nm = '$ceo_nm', "; // 대표이사 성함
		$sql .= "affil = '$affil' "; //  직위
		$sql .= " where name=$name";
		$result = mysql_query($sql);

		$msg = '수정되었습니다';
		$type = 'list';

		break;

	case 'del' :

		$sql = "delete from wo_leave where uid=$uid";
		$result = mysql_query($sql);
		$uid = $row['uid'];
		$msg = '삭제되었습니다';
		$type = 'list';

		break;

	case 'status' :

		$sql = "update wo_leave set ";
		$sql .= "status='승인' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);


		$msg = '승인되었습니다';
		$type = 'list';

		break;
	
	case 'status2' :

		$sql = "update wo_leave set ";
		$sql .= "status2='승인' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		$msg = '승인되었습니다';
		$type = 'list';

		break;

}

	unset($dbconn);
?> 

<form name='frm' method='post' action='up_index.php'>
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
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
</form>

<script language='javascript'>
	alert('<?=$msg?>');
	document.frm.submit();
</script>
