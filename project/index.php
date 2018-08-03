<?php/*
http_response_code(404);
include('error.php'); // provide your own HTML for the error page
die();
*/
?>


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
        $id=$row['u_id'];
        
        require_once('../model/helpers.php');
        render('../view/header',array('title'=>'RICST'));
        
        
    if(isset($_GET['p_id']) && !empty($_GET['p_id'])){
        $p_id=mysqli_real_escape_string($conn,$_GET['p_id']);
        $sql1="SELECT p_id,access FROM project WHERE u_id='$id' AND p_id='$p_id'";
        $res1=mysqli_query($conn,$sql1);
        
        $n_row1=mysqli_num_rows($res1);
        
        if($n_row1 == 1){
           $row=mysqli_fetch_array($res1);
           if(isset($_GET['page']) && !empty($_GET['page'])){
               $page=$_GET['page'];
               
               switch($page){
                  case 'overview':
                     render('../project/pro_main_page',array('title'=>'RICST','ov'=>'1','p'=>$p_id));
                     break;
                  case 'runs':
                     render('../project/run',array('title'=>'RICST','ru'=>'1','p'=>$p_id));
                     break;
                  case 'service':
                     render('../project/service',array('title'=>'RICST','re'=>'1','p'=>$p_id));
                     break;
                  case 'files':
                     render('../project/file',array('title'=>'RICST','fi'=>'1','p'=>$p_id,'msg'=>''));
                     break;
                  case 'deploy':
                     render('../project/deploy',array('title'=>'RICST','dep'=>'1','p'=>$p_id));
                     break;
                  case 'publish':
                     render('../project/publish',array('title'=>'RICST','pub'=>'1','p'=>$p_id));
                     break;
                  case 'p_activity':
                     render('../project/activity',array('title'=>'RICST','act'=>'1','p'=>$p_id));
                     break;
                  case 'p_settings':
                     render('../project/settings',array('title'=>'RICST','set'=>'1','p'=>$p_id));
                     break;
                  default:
                    //show if page is no in it
                    //error 404
                    break;
                }
           }
           else{
             
           }
           
           
        }
        else{
            //you are not right person to see this
        }
        
        
        
        
      
    }
    else{
        //project id is not set or empty
    }
       
        render('../view/footer',array('title'=>'RICST'));
       
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