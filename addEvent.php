<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="keywords">
        <title>ADD EVENT</title>
        <link rel="stylesheet" href="style.css" />
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
        <div class="logo">
            <a><img src="Music.png" alt="Music"></a>
        </div>
        <nav class="horizontal">
            <ul class="mainmenu">
                <li>
                    <a href="#" class="submenuTitle">Members &#9654;</a>
                    <ul class="submenu">
                        <li><a href="register.php">Registration</a></li>
                        <li><a href="login_member.php">Log In</a></li>
                        <li><a href="editprofile.php">Edit Profile</a></li>
                        <li>
                            <a href="#" class="submenuTitle1">Bookings &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href="#">Book A Ticket</a></li>
                                <li><a href="cancelbooking.php">Cancellation</a></li>
                                <li><a href="view_booking.php">View Status</a></li>
                                <li><a href="qrcode.php">QR code</a></li>
                            </ul>
                        </li>
                        <li><a href="memfeedback.php">Feedback</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenuTitle">Admin &#9654;</a>
                    <ul class="submenu">
                        <li><a href="login_staff.php">Log In</a></li>
                        <li>
                            <a href="#" class="submenuTitle1">Member &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href='view_block_member.php'>1. View / Block Members</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="submenuTitle1">2. Bookings &#9654;</a>
                            <ul class="sub-menu">
                                <li><a href='manage_booking.php'>2. View Booking Records</a></li>
                                <li><a href="viewfeedback.php">View Feedback</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="submenuTitle">Event &#9654;</a>
                    <ul class="submenu">
                        <li><a href="event.php">View event</a></li>
                        <li><a href="event1.php">Search Event</a></li>
                        <li><a href="event2.php">Search Event</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    
    <section>
          <div>
	<form action="addEvent.php" method="post">  
	<p>
		[ <a>Event List</a> | <a>Add Event</a> ]
	</p>
	<h1>Add Event</h1>
	<table border="1" cellpadding="5" cellspacing="0">
		<tr>
			<td>Event Title</td>
			<td><input type="text" name="event_title" value="" maxlength="10" /></td>
		</tr>
		<tr>
			<td>Event Description</td>
			<td><input type="text" name="event_description" value="" /></td>
		</tr>
		<tr>
                    <td>Event Date and Time</td>
                    <td> <input type="datetime-local" id="event_date_time" name="event_date_time" value="<?php echo htmlspecialchars($event_date_time); ?>" /> /></td>

		</tr> 
		<tr>
			<td>Event Image</td>
			<td><input type="file" id="event_image_upload" name="event_image_upload" accept="image/*" /></td>

		</tr>
                <tr>
			<td>Event Total Seat</td>
                        <td><input type="text" name="total_seat" value="" /></td>
		</tr>
	</table>
	<br>
	<input type="submit" name="add" value="Add" />
	<input type="button" value="Cancel" onclick="" />
	</form>

    
        <?php
        $event_title = "";
        $event_description = "";
        $event_date_time ="";
        $event_image1 = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
       if (empty($_POST["event_title"])) {
         $error[] = "Event title is required.";
     } else {
         $event_title = trim($_POST["event_title"]);
    }

   
     if (empty($_POST["event_description"])) {
         $error[] = "Event description is required.";
     } else {
        $event_description = trim($_POST["event_description"]);
     }

   
     if (empty($_POST["event_date_time"])) {
        $error[] = "Event date and time are required.";
     } else {
        $event_date_time = trim($_POST["event_date_time"]);
     }
     
     if (empty($_POST["event_image1"])) {
        $error[] = "Event poster required";
     } else {
        $event_date_time = trim($_POST["event_image1"]);
     }
     
     if (empty($_POST["total_seat"])) {
        $error[] = "Event total seat required";
     } else {
        $event_date_time = trim($_POST["total_seat"]);
     }
        
        if (!empty($_POST)){
            $error= array();
            
            if(empty($error)){
                
                $event_title = $_POST['event_title'];
                $event_description = $_POST['event_description'];
                $event_date_time=$_POST['event_date_time'];
                $event_image = $_POST['event_image1'];
                $total_seat=$_POST['total_seat'];
                
                require_once('mysqli_conncet.php');
                $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die ("Could not connect to database: ". mysqli_connect_error());
                $sql_insertRecord="INSERT INTO events (event_title,event_description,event_date_time,event_image1,total_seat) VALUES ('$event_title','$event_description','$event_date_time','$event_image1','$total_seat')";
                $result_insertRecord = mysqli_query($mysqli, $sql_insertRecord);
            }
            else{ echo "<ul class='error'>";
            foreach($error as $value){
                echo"<li></li>";
            }
            echo"</ul>";
            }
            mysqli_close($mysqli); 
        }
        }
        ?>
            </div>
        </section>
    </body>	
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
<footer>  
    <nav class="navi">
        <p class="help">HELP</p>
        <a href="aboutus.html">About Us</a>
        <a href="memfeedback.php">Customer Feedback & Review</a>
        <a href="FAQ.php">FAQ</a>
    </nav>
</footer>
</html>