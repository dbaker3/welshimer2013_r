<?php
/**
Template Name: Group Reservation Form
 */
remove_filter('the_content', 'wpautop'); // Keeps WP from adding the annoying <p> and <br /> tags to content

?>

<?php
	//If the form is submitted
	if(isset($_POST['submit'])) {

	//Check the honeypot
		if(trim($_POST['laylah']) !== '') {
			$honeypotError = 'You may not be human, please try again.';
			$hasError = true;
		}
	//Assign patron_name to vairable $patron_name
		$patron_name = trim($_POST['patron_name']);
	//Check for empty string
		if($patron_name === '') {
			$nameError = 'You must enter your name.';
			$hasError = true;
		}

	//Assign patron_email to vairable $patron_email
		$patron_email = strtolower(trim($_POST['patron_email']));
	//Check for empty string
		if($patron_email === '') {
			$emailError = 'You must enter your email address.';
			$hasError = true;
	//Check for valid email address
		} else if (!eregi("^[a-z0-9._%-]*@.*milligan\.edu$", strtolower(trim($_POST['patron_email'])))) {
			$emailError = 'You must enter a valid Milligan email address.';
			$hasError = true;
		}

	//Assign time_date to variable $time_date
		$time_date = trim($_POST['time_date']);
	//Assign valid time to variable $time_start_valid (false if invalid)
		$time_date_valid = strtotime($time_date);
	//Check for empty string
		if($time_date === '') {
			$dateError = 'You must enter a date.';
			$hasError = true;
	//Check for valid date
		} else if ($time_date_valid === false){
			$dateError = 'You must enter a valid date (e.g. 11/4/2012).';
			$hasError = true;
	// Ensure future date
		} else if ($time_date_valid < strtotime('today')) {
			$dateError = 'Please pick a date in the future. Milligan does not allow time travel on campus.';
			$hasError = true;
		}

	//Assign time_start to variable $time_start
		$time_start = trim($_POST['time_start']);
	//Assign valid time to variable $time_start_valid (false if invalid)
		$time_start_valid = strtotime($time_start);
	//Check for empty string
		if($time_start === '') {
			$timeStartError = 'You must enter a start time.';
			$hasError = true;
	//Check for valid start time
		} else if ($time_start_valid === false) {
			$timeStartError = 'You must enter a valid start time (e.g. 7:30 PM).';
			$hasError = true;
		}


	//Assign time_end to variable $time_end
		$time_end = trim($_POST['time_end']);
	//Assign valid time to variable $time_end_valid (false if invalid)
		$time_end_valid = strtotime($time_end);
	//Check for empty string
		if($time_end === '') {
			$timeEndError = 'You must enter an end time.';
			$hasError = true;
	// Check for valid end time
		} else if ($time_end_valid === false) {
			$timeEndError = 'You must enter a valid end time (e.g. 10:45 PM).';
			$hasError = true;
	// Check fhat end time is later than start time
		} else if ($time_end_valid <= $time_start_valid) {
			$timeEndError = 'Your end time must be later than your start time. You are not a time traveler.';
			$hasError = true;
	// Check that start/end spread is no greater than 4 hour (14400 seconds)
		} else if ($time_end_valid - $time_start_valid > 14400 && $time_start_valid !== false) {
			$timeEndError = 'You may not reserve a room for more than four hours at a time.';
			$hasError = true;
		}

	//Assign patron_purpose to variable $patron_purpose
		$patron_purpose = trim($_POST['patron_purpose']);
	//Check for empty field
		if($patron_purpose === '') {
			$purposeError = 'Please specify why you wish to use the room.';
			$hasError = true;
		}

	//Assign reserve_room to variable $reserve_room
		$reserve_room = trim($_POST['reserve_room']);
	//Check for empty string
		if($reserve_room === '') {
			$roomError = "You must select a room. Select 'Other' if you are unsure.";
			$hasError = true;
		}

	//Assign patron_message to variable $patron_message
		$patron_message = trim($_POST['patron_message']);
	//Validate: nothing for now
		if($patron_message === '') {
			// If empty string
		}

		if(!isset($hasError)) {
			$emailTo = 'library@milligan.edu';
			$subject = 'Group Room Reservation Request';
			$body = '<h4>Reservation Request made ' . date("F j, Y, g:i a") .'</h4>';
				$body .= '<p><strong>Requested by: </strong>' . $patron_name . ' [' . $patron_email . ']</p>';
				$body .= '<p><strong>Date: </strong>' . date('D, M j, Y', $time_date_valid) . ' from ' . date('g:i A', $time_start_valid) . ' &ndash; ' . date('g:i A', $time_end_valid) . '</p>';
				$body .= '<p><strong>For: </strong>' . $patron_purpose . '</p>';
				$body .= '<p><strong>Room: </strong>' . $reserve_room . '</p>';
				$body .= '<p><strong>Special Instructions: </strong></p><p>' . $patron_message . '</p>';

			$headers[] = 'From: Group Reservation Webform <library@milligan.edu>';
			$headers[] = 'Reply-To: ' . $patron_email;
			$headers[] = 'content-type: text/html';

			wp_mail( $emailTo, $subject, $body, $headers );

			$emailSent = true;
			}
	} ?>

<?php get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('body-text'); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content welshimer-form">
							<?php the_content(); ?>

								<?php if(isset($emailSent) && $emailSent == true): ?>

									<div class="alert success">
										<p>Your request has been successfully submitted. You will be notified via email when your reservation has been confirmed.</p>
										<p><a class="submit full"href="<?php the_permalink() ?>">Submit Another Request</a>
										</div>

								<?php else: ?>
									<?php if(isset($hasError)): ?>
									<div class="alert fail">
										<?php if(isset($honeypotError)){echo $honeypotError . '<br />';}?>
										<?php if(isset($nameError)){echo $nameError . '<br />';}?>
										<?php if(isset($emailError)){echo $emailError . '<br />';}?>
										<?php if(isset($dateError)){echo $dateError . '<br />';}?>
										<?php if(isset($timeStartError)){echo $timeStartError . '<br />';}?>
										<?php if(isset($timeEndError)){echo $timeEndError . '<br />';}?>
										<?php if(isset($purposeError)){echo $purposeError . '<br />';}?>
										<?php if(isset($roomError)){echo $roomError . '<br />';}?>
									</div>

									<?php endif; ?>
									<!--Group Room Reservation Form -->
									<form action="<?php the_permalink(); ?>" method="post">
									<!-- name -->
										<p class="form"><label class="label" for="patron_name">Name:* </label><input tabindex="1" class="text three-fourths <?php if(isset($nameError)){echo 'fail';}?>" type="text" name="patron_name" value="<?php if(isset($patron_name)){echo $patron_name;} ?>"/></p>

									<!-- email -->
										<p class="form"><label class="label" for="patron_email">Milligan Email:* </label><input tabindex="2" class="text three-fourths <?php if(isset($emailError)){echo 'fail';}?>" type="email" name="patron_email" value="<?php if(isset($patron_email)){echo $patron_email;} ?>" /></p>

									<!-- date -->
										<p class="form"><label class="label" for="time_date">Date:* </label><input tabindex="3" class="text half <?php if(isset($dateError)){echo 'fail';}?>" type="date" name="time_date" value="<?php if($time_date_valid){date('j/n/Y', $time_date_valid);} ?>" /></p>

									<!-- start time -->
										<p class="form"><label class="label" for="time_start">Start Time:* </label><input tabindex="4" class="text half <?php if(isset($timeStartError)){echo 'fail';}?>" type="text" name="time_start" value="<?php if($time_start_valid){echo date('g:i A', $time_start_valid);} ?>" /></p>

									<!-- end time -->
										<p class="form"><label class="label" for="time_end">End Time:* </label><input tabindex="5" class="text half <?php if(isset($timeEndError)){echo 'fail';}?>" type="text" name="time_end" value="<?php if($time_end_valid){echo date('g:i A', $time_end_valid);} ?>" /></p>

									<!-- purpose -->
										<p class="form"><label class="label" for="patron_purpose">Purpose:* </label><input tabindex="6" class="text <?php if(isset($purposeError)){echo 'fail';}?>" type="text" name="patron_purpose" value="<?php if(isset($patron_purpose)){echo $patron_purpose;} ?>" /></p>

									<!-- honeypot -->
										<p class="laylah"><label for="laylah">Required:*</label><input type="text" name="laylah" tabindex="999" /></p>

									<!-- room -->
										<p class="form"><label class="label" for="reserve_room">Room:* </label><select tabindex="7" class="text half <?php if(isset($roomError)){echo 'fail';}?>" name="reserve_room" ?>">
											<option value="">Select ... </option>
											<option value="welshimer-room" <?php if($reserve_room === 'alum'){echo 'selected="selected"';} ?> >Welshimer Room</option>
											<option value="hopwood-room" <?php if($reserve_room === 'hopwood'){echo 'selected="selected"';} ?> >Hopwood Room</option>
											<option value="group-room-1" <?php if($reserve_room === 'group-room-1'){echo 'selected="selected"';} ?> >Group Room 1</option>
											<option value="group-room-2" <?php if($reserve_room === 'group-room-2'){echo 'selected="selected"';} ?> >Group Room 2</option>
											<option value="group-room-3" <?php if($reserve_room === 'group-room-3'){echo 'selected="selected"';} ?> >Group Room 3</option>
											<option value="group-room-4" <?php if($reserve_room === 'group-room-4'){echo 'selected="selected"';} ?> >Group Room 4</option>
											<option value="other" <?php if($reserve_room === 'other'){echo 'selected="selected"';} ?> >Other (Please specify below)</option>
										</select>
										</p>
										<!-- message -->
										<p class="form"><label class="label" for="patron_message">Special Instructions: </label><textarea tabindex="10" class="textarea" type="textarea" name="patron_message" ><?php if(isset($patron_message)){echo $patron_message;} ?></textarea></p>
										<!-- submit -->
										<p class="form"><input class="submit full" type="submit" name="submit" value="Send Request" tabindex="11" ></p>
									</form> <!-- end form -->
								<?php endif; ?>



							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'welshimer2013' ), 'after' => '</div>' ) ); ?>
							<?php edit_post_link( __( 'Edit', 'welshimer2013' ), '<div><span class="edit-link">', '</span></div>' ); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>