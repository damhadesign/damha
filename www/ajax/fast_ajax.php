<?php
include_once('../common.php');

$bo_table = 'damhadb';
$write_table = 'g5_write_'.$bo_table;
$wr_num = get_next_num($write_table);
$wr_reply = '';
$wr_name = $_POST['wr_name'];
$wr_1 = $_POST['wr_1'];
$wr_8 = $_POST['wr_8'];
$ca_name = $_POST['ca_name'];
$wr_content = $_POST['wr_content'];
$wr_subject = '빠른 상담신청이 접수되었습니다.';
$wr_password = get_encrypt_string('1234');
$wr_datetime = G5_TIME_YMDHIS;
$query = "
	INSERT into {$write_table}
	SET
		wr_num = '{$wr_num}',
		wr_reply = '{$wr_reply}',
		wr_comment = 0,
		ca_name = '{$ca_name}',
		wr_option = 'secret',
		wr_subject = '{$wr_subject}',
		wr_content = '{$wr_content}',
		wr_link1 = '',
		wr_link2 = '',
		wr_link1_hit = 0,
		wr_link2_hit = 0,
		wr_hit = 0,
		wr_good = 0,
		wr_nogood = 0,
		mb_id = '',
		wr_password = '{$wr_password}',
		wr_name = '$wr_name',
		wr_email = '',
		wr_homepage = '',
		wr_datetime = '".G5_TIME_YMDHIS."',
		wr_last = '".G5_TIME_YMDHIS."',
		wr_ip = '{$_SERVER['REMOTE_ADDR']}',
		wr_1 = '$wr_1',
		wr_8 = '$wr_8';
";
$result = sql_query($query);

$wr_id = sql_insert_id();
sql_query("UPDATE {$write_table} SET wr_parent = '{$wr_id}' WHERE wr_id = '{$wr_id}';");
sql_query("INSERT INTO {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) VALUES ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$member['mb_id']}' ) ");
sql_query("UPDATE {$g5['board_table']} SET bo_count_write = bo_count_write + 1 WHERE bo_table = '{$bo_table}'");

$return = array();
$return['result'] = $result;

echo json_encode($return);
?>

