<?php
/**
 * Created by PhpStorm.
 * User: 红印
 * Date: 2016/9/6
 * Time: 14:25
 */
header("Content-type: text/html;charset=utf-8;");
$array=null;
$keyword=$_POST['keyword'];
if (isset($_POST['user_ID'])){
    $user_ID=$_POST['user_ID'];
    $token=$_POST['token'];
    //date_date_set('PRC');
    $date=date('Y-m-d H:i:s',time());
    $sql = "INSERT INTO record (keyword, user_ID, type,time) VALUES ('$keyword','$user_ID',0,'$date')";
    $new=mysqli_query($conn,$sql);
}

$order=$_POST['order'];
if($order==0){
    if(isset($_POST['school_ID'])){
        $school_ID=$_POST['school_ID'];
        $sql="SELECT * FROM shop WHERE  name LIKE '%$keyword%' AND school_ID='$school_ID' ORDER BY rate DESC";
    }else{
        $sql="SELECT * FROM shop WHERE  name LIKE '%$keyword%' ORDER BY rate DESC";
    }
}else if ($order==1){
    if(isset($_POST['school_ID'])){
        $school_ID=$_POST['school_ID'];
        $sql="SELECT * FROM shop WHERE  name LIKE '%$keyword%' AND school_ID='$school_ID' ORDER BY rate ASC";
    }else{
        $sql="SELECT * FROM shop WHERE  name LIKE '%$keyword%' ORDER BY rate ASC";
    }
}

$result = mysqli_query($conn,$sql);
if(!(mysqli_num_rows($result))){
    echo newjson(10,"没有有关的数据",$array);
}else {
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {//$row = mysqli_fetch_array($result)
        $array[$i]['ID'] = $row['ID'];
        $array[$i]['name'] = $row['name'];
        $array[$i]['address'] = $row['address'];
        $array[$i]['image'] = $row['image'];
        $array[$i]['school_ID'] = $row['school_ID'];
        $array[$i]['rate'] = $row['rate'];
        $i++;
    }
    echo newjson(11,"搜索成功",$array);
}

?>