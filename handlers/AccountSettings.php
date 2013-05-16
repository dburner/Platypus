<?php
class AccountSettings {

    function get($slug) {
    	$user = get_user_by_id($_SESSION['id']);
    	include('views/AccountSettings.php');
    }
    function post($slug) {
    	if (isset($_POST['account_info'])):
    		if (update_user($_SESSION['id'], 'name', $_POST['name'])):
	    		$_SESSION['name'] = $_POST['name'];
	    		$success['account_info']['name'] = "The field has been successfully updated.";
	    	else:
	    		$errors['account_info']['name'] = "We are sorry but something went wrong, try again later.";
	    	endif;

            // Define a destination
            $targetFolder = '/media'; // Relative to the root
            if (!empty($_FILES['file_upload']['name'])) {
                $tempFile = $_FILES['file_upload']['tmp_name'];
                $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
                $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file_upload']['name'];
                
                // Validate the file type
                $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
                $fileParts = pathinfo($_FILES['file_upload']['name']);
                
                if (in_array($fileParts['extension'],$fileTypes)) {
                    move_uploaded_file($tempFile,$targetFile);
                    $success['account_info']['file_upload'] = "The image has been successfully uploaded.";
                    update_user_meta($_SESSION['id'], 'avatar', $targetFolder."/".$_FILES['file_upload']['name']);
                } else {
                    $errors['account_info']['file_upload'] = "We are sorry but something went wrong, try again later.";
                }
            }




    	endif;

    	if (isset($_POST['change_password']))
    	{
    		if (!check_password($_SESSION['id'], $_POST['current_password']))
	    		$errors['change_password']['current_password'] = "The password you have entered is incorrect.";
	    	else
	    	{
	    		if ( strlen( $_POST['new_password'] ) < 6 )
                    $errors['change_password']['new_password'] = "Please insert at least 6 characters";
                else
                {
             		if ( !ctype_alnum( $_POST['new_password'] ) )
                        $errors['change_password']['new_password'] = "Password must contain only letters and digits.";
                    else
                    {
                    	if ($_POST['new_password'] != $_POST['new_password2'])
	                        $errors['change_password']['new_password2'] = "Passwords do not match";
	                    else
	                    {
			    			$success['change_password']['change'] = "The password has been successfully updated.";
	                    	change_user_password($_SESSION['id'], do_hash($_POST['current_password']), do_hash($_POST['new_password']));
	                    }
                    }       	
                }
	    	}
    	}
    	include('views/AccountSettings.php');
    }

}