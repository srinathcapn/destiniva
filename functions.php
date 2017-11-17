<?php 
include_once('conn.php');

extract($GLOBALS);

$action = '';
	if (isset($_REQUEST['action'])) {
	    $action = $_REQUEST['action'];
	}

	if ($action == 'insert') {
	   extract($_POST);


	    $query = 'INSERT INTO `contact_us` (`name`,`email_id`,`phone`,`service`,`date`)VALUES("' . $name . '","'. $email_id . '","' . $phone . '","' . $service . '",  "'.$date.'")';
	    $result = mysqli_query($link, $query) or die('Error in Query.' . mysqli_error($link));
	    $req_id = mysqli_insert_id($link);

	    $email_array = array('veema3008@gmail.com','contact@destinivaplanners.com');
        
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
		        
		        $from='info@destinivaplanners.com';
		                    
		        // define the headers we want passed. Note that they are separated with \r\n0
		        $headers  = "From: " . strip_tags($from) . "\r\n";
		        $headers .= "Reply-To: ". strip_tags($email_id) . "\r\n";
		        $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";     
		        $mail_sent = mail($to, $subject, $message, $headers);

		    } 
		    
	    echo json_encode($req_id);
	  
	    mysqli_close($link);
	}

?>