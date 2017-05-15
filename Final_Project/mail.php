<?php 



            // checks if the form has been submitted or not
          	if(isset($_POST["submit"])) {

                    $name= filter_input( INPUT_POST, trim('name'), FILTER_SANITIZE_STRING );
                    $email= filter_input( INPUT_POST, trim('email'), FILTER_SANITIZE_STRING );
                    $affiliation= filter_input( INPUT_POST, trim('affiliation'), FILTER_SANITIZE_STRING );
                    $involved= filter_input( INPUT_POST, trim('involved'), FILTER_SANITIZE_STRING );
                    $info= filter_input( INPUT_POST, trim('comment'), FILTER_SANITIZE_STRING );


                    echo "Name: $name \n Email: $email \n Affiliation: $affiliation \n $Involved: $involved \n Comment: $info";


                        // EDIT THE 2 LINES BELOW AS REQUIRED
    		$email_to = "nas95@cornell.edu";
    		$email_subject = "CONTACT US";

  
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Affiliation: ".clean_string($affiliation)."\n";
    $email_message .= "Involved: ".clean_string($involved)."\n";
    $email_message .= "Comments: ".clean_string($info)."\n";
 
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers); 
 
      }
        
?>