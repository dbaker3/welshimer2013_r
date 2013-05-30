<?php
/**
Template Name: Archives Request Form
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
	//Check to make sure that the name field is not empty
		if(trim($_POST['patron_name']) === '') {
			$nameError = 'You must enter your name.';
			$hasError = true;
		} else {
			$patron_name = trim($_POST['patron_name']);
		}
	//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['patron_email']) === '') {
			$emailError = 'You must enter your email address.';
			$hasError = true;
		} else {
			$patron_email = strtolower(trim($_POST['patron_email']));
		}
	//Check to make sure that the phone number field is not empty
		if(trim($_POST['patron_telephone']) === '') {
			$telephoneError = 'You must enter a phone number';
			$hasError = true;
		} else if (!eregi("^[0-9]{10}", strtolower(trim($_POST['patron_telephone'])))) {
			$telephoneError = "Please enter a valid 10 digit telephone number (don't include dashes or spaces).";
			$hasError = true;
		} else {
			$patron_telephone = strtolower(trim($_POST['patron_telephone']));
		}
	//Check to make sure that the author field is not empty
		if(trim($_POST['patron_affiliation']) === '') {
			$affiliationError = 'You must select an affiliation.';
			$hasError = true;
		} else {
			$patron_affiliation = trim($_POST['patron_affiliation']);
		}
	//Added validation structure to messge field, in case it will ever be required
		if(trim($_POST['patron_message']) === '') {
			$messageError = 'Please include a brief description of what you are doing or looking for.';
			$hasError = true;
		} else {
			$patron_message = trim($_POST['patron_message']);
		}

		if(!isset($hasError)) {
			$emailTo = 'archives@milligan.edu';
			$subject = 'Archives Materials Request';
			$body = '<h4>Archives request made ' . date("F j, Y, g:i a") .'</h4>';
				$body .= '<p><strong>Requested by: </strong>' . $patron_name . ' [ ' . $patron_email . ' ]</p>';
				$body .= '<p><strong>Telephone: </strong>' . $patron_telephone . '</p>';
				$body .= '<p><strong>Affiliation: </strong>' . $patron_affiliation . '</p>';
				$body .= '<p><strong>Request: </strong></p><p>' . $patron_message . '</p>';

			$headers[] = 'From: Archives Webform <archives@milligan.edu>';
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
										<p>Your request has been successfully submitted. The college archivist will get back to you via email shortly.</p>
										<p><a class="submit full"href="<?php the_permalink() ?>">Back to Form</a>
										</div>

								<?php else: ?>
									<?php if(isset($hasError)): ?>
									<div class="alert fail">
										<?php if(isset($honeypotError)){echo $honeypotError . '<br />';}?>
										<?php if(isset($nameError)){echo $nameError . '<br />';}?>
										<?php if(isset($emailError)){echo $emailError . '<br />';}?>
										<?php if(isset($telephoneError)){echo $telephoneError . '<br />';}?>
										<?php if(isset($affiliationError)){echo $affiliationError . '<br />';}?>
										<?php if(isset($journalError)){echo $messageError . '<br />';}?>
									</div>

									<?php endif; ?>
									<!--Archives Material Request Form -->
									<form action="<?php the_permalink(); ?>" method="post">
										<p class="form"><label class="label" for="patron_name">Name:* </label><input tabindex="1" class="text three-fourths <?php if(isset($nameError)){echo 'fail';}?>" type="text" name="patron_name" value="<?php if(isset($patron_name)){echo $patron_name;} ?>"/></p>
										<p class="form"><label class="label" for="patron_email">Email:* </label><input tabindex="2" class="text three-fourths <?php if(isset($emailError)){echo 'fail';}?>" type="text" name="patron_email" value="<?php if(isset($patron_email)){echo $patron_email;} ?>" /></p>
										<p class="form"><label class="label" for="patron_telephone">Telephone:* </label><input tabindex="3" class="text half <?php if(isset($telephoneError)){echo 'fail';}?>" type="tel" autocomplete="on" name="patron_telephone" value="<?php if(isset($patron_telephone)){echo $patron_telephone;} ?>" /></p>
										<p class="form"><label class="label" for="patron_affiliation">Affiliation:* </label><select tabindex="4" class="text three-fourths <?php if(isset($affiliationError)){echo 'fail';}?>" type="text" name="patron_affiliation" value="<?php if(isset($patron_affiliation)){echo $patron_affiliation;} ?>">
											<option>Select ...</option>
											<option value="alum" <?php if($patron_affiliation === 'alum'){echo 'selected="selected"';} ?> >Alum</option>
											<option value="student" <?php if($patron_affiliation === 'student'){echo 'selected="selected"';} ?> >Student</option>
											<option value="faculty-staff" <?php if($patron_affiliation === 'faculty-staff'){echo 'selected="selected"';} ?> >Faculty / Staff</option>
											<option value="other" <?php if($patron_affiliation === 'other'){echo 'selected="selected"';} ?> >Other</option>
											</select>
										</p>
										<p class="laylah"><label for="laylah">Required*: </label><input type="text" name="laylah" tabindex="999" /></p>
										<p class="form"><label class="label" for="patron_message">Message:* </label><textarea tabindex="10" class="textarea" type="textarea" name="patron_message" ><?php if(isset($patron_message)){echo $patron_message;} ?></textarea></p>
										<p class="form alert info">We ask researchers to please come to campus for their searches whenever possible. The Archives staff is happy to do a limited amount of research as a public service to researchers unable to come to campus. However, please be aware that the Archives cannot undertake research projects requiring more than three hours.</p>
										<p class="form"><input class="submit full" type="submit" name="submit" value="Send Request" tabindex="11" ></p>
									</form>
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