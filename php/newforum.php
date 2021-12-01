<?php
	require('conn.php'); //连接数据库
	
	$forum_name = $forum_description = $Subject = $time = ''; 
	$Err = $Err = '错误：';
	$Errsum = 0;
	//初始化变量
	if ($_SERVER["REQUEST_METHOD"] == "POST") //检测是否POST表单
	{
		//表单数据接收
		if (empty($_POST["forum_name"]))
    	{
			$Err += "未输入名称";
			$Errsum++;
		}
		else
		{
			$forum_name = test_input($_POST["forum_name"]);
		}
		if (empty($_POST["forum_description"]))
    	{
			$forum_description = "None";
		}
		else
		{
			$forum_description = test_input($_POST["forum_description"]);
		}
		if (empty($_POST["Subject"]))
    	{
			$Err += "未输入类目";
			$Errsum++;
		}
		else
		{
			$Subject = test_input($_POST["Subject"]);
		}
		date_default_timezone_set("PRC");
		$time = date("Y-m-d H:i:s");
		if (!$Errsum)
		{
			$sql="insert into forums (forum_name,forum_description,subject,last_post_time) VALUES ('$forum_name','$forum_description','$Subject','$time')";
			$que = mysqli_query($conn, $sql); //添加到数据库
	
			if($que) //提示
			{
				echo "<script>alert('添加成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
			}
			else
			{
    			echo "<script>alert('添加失败，请稍后再试');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
			}
		}
        else{
            echo "<script>alert('$Err');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        }
	}
function test_input($data)
	//过滤用户输入的非法字符
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
