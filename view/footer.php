<?php
session_start();
 if($_SESSION['authentication']){
    $conn=mysqli_connect('localhost','root','shivam');
    $db=mysqli_select_db($conn,'on');
    $uname=$_SESSION['u_name'];
    $pass=$_SESSION['pass'];
    
    $query="SELECT * FROM user WHERE u_name='$uname' AND pass='$pass'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);
    
?>


            <div style="right: 0;left: 0;height:60px;bottom: 0;background-color:white;position: fixed;border-top:solid;border-top-color:#ddd;border-top-width:1px;">
                
                 <div style="width: 40%;height: inherit;float: left;">
                    <center>
                        <div style="width: 90%;height: inherit">
                            <div style="width: 100%;height:15px;"></div>
                             <span class="footer_span" align="left" style="float: left;">
                                <a class="footer_a" href="">ricst.in</a>
                                &nbsp &nbsp
                                <a class="footer_a" href="">Blogs</a>
                                &nbsp &nbsp
                                <a class="footer_a" href="">Documentation</a>
                                &nbsp &nbsp
                                <a class="footer_a" href="">Careers</a>
                                 &nbsp &nbsp
                                 <button class="footer_button">Support</button>
                             </span>
                        </div>
                    </center>
                   
                 </div>
                 <div style="width: 20%;height: inherit;float: left;"></div>
                 <div style="width: 40%;height: inherit;float: left;">
                     <center>
                          <div style="width: 85%;height: inherit;">
                             <div style="width: 100%;height: 13px;"></div>
                             <div style="width: 60px;height: 30px;float: right">
                                 <img src="../img/help.png" style="float: right;">
                             </div>
                             <div style="width: 60px;height: 30px;float: right">
                                 <img src="../img/chat.png" style="float: right;">
                             </div>
                             <div style="width: 60px;height: 30px;float: right">
                                 <img src="../img/notification.png" style="float: right;">
                             </div>
                             <div style="width: 60px;height: 30px;float: right">
                                 <img src="../img/c_req.png" style="float: right;">
                             </div>
                          </div>
                     </center>
                 </div>
             </div>
           
            
        </body>
    </html>
    

<?php
 }
 else{
    
 }
?>