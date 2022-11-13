
# Digital Library

## Account registration

The account registration has been done using  jquery and php.
This is implemented in the login.php and login_btn_action.php files. 
The db_config.php and email_config.php files are used to establish the connection of the database and email. 
The account registration doesn’t allow duplicate email registrations. 
The same password has to be entered twice for confirmation otherwise an error message is displayed. 
A confirmation email is sent to the user after a successful registration. 
The user can activate his account through the link in the confirmation email. I’ve done this part using the php mail function. 
When the user tries to login an email is sent to the email provided with a verification code. This has to be entered for the user to login to the home page.


