<?
     // 최고관리자
     if ($member[mb_id] == 'damha') $is_admin = 'super';
    
     // 그룹관리자
     if ($gr_id == 'jkinstech') {
          if ($member[mb_id] == 'damha') $is_admin = 'super';
     }
    
     // 게시판관리자
     if ($bo_table == '게시판01_아이디입력' || $bo_table == '게시판02_아이디입력' || $bo_table == '게시판03_아이디입력' ) {
          if ($member[mb_id] == '회원_아이디입력') $is_admin = 'super';
          if ($is_admin == 'board') $board[bo_admin] = $member[mb_id];
     }
?>
