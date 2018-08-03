<?php
sleep(4);

session_start();
 if($_SESSION['authentication']){
    $conn=mysqli_connect('localhost','root','shivam');
    $db=mysqli_select_db($conn,'on');
    $uname=$_SESSION['u_name'];
    $pass=$_SESSION['pass'];
    
    $query="SELECT * FROM user WHERE u_name='$uname' AND pass='$pass'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);
    
     
    
       if($_SERVER["REQUEST_METHOD"]=='POST'){
           $id=$row['u_id'];
           $sql="SELECT * FROM project WHERE u_id='$id'";
           $res=mysqli_query($conn,$sql);
           $n_row=mysqli_num_rows($res);
           
           $ans['no_pro']=$n_row;
           
           if($n_row == 0){
               print(json_encode($ans));
           }
           elseif($n_row > 0){
              $i=0;
              while($rowp=mysqli_fetch_array($res)){
                 $ans[$i]['p']=$rowp['p_id'];
                 $ans[$i]['p_name']=$rowp['p_name'];
                 $eid=$rowp['envoir_id'];
                 $sql1="SELECT env_name FROM env WHERE env_id='$eid'";
                 $res1=mysqli_query($conn,$sql1);
                 $ro1=mysqli_fetch_array($res1);
                 $ans[$i]['env']=$ro1['env_name'];
                 
                 $ans[$i]['access']=$rowp['access'];
                
                 $i++;
              }
              
              print(json_encode($ans));
           }
          
       }
    
    
    
 }
?>