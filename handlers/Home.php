<?php
class Home {
    // GET
    function get( ) {
        if (!is_user_logged_in()):
            if ( ( isset( $_GET['uid'] ) ) && ( isset( $_GET['key'] ) ) ):
                $new_password = rand_string( 8 );
                $user = get_user_by_id($_GET['uid']);
                $args = array(
                    'url' => URL,
                    'title' => "New Password",
                    'text'  => "This is your new password:",
                    'change' => $new_password
                );
                $email_content = template_replacer( $args, 'email.php' );

                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Additional headers
                $headers .= 'To: '.$user['email'].' <'.$user['email'].'>' . "\r\n";
                $headers .= 'From: Platypus <contact@platypus.com>' . "\r\n";
                // Send the email
                if ( !mail( $user['email'], $args['title'], $email_content, $headers ) )
                    $errors['recover']['email'] = "We are sorry, the password could not be reseted.";
                else
                {
                    change_user_password( $_GET['uid'], $_GET['key'], do_hash( $new_password ) );
                    $success['recover']['email'] = "The password has been reseted successfully. Please check your e-mail again.";
                }
                $_POST['recover'] = '';
            endif;

            include 'views/Landing.php';
        else:
            include 'views/Home.php';
        endif;

    }

    // POST
    function post( ) {
        if (!is_user_logged_in()):
            if ( isset( $_POST['login'] ) ):
                if ( !check_email_address( $_POST['email'] ) )
                    $errors['login']['email'] = "Wrong email.";
                else
                    if ( !email_exists( $_POST['email'] ) )
                        $errors['login']['email'] = "Email not found.";
                    if ( !isset( $errors ) )
                        if ( !user_log_in() )
                            $errors['login']['password'] = "Wrong password.";
                        else
                            header( "Location: " . URL );


                        endif;
                    if ( isset( $_POST['register'] ) ):
                        // Verificam email
                        if ( !check_email_address( $_POST['email'] ) )
                            $errors['register']['email'] = "Wrong email.";
                        else
                            if ( email_exists( $_POST['email'] ) )
                                $errors['register']['email'] = "Email already exists.";

                            // Verificam parola
                            if ( strlen( $_POST['password'] ) < 6 )
                                $errors['register']['password'] = "Please insert at least 6 characters";
                            else
                                if ( !ctype_alnum( $_POST['password'] ) )
                                    $errors['register']['password'] = "Password must contain only letters and digits.";

                                // Verificam username
                                if ( user_exists( $_POST['username'] ) )
                                    $errors['register']['username'] = "Username is already taken.";
                                else
                                    if ( !ctype_alnum( $_POST['username'] ) )
                                        $errors['register']['username'] = "Username must contain only letters and digits.";

                                    // Verificam nume
                                    if ( empty( $_POST['name'] ) )
                                        $errors['register']['name'] = "This field is required.";
                                    else
                                        if ( !is_string( $_POST['name'] ) )
                                            $errors['register']['name'] = "Your Name must contain only letters.";
                                        if ( !isset( $errors['register'] ) ) {
                                            $args = array(
                                                'username'  => $_POST['username'],
                                                'email'     => $_POST['email'],
                                                'password'  => do_hash( $_POST['password'] ),
                                                'name'      => $_POST['name']
                                            );
                                            create_user( $args );
                                            session_start();
                                            user_log_in();
                                            header( "Location: " . URL );

                                        }
                                    endif;
                                if ( isset( $_POST['recover'] ) ):

                                    if ( empty( $_POST['email'] ) )
                                        $errors['recover']['email'] = "Please fill in this field with a valid e-mail address.";
                                    else
                                        if ( !email_exists( $_POST['email'] ) )
                                            $errors['recover']['email'] = "E-mail does not exist in our database.";
                                        else {
                                            $data = get_recovery_data( $_POST['email'] );
                                            $args = array(
                                                'url' => URL,
                                                'title' => "Password Recovery",
                                                'text'  => "To reset your password, press the fallowing link.",
                                                'change' => "<a href='".URL."/?uid=".$data['id']."&key=".$data['hash']."'>".URL."/?uid=".$data['id']."&key=".$data['hash']."</a>"
                                            );
                                            $email_content = template_replacer( $args, 'email.php' );

                                            // To send HTML mail, the Content-type header must be set
                                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                            // Additional headers
                                            $headers .= 'To: '.$_POST['email'].' <'.$_POST['email'].'>' . "\r\n";
                                            $headers .= 'From: Platypus <contact@platypus.com>' . "\r\n";
                                            preprint( $args );
                                            // Send the email
                                            if ( !mail( $_POST['email'], $args['title'], $email_content, $headers ) )
                                                $errors['recover']['email'] = "We are sorry, the e-mail could not be sent.";
                                            else
                                                $success['recover']['email'] = "Please check your e-mail and confirm the password reset.";
                                        }





                                    endif;
            include 'views/Landing.php';                         
        else:
            include 'views/Home.php';
        endif;
    }
}
