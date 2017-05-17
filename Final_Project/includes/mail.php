
           
<?php 

                    $nameErr ="";
                    $emailErr ="";
                    $affiliationErr ="";
                    $involvedErr="";
                    $commentErr="";


            // checks if the form has been submitted or not
            if(isset($_POST["submit"])) {


                    // if (!isset($_POST["affiliation"])) {
                    //     echo "EMPTY EMPTY EMPTY";
                    // } 


                if( (!empty($_POST["name"])) && (!empty($_POST["email"])) && (($_POST["affiliation"])!='empty') && (!empty($_POST["involved"])) ) {



                    function test_input($data) {
                      $data = trim($data);
                      $data = stripslashes($data);
                      $data = htmlspecialchars($data);
                      return $data;
                    }



                       $name = test_input($_POST["name"]);
                       $name= filter_var( $name, FILTER_SANITIZE_STRING );
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                          $nameErr = "<br>Only letters and white space allowed<br>"; 
                        }
                    
  
   
                        $email = test_input($_POST["email"]);
                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                        // check if e-mail address is well-formed
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                          $emailErr = "<br>Invalid email format"; 
                        }
                
                   

                    $affiliation= filter_input( INPUT_POST, trim('affiliation'), FILTER_SANITIZE_STRING );
                    $involved= filter_input( INPUT_POST, trim('involved'), FILTER_SANITIZE_STRING );



                    $info = test_input($_POST["comment"]);
                    $info= filter_var($info, FILTER_SANITIZE_STRING );




                    // EDIT THE 2 LINES BELOW AS REQUIRED
                    $email_to = "saaccornell@gmail.com";
                    $email_subject = "CONTACT US";

                    if ($nameErr==="" && $emailErr===""){

                        $email_message="Name: $name \n Email: $email \n Affiliation: $affiliation \n Involved: $involved \n Comment: $info";





                        mail($email_to, $email_subject, $email_message); 

                        echo "<p> Thank You. Your information has been recorded<p>";

                    }
                    else {
                        echo "<p class= 'error'>INVALID INPUT. Please try again.";
                    }


 
                }
                else {

                     echo "<p class= 'error'>Please fill out all required information";

                    if (empty($_POST["name"])) {
                        $nameErr = "Name is required";
                    } 
                    if (empty($_POST["email"])) {
                        $emailErr = "Email is required";
                    } 
                    if (($_POST["affiliation"])==='empty') {
                        $affiliationErr = "Answer is required";
                    } 
                    if (empty($_POST["involved"])) {
                        $involvedErr = "Answer is required";
                    } 
                    if (empty($_POST["comment"])) {
                        $commentErr = "Comments are required";
                    } 
                }

            }


        
?>

