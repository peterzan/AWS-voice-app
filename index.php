<?php

// @start snippet
/* Define Menu */
$web = array();
$web['default'] = array('receptionist','sms', 'email', 'resume');

/* Get the menu node, index, and url */
$node = $_REQUEST['node'];
$index = (int) $_REQUEST['Digits'];
$url = 'http://accountname.yourefavoritehostingservice.com/index.php';

/* Check to make sure index is valid */
if(isset($web[$node]) || count($web[$node]) >= $index && !is_null($_REQUEST['Digits']))
	$destination = $web[$node][$index];
else
	$destination = NULL;
// @end snippet

// @start snippet
/* Render TwiML */
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><Response>\n";
switch($destination) {
	case 'sms': ?>
        	<Sms>Hi!  Here's where you can learn more about me.  View my LinkedIn profile at: www.linkedin.com/in/accountname and follow me on Twitter: www.twitter.com/accountname</Sms>
            <Say>Thanks!  A text message has been sent to your mobile phone.  You can hang up now or stay on the line for more info about me.</Say>
        <?php break;
	case 'email': ?>
    		<Sms>HI!  Just click on this email address address@email.com and you can send an email to me</Sms>
            <Say>Thanks!  A text message has been sent to your mobile phone with an embedded email address.  You can hang up or stay on the line for more info about me.</Say>
        <?php break;
	case 'resume': ?>
		<Say>blah blah blah</Say>
        <Say>blah blah blah</Say>
		<Say>blah blah blah</Say>
		<Say>blah blah blah</Say>
        <Say>You can learn more about me by pressing 1 at the top of this menu</Say>
		<?php break;	
	case 'receptionist'; ?>
		<Say>Please wait while you're connected directly to Peter</Say>
		<Dial callerId="+1-800-555-1212">800-555-1212</Dial>
		<?php break;
	default: ?>
		<Gather action="<?php echo 'http://accountname.yourefavoritehostingservice.com/index.php?node=default'; ?>" numDigits="1">
			<Say>Hi, I'm Peter Zan, and thanks for calling</Say>
            <Say>To have this application send you a text message with links to more information about me, press 1</Say>
            <Say>To have this application send you a text message with an email address so you can send me an email, press 2</Say>
            <Say>To hear some highlights of my professional background, press 3</Say>
			<Say>To speak to me personally, press 0</Say>
		</Gather>
		<?php
		break;
}
// @end snippet

// @start snippet
if($destination && $destination != 'receptionist') { ?>
	<Pause/>
	<Say>Main Menu</Say>
	<Redirect><?php echo 'http://accountname.yourefavoritehostingservice.com/index.php' ?></Redirect>
<?php }
// @end snippet

?>

</Response>
