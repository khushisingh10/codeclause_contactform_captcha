<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact form with captcha</title>
    <link rel = "stylesheet" href = "style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div class="contact-form">
    <h2>CONTACT US</h2>
    <form method = "post" actions = "">
        <input type = "text" name = "name" placeholder = "Enter your Name" required>
        <input type = "text" name = "phone" placeholder = "Enter your phone number" required>
        <input type = "email" name = "email" placeholder = "Enter your email" required>
        <textarea name = "message" placeholder = "your message" required></textarea>

        <div class="g-recaptcha" data-sitekey="6Lf2xtMlAAAAAKy29x7bJobvCC2o5wci71UtFUN1"></div>
        
        <input type = "submit" name = "submit" value = "send message" class = "submit-btn">
    </form>

    <div class="status">
        <?php
        if(isset($_POST['submit']))
        {
            $User_name = $_POST['name'];
            $phone = $_POST['phone'];
            $user_email = $_POST['email'];
            $user_message = $_POST['message'];

            $email_from = 'noreply@khushis.com';
            $email_subject = "New Form Submission";
            $email_body = "Name: $User_name.\n".
            "Phone No: $phone.\n".
            "Email Id: $User_email.\n".
            "User Message: $user_email.\n";

            $to_email = "khushikhu630@gmail.com";
            $headers = "From: email_from \r\n";
            $headers .= "Reply-To: user_email \r\n";

            $secretKey = "6Lf2xtMlAAAAANHQasMpMdomLUhJbRYhNHDcsRBQ";
            $responseKey = $_POST['g-recaptcha-response'];
            $UserIP = $_SERVER['REMOTE_ADDR'];
            $url = " https://www.google.com/recaptcha/api/siteverify?
            secret=$secretKey&response=$responseKey&remoteip=$UserIP";

            $response = file_get_contents($url);
            $response = json_decode($response);

            if ($response->success)
            {
                mail($to_email,$email_subject,$email_body,$headers);
                echo "Message sent successfully";
            }
            else{
                echo "<span>Invalid Captcha, Please try later again</span>";
            }


        }
        ?>
    </div>
    </div>



</body>
</html>