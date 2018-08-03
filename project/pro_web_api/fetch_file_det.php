

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
           $fid=mysqli_real_escape_string($conn,$_POST['id']);
           $sql="SELECT * FROM files WHERE u_id='$id' AND f_id='$fid'";
           $res=mysqli_query($conn,$sql);
           $n_row=mysqli_num_rows($res);
          
           
           if($n_row == 0){
              // print(json_encode($ans));
           }
           elseif($n_row > 0){
             
                 $rowp=mysqli_fetch_array($res);
                 $ans['f_name']=$rowp['f_name'];
                 if($rowp['owner_id'] == $id){
                    $ans['owner']=$row['email'];
                 }
                 else{
                    //
                 }
                $ans['type']=$rowp['f_type'];
                $ans['size']=$rowp['f_size'];
                $ans['ver']=$rowp['version'];
                $ans['time']=$rowp['u_time'];
              
              print(json_encode($ans));
           }
          
       }
    
    
    
 }
?>
