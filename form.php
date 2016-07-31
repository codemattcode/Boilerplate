<?php
  if(empty($_POST) === false ) {
    $errors = array();

    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];
    
    if (empty($name) === true || empty($email) === true || empty($message) === true ) {
      $errors[] = 'Name, email and message are required!';
    } else {
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          $errors[] = 'That is not a valid email address';
      }
      if (ctype_alpha($name) === false) {
        $errors[] = 'Name must only contain letters!';
      }

      if (empty($errors) === true) {
        mail('test@srrc.com', 'Client-Name-Domain : Contact Form Message', $message, 'From: ' . $email);
        header('Location: index.php?sent');
      }

    }

  }

    // print_r($errors);
?>
<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title></title><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body>
    


    


<!-- 
/* 
  *****************
  * =FORM
  *****************
*/ -->
        <?php
          if (isset($_GET['sent']) === true ) {
            echo '<p>Your form has been sent</p>';
          } else {


            if(empty($errors) === false) {
              echo '<ul>';
              foreach($errors as $error) {
              echo '<li>', $error, '</li>';
              }
              echo '</ul>';
            }

          ?>

          <form action="" method="post">
            <p>
              <label for="name">Name:</label><br>
              <input type="text" name="name" id="name" placeholder="Enter Your Name" <?php if (isset($_POST['name']) === true) { echo 'value="', strip_tags($_POST['name']), '"'; } ?>>
            </p>
            <p>
              <label for="email">Email:</label><br>
              <input type="text" name="email" id="email" placeholder="Enter Your Email Address" <?php if (isset($_POST['email']) === true) { echo 'value="', strip_tags($_POST['email']), '"'; } ?>>
            </p>
            <p>
              <label for="message">Message:</label><br>
              <textarea name="message" id="message" placeholder="Enter Your Message" cols="30" rows="10"><?php if (isset($_POST['message']) === true) { echo strip_tags($_POST['message']); } ?></textarea>
            </p>
            <p>
              <input type="submit" value="Submit">
            </p>
          </form>

        <?php
        }
        ?>
<!-- /* 
  *****************
  * =/FORM
  *****************
*/ -->




</body></html>
