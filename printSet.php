<?
	include "../../head.php";
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.DbCon.php";
	include "../../array.php";
?>

<link type='text/css' rel='stylesheet' href='./print.css'>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script language="javascript" type="text/javascript">

function printPage() {
	if(window.print){
		agree = confirm('현재 페이지를 출력하시겠습니까?');
		if (agree) window.print();
	}
}

</script> 

<body onload='printPage();'>

<style type="text/css" media="print">
	
	@page {
	    size: auto;  /* auto is the initial value */
	    margin: 0;  /* this affects the margin in the printer settings */
	}
</style>

<div id="wrap">

	<?
		include 'print_ok.php';
	?>

</div>
