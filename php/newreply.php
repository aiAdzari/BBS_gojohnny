<?php
require('conn.php');
session_start();
$id = $_SESSION['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") //检测是否POST表单
{
    if (check_login()) {
        if (empty($_POST['tiopic_reply'])) {
            echo "<script>alert('笑晕了，未输入哦');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
        } else {
            $tiopic_reply = $_POST['tiopic_reply'];
            $author = $_SESSION['username'];
            date_default_timezone_set("PRC");
            $log_time = date("Y-m-d H:i:s");
            $sql_newreply = "INSERT into tiopic_reply(main_id,author,content,last_post_time)VALUES
    ('$id','$author','$tiopic_reply','$log_time')";
            $que_newreply = mysqli_query($conn, $sql_newreply);
            if (!$que_newreply) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }
            echo "<script>alert('回复成功辣！');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
        }
    } else {
        echo "<script>alert('对不起，你还未登录！');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
    }
}
function check_login()
{
    if (isset($_SESSION['login']) && $_SESSION['login'] === true)
        return $_SESSION['level'];
    else
        return false;
}
