<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	$userid = $_POST['userid'];
	$resArr = Array();

	if($userid){
		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$name = $row['name']; //�̸�
		$team = $row['team']; //�Ҽ�
		$affil = $row['affil']; //����
		$mobile = $row['mobile']; //����ó

	}

	$resArr['name'] = $name; // ��ü���
	$resArr['team'] = iconv ('euc-kr','utf-8',$team); //�Ҽ�
	$resArr['affil'] = iconv ('euc-kr','utf-8',$affil); //����
	$resArr['mobile'] = iconv ('euc-kr','utf-8',$mobile); // ����ó


	$json = json_encode($resArr);
	echo $json;
?>