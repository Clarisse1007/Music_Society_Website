<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="keywords">
    <title> ADMIN LOGIN </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css">
    
</head>
    <section>
        <div>
            <table border="0" cellpadding="5">
            <tr>
                <td>
                    <center><h2>ADMIN LOGIN</h2></center><hr>
                    <form action="login_staff.php" method="POST">

<?php
        function detecterror ($adminID,$password){
            $error = array();
            if ($adminID == null){
                    $error['adminID'] = "Please enter AdminID ID.";
		}
            else if(!preg_match('/^[0-9]{1,20}$/',$adminID)){
                    $error['adminID']="Invalid Admin ID!Please try again!";
                }
            if($password == null){
                    $error['password']="Please enter your password.";
                }
            else if(!preg_match('/^[0-9]{3,20}$/',$password)){
                    $error['password']="Invalid password,Please try again!";
                }
            if(empty($error)) { 
            return null;
            } 
            else {
            return $error;
    }
        }
        
?>
<?php
    if (isset($_POST['adminID']) && isset($_POST['password'])) {      
    	$adminID = $_POST['adminID'];
	$password = $_POST['password'];
	
	//~~~~~~validation
    	if ($adminID != '2') {
                echo "<p><h2> <font color='red'> Invalid Admin ID! Please try again! </font> </h2></p>";
                echo "<p><a href='login_staff.php'>Click here to try again</a></p>";
                return;
        }
        $error = detecterror($adminID,$password);
        if (isset($error)) {
        foreach($error as $key => $value) {
            echo "<p><h2> <font color='red'> $value </font> </h2></p>";
        }
        return;
    }
        else{
            require_once('mysqli_conncet.php');
            $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Could not connect to MySQL:'.mysqli_connect_error());
            $sql_readRecord = "SELECT * FROM members WHERE member_id = '$adminID'";
            $adminID = mysqli_real_escape_string($mysqli, $adminID);
            $result_readRecord = mysqli_query($mysqli, $sql_readRecord); 
            $count = 0;
		if ($result_readRecord) {           
			$row = mysqli_fetch_array($result_readRecord, MYSQLI_ASSOC);
			if (isset($row['member_id']) && isset($row['member_password']) && mysqli_num_rows($result_readRecord) == 1 && $row['member_password'] == $password) {
				$count++;	
                                header("Location:adminHeader.html");

				echo "Login Successfully" . "<br>";
				echo "Welcome " . $row['member_name'] . "<br>";
				//session_start();
				//$_SESSION['username'] = $row['student_name'];
        			//exit();
			}  
	
			if ($count == 0) {   
				echo "Access Denied" . "<br>";
			}        
        	} 
    	} 
    }
?>
                            <label>Admin ID</label>
                            <input type="text" name="adminID" value="">
                            <br><br>
                            <label>Password</label>
                            <input type="password" name="password" value="">
                            <br><br>
                            <button type="submit">LOGIN</button>
                            <br><br>
                    </form>
                </td>
            </tr>  
            </table>
        </div>
    </section>
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.submenuTitle').click(function() {
                    $(this).next('.submenu').slideToggle();
                });

                $('.submenu a').click(function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    window.location.href = url;
                });
            });
        </script>
    </body>
</html>