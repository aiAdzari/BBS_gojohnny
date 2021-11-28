<?php
    header('content-type:application/json;charset=utf8');
    require('conn.php'); //载入数据库连接文件
    $sql = 'select * from forums';  //获取所有板块表内容
	$que = mysqli_query($conn, $sql); //连接数据库

    if (!$que) {
        printf("Error: %s\n", mysqli_error($conn)); //失败则返回错误
        exit(); 
    }
    
    $results = array();

    while ($row = mysqli_fetch_assoc($que)) {
    $results[] = $row;
    }
 
    if($results){
        echo json_encode($results);
 
    }  else{
        echo false;
    }
    ?>