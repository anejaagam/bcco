<?php
$field_name = $_POST['cf_name'];
$field_email = $_POST['cf_email'];
$field_subject = $_POST['cf_subject'];
$field_message = $_POST['cf_message'];

$mail_to = 'inovacomputerassociation@gmail.com';

if( $field_subject !== '' ) {
		$subject = $field_subject;
} else {
		$subject = 'Message to bcco-inovaca.org';
}

//If a name was entered, continue
if( !empty ( $field_name ) && !empty ($field_message) ) {
		//If it's a valid email address, continue
		if( !filter_var($field_email, FILTER_VALIDATE_EMAIL) === false ) {
			$body_message = 'From: '.$field_name."\n";
			$body_message .= 'E-mail: '.$field_email."\n";
			$body_message .= 'Message: '.$field_message;

			$headers = 'From: '.$field_email."\r\n";
			$headers .= 'Reply-To: '.$field_email."\r\n";

			$mail_status = mail($mail_to, $subject, $body_message, $headers);

			if ($mail_status) { ?>
				<script language="javascript" type="text/javascript">
					alert("Thank you for the message. We'll get back to you as soon as possible.");
					window.location = '/';
				</script>
			<?php
			}
			else { ?>
				<script language="javascript" type="text/javascript">
					alert('Message failed.');
					window.location = '/';
				</script>
			<?php
			}
		}
		else { ?>
			<script language="javascript" type="text/javascript">
				alert('Please enter a valid email address');
				window.location = '/';
			</script>
		<?php
		}
}
else { ?>
	<script language="javascript" type="text/javascript">
		alert('One or more fields were empty');
		window.location = '/';
	</script>
<?php
}
?>
