<?php
/**
Template Name: Distance Ed. Materials Request Form
 */
//remove_filter('the_content', 'wpautop'); // Keeps WP from adding the annoying <p> and <br /> tags to content

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
	//Check to make sure that the barcode field is not empty
		if(trim($_POST['patron_barcode']) === '') {
			$barcodeError = 'You must enter your barcode.';
			$hasError = true;
		} else {
			$patron_barcode = trim($_POST['patron_barcode']);
		}
	//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['patron_email']) === '') {
			$emailError = 'You must enter your email address.';
			$hasError = true;
		} else if (!eregi("^[a-z0-9._%-]*@.*milligan\.edu$", strtolower(trim($_POST['patron_email'])))) {
			$emailError = 'You must enter a valid Milligan email address.';
			$hasError = true;
		} else {
			$patron_email = strtolower(trim($_POST['patron_email']));
		}
	//Check to make sure that the title field is not empty
		if(trim($_POST['item_title']) === '') {
			$titleError = 'You must enter the title.';
			$hasError = true;
		} else {
			$item_title = trim($_POST['item_title']);
		}
	//Check to make sure that the author field is not empty
		if(trim($_POST['item_author']) === '') {
			$authorError = 'You must enter an author.';
			$hasError = true;
		} else {
			$item_author = trim($_POST['item_author']);
		}
	//Check to make sure that the call-number field is not empty
		if(trim($_POST['item_call_number']) === '') {
			$callNumberError = 'You must provide a call number.';
			$hasError = true;
		} else {
			$item_call_number = trim($_POST['item_call_number']);
		}
	//Check to make sure that the address field is not empty
		if(trim($_POST['patron_address']) === '') {
			$addressError = 'You must provide a street address or PO Box number.';
			$hasError = true;
		} else {
			$patron_address = trim( $_POST['patron_address']);
		}
	//Check to make sure that the address field is not empty
		if(trim($_POST['patron_city']) === '') {
			$cityError = 'You must provide your city';
			$hasError = true;
		} else {
			$patron_city = trim( $_POST['patron_city']);
		}
	//Check to make sure that the address field is not empty
		if(trim($_POST['patron_state']) === '') {
			$stateError = 'You must provide your state';
			$hasError = true;
		} else {
			$patron_state = trim( $_POST['patron_state']);
		}
	//Check to make sure that the address field is not empty
		if(trim($_POST['patron_zip']) === '') {
			$zipError = 'You must provide your zip code';
			$hasError = true;
		} else {
			$patron_zip = trim( $_POST['patron_zip']);
		}
	//Added validation structure to messge field, in case it will ever be required
		if(trim($_POST['patron_message']) === '') {
			$patron_message = trim($_POST['patron_message']);
		} else {
			$patron_message = trim($_POST['patron_message']);
		}

		if(!isset($hasError)) {
			$emailTo = 'library@milligan.edu';
			$subject = 'Distance Ed. Materials Request';
			$body = '<h4>Request made ' . current_time('mysql') .'</h4>';
				$body .= '<p><strong>Requested by: </strong>' . $patron_name . ' [' . $patron_email . ']</p>';
				$body .= '<p><strong>Barcode: </strong>' . $patron_barcode . '</p>';
				$body .= '<p><strong>Title: </strong>' . $item_title . '</p>';
				$body .= '<p><strong>Author: </strong>' . $item_author . '</p>';
				$body .= '<p><strong>Call Number: </strong>' . $item_call_number . '</p>';
				$body .= '<p><strong>Address: </strong></p><p>' . $patron_address . '<br>' . $patron_city . ', ' . $patron_state . ' ' . $patron_zip . '</p>';
				$body .= '<p><strong>Special Instructions: </strong></p><p>' . $patron_message . '</p>';

			$headers[] = 'From: Distance Ed. Webform <library@milligan.edu>';
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
								<?php if(isset($emailSent) && $emailSent == true): ?>
									<div class="alert success">
										<p>Your request has been successfully submitted. Any additional questions or comments should be directed to <a href="mailto:library@milligan.edu">library@milligan.edu</a>.</p>
										<p><a class="submit full"href="<?php the_permalink() ?>">Submit Another Request</a>
										</div>
								<?php else: ?>
									<?php if(isset($hasError)): ?>
									<div class="alert fail">
										<?php if(isset($honeypotError)){echo $honeypotError . '<br />';}?>
										<?php if(isset($nameError)){echo $nameError . '<br />';}?>
										<?php if(isset($barcodeError)){echo $barcodeError . '<br />';}?>
										<?php if(isset($emailError)){echo $emailError . '<br />';}?>
										<?php if(isset($titleError)){echo $titleError . '<br />';}?>
										<?php if(isset($authorError)){echo $authorError . '<br />';}?>
										<?php if(isset($callNumberError)){echo $callNumberError . '<br />';}?>
										<?php if(isset($addressError)){echo $addressError . '<br />';}?>
										<?php if(isset($cityStateError)){echo $cityError . '<br />';}?>
										<?php if(isset($stateError)){echo $stateError . '<br />';}?>
										<?php if(isset($zipError)){echo $zipError . '<br />';}?>
									</div>
								<?php endif; ?>
								<?php the_content(); ?>
									<!--ILL Form -->
									<hr />
									<h3 id="request-form">Materials Request Form</h3>
									<form action="<?php the_permalink(); ?>" method="post">
										<p class="form"><label class="label" for="patron_name">Name:* </label><input tabindex="5" class="text three-fourths <?php if(isset($nameError)){echo 'fail';}?>" type="text" name="patron_name" value="<?php if(isset($patron_name)){echo $patron_name;} ?>"/></p>
										<p class="form"><label class="label" for="patron_barcode">Barcode:* </label><input tabindex="6" class="text three-fourths <?php if(isset($barcodeError)){echo 'fail';}?>" type="text" name="patron_barcode" value="<?php if(isset($patron_barcode)){echo $patron_barcode;} ?>"/></p>
										<p class="form"><label class="label" for="patron_email">Milligan Email:* </label><input tabindex="7" class="text three-fourths <?php if(isset($emailError)){echo 'fail';}?>" type="text" name="patron_email" value="<?php if(isset($patron_email)){echo $patron_email;} ?>" /></p>
										<p class="form"><label class="label" for="item_title">Item Title:* </label><input tabindex="8" class="text <?php if(isset($titleError)){echo 'fail';}?>" type="text" name="item_title" value="<?php if(isset($item_title)){echo $item_title;} ?>" /></p>
										<p class="form"><label class="label" for="item_author">Item Author:* </label><input tabindex="9" class="text <?php if(isset($authorError)){echo 'fail';}?>" type="text" name="item_author" value="<?php if(isset($item_author)){echo $item_author;} ?>" /></p>
										<p class="form"><label class="label" for="item_call_number">Call Number:* </label><input tabindex="10" class="text three-fourths <?php if(isset($callNumberError)){echo 'fail';}?>" type="text" name="item_call_number" value="<?php if(isset($item_call_number)){echo $item_call_number;} ?>" /></p>
										<p class="laylah"><label for="laylah">Required</label><input type="text" name="laylah" tabindex="999" /></p>
										<p class="form"><label class="label" for="patron_address">Street Address:* </label><input tabindex="11" class="text three-fourths <?php if(isset($addressError)){echo 'fail';}?>" type="text" name="patron_address" value="<?php if(isset($patron_address)){echo $patron_address;} ?>" /></p>
										<p class="form"><label class="label" for="patron_city">City, State, Zip:* </label><input tabindex="12" class="text quarter <?php if(isset($cityError)){echo 'fail';}?>" type="text" name="patron_city" value="<?php if(isset($patron_city)){echo $patron_city;} ?>" /><input tabindex="12" class="text quarter <?php if(isset($stateError)){echo 'fail';}?>" type="text" name="patron_state" value="<?php if(isset($patron_state)){echo $patron_state;} ?>" /><input tabindex="12" class="text quarter <?php if(isset($zipError)){echo 'fail';}?>" type="text" name="patron_zip" value="<?php if(isset($patron_zip)){echo $patron_zip;} ?>" /></p>
										<p class="form"><label class="label" for="patron_message">Special Instructions: </label><textarea tabindex="13" class="textarea" type="textarea" name="patron_message" ><?php if(isset($patron_message)){echo $patron_message;} ?></textarea></p>
										<p class="form"><input class="submit full" type="submit" name="submit" value="Send Request" tabindex="13" ></p>
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