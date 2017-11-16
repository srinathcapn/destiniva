<?php 


include_once('conn.php');

extract($GLOBALS);

$action = '';
	if (isset($_REQUEST['action'])) {
	    $action = $_REQUEST['action'];
	}

	if ($action == 'insert') {
	   extract($_POST);
	   // print_r($_POST);


	    $query = 'INSERT INTO `contact_us` (`name`,`email_id`,`phone`,`service`,`date`)VALUES("' . $name . '","'. $email_id . '","' . $phone . '","' . $category . '",  "'.$date.'")';
	    $result = mysqli_query($link, $query) or die('Error in Query.' . mysqli_error($link));
	    $req_id = mysqli_insert_id($link);

	    $email_array = array('veema@appinessworld.com');
        
		    for($e=0;$e<count($email_array);$e++)
		    {
		        $to  =  $email_array[$e];
		        $subject = 'Contact Us Enquiry';

		        // define the message to be sent. Each line should be separated with \n
		        $message = "<html>
		                        <body>
		                            <table>
		                                <tr><td>Name</td><td>:</td><td>".$name."</td></tr> 
		                                <tr><td>Phone Number</td><td>:</td><td>".$phone."</td></tr>
		                                <tr><td>Email</td><td>:</td><td>".$email_id."</td></tr>
		                                <tr><td>Service</td><td>:</td><td>".$service."</td></tr>
		                                <tr><td>Date</td><td>:</td><td>".$date."</td></tr>
		                            </table>
		                        </body>
		                    </html>";   
		                    
		        // define the headers we want passed. Note that they are separated with \r\n
		        $headers  = "From: " . strip_tags($email_id) . "\r\n";
		        $headers .= "Reply-To: ". strip_tags($email_id) . "\r\n";
		        $headers .= "MIME-Version: 1.0\r\n";
		        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";      
		        $mail_sent = mail($to, $subject, $message, $headers);
		    } 
		    // echo $mail_sent;
	    echo json_encode($req_id);
	  
	    mysqli_close($link);
	}

?>