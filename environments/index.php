<?php
session_start();


if($_SESSION['authentication']){
    $uname=$_SESSION['u_name'];
    $pass=$_SESSION['pass'];
    $conn=mysqli_connect('localhost','root','shivam');
    $db=mysqli_select_db($conn,'on');

    $sql="SELECT * FROM user WHERE u_name='$uname' AND pass='$pass'";
    $result=mysqli_query($conn,$sql);
    $n_row=mysqli_num_rows($result);
    if($n_row==1){
        $row=mysqli_fetch_array($result);
       
        
        require_once('../model/helpers.php');
        render('../view/header',array('title'=>'RICST'));
        render('../environments/env_main_page',array('title'=>'RICST'));
        render('../view/footer',array('title'=>'RICST'));
        ?>
   
            
             
    
    <?php
       
       
       
    }
    else{
        echo 'not authenticated person';
    }

}
else{
    session_destroy();
    header('Location:../');
}

?>