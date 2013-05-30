<?php
/**
Template Name: ILL Request Form
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
		} else if (!eregi("^[a-z0-9._%-]*@.*milligan\.edu$", strtolower(trim($_POST['patron_email'])))) {
			$emailError = 'You must enter a valid Milligan email address.';
			$hasError = true;
		} else {
			$patron_email = strtolower(trim($_POST['patron_email']));
		}
	//Check to make sure that the title field is not empty
		if(trim($_POST['article_title']) === '') {
			$titleError = 'You must enter the title.';
			$hasError = true;
		} else {
			$article_title = trim($_POST['article_title']);
		}
	//Check to make sure that the author field is not empty
		if(trim($_POST['article_author']) === '') {
			$authorError = 'You must enter an author.';
			$hasError = true;
		} else {
			$article_author = trim($_POST['article_author']);
		}

	//Check to make sure that the journal field is not empty
		if(trim($_POST['article_journal']) === '') {
			$journalError = 'You must enter the journal title.';
			$hasError = true;
		} else {
			$article_journal = trim($_POST['article_journal']);
		}
	//Check to make sure that the date field is not empty
		if(trim($_POST['journal_date']) === '') {
			$dateError = 'You must enter a publication date.';
			$hasError = true;
		} else {
			$journal_date = trim($_POST['journal_date']);
		}
	//Check to make sure that the volume field is not empty
		if(trim($_POST['journal_volume']) === '') {
			$volumeError = 'You must enter a volume number (enter N/A if none is given).';
			$hasError = true;
		} else {
			$journal_volume = trim($_POST['journal_volume']);
		}
	//Check to make sure that the issue field is not empty
		if(trim($_POST['journal_issue']) === '') {
			$issueError = 'You must enter an issue number (enter N/A if none is given).';
			$hasError = true;
		} else {
			$journal_issue = trim($_POST['journal_issue']);
		}
	//Check to make sure that the page field is not empty
		if(trim($_POST['article_pages']) === '') {
			$pagesError = 'You must include page numbers.';
			$hasError = true;
		} else {
			$article_pages = trim($_POST['article_pages']);
		}
	//Added validation structure to messge field, in case it will ever be required
		if(trim($_POST['patron_message']) === '') {
			$patron_message = trim($_POST['patron_message']);
		} else {
			$patron_message = trim($_POST['patron_message']);
		}

		if(!isset($hasError)) {
			$emailTo = 'mc_ill@milligan.edu';
			$subject = 'Interlibrary Loan Request';
			$body = '<h4>ILL Request made ' . date("F j, Y, g:i a") .'</h4>';
				$body .= '<p><strong>Requested by: </strong>' . $patron_name . ' [' . $patron_email . ']</p>';
				$body .= '<p><strong>Title: </strong>' . $article_title . '</p>';
				$body .= '<p><strong>Author: </strong>' . $article_author . '</p>';
				$body .= '<p><strong>Journal: </strong>' . $article_journal . '</p>';
				$body .= '<p><strong>Date: </strong>' . $journal_date . '</p>';
				$body .= '<p><strong>Vol: </strong>' . $journal_volume . '</p>';
				$body .= '<p><strong>Issue: </strong>' . $journal_issue . '</p>';
				$body .= '<p><strong>Pages: </strong>' . $article_pages . '</p>';
				$body .= '<p><strong>Special Instructions: </strong></p><p>' . $patron_message . '</p>';

			$headers[] = 'From: ILL Webform <mc_ill@milligan.edu>';
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
										<p>Your ILL request has been successfully submitted. You will be notified via email when your material is available. Any additional questions or comments should be directed to <a href="mailto:mc_ill@milligan.edu">mc_ill@milligan.edu</a>.</p>
										<p><a class="submit full"href="<?php the_permalink() ?>">Submit Another Request</a>
										</div>

								<?php else: ?>
									<?php if(isset($hasError)): ?>
									<div class="alert fail">
										<?php if(isset($honeypotError)){echo $honeypotError . '<br />';}?>
										<?php if(isset($emailError)){echo $emailError . '<br />';}?>
										<?php if(isset($titleError)){echo $titleError . '<br />';}?>
										<?php if(isset($authorError)){echo $authorError . '<br />';}?>
										<?php if(isset($journalError)){echo $journalError . '<br />';}?>
										<?php if(isset($dateError)){echo $dateError . '<br />';}?>
										<?php if(isset($volumeError)){echo $volumeError . '<br />';}?>
										<?php if(isset($issueError)){echo $issueError . '<br />';}?>
										<?php if(isset($pagesError)){echo $pagesError . '<br />';}?>
									</div>
								<?php else: ?>
									<div class="alert info"><p>The more information you give us, the faster we can get your materials. That said, sometimes not all of this info is readily available. If you cannot find a required piece of info, enter "N/A" or "Unknown" and we'll do our best to find the right article.</p>
									</div>

									<?php endif; ?>
									<!--ILL Form -->
									<form action="<?php the_permalink(); ?>" method="post">
										<p class="form"><label class="label" for="patron_name">Name:* </label><input tabindex="1" class="text three-fourths <?php if(isset($nameError)){echo 'fail';}?>" type="text" name="patron_name" value="<?php if(isset($patron_name)){echo $patron_name;} ?>"/></p>
										<p class="form"><label class="label" for="patron_email">Milligan Email:* </label><input tabindex="2" class="text three-fourths <?php if(isset($emailError)){echo 'fail';}?>" type="text" name="patron_email" value="<?php if(isset($patron_email)){echo $patron_email;} ?>" /></p>
										<p class="form"><label class="label" for="article_title">Article Title:* </label><input tabindex="3" class="text <?php if(isset($titleError)){echo 'fail';}?>" type="text" name="article_title" value="<?php if(isset($article_title)){echo $article_title;} ?>" /></p>
										<p class="form"><label class="label" for="article_author">Article Author:* </label><input tabindex="4" class="text <?php if(isset($authorError)){echo 'fail';}?>" type="text" name="article_author" value="<?php if(isset($article_author)){echo $article_author;} ?>" /></p>
										<p class="form"><label class="label" for="article_journal">Journal Title:* </label><input tabindex="5" class="text <?php if(isset($journalError)){echo 'fail';}?>" type="text" name="article_journal" value="<?php if(isset($article_journal)){echo $article_journal;} ?>" /></p>
										<p class="laylah"><label for="laylah">Required</label><input type="text" name="laylah" tabindex="999" /></p>
										<p class="form"><label class="label" for="journal_date">Publication Date:* </label><input tabindex="6" class="text half <?php if(isset($dateError)){echo 'fail';}?>" type="text" name="journal_date" value="<?php if(isset($journal_date)){echo $journal_date;} ?>" /></p>
										<p class="form"><label class="label" for="journal_volume">Volume:* </label><input tabindex="7" class="text half <?php if(isset($volumeError)){echo 'fail';}?>" type="text" name="journal_volume" value="<?php if(isset($journal_volume)){echo $journal_volume;} ?>" /></p>
										<p class="form"><label class="label" for="journal_issue">Issue/Number:* </label><input tabindex="8" class="text half <?php if(isset($issueError)){echo 'fail';}?>" type="text" name="journal_issue" value="<?php if(isset($journal_issue)){echo $journal_issue;} ?>" /></p>
										<p class="form"><label class="label" for="article_pages">Inclusive Pages:* </label><input tabindex="9" class="text half <?php if(isset($pagesError)){echo 'fail';}?>" type="text" name="article_pages" value="<?php if(isset($article_pages)){echo $article_pages;} ?>" /></p>
										<p class="form"><label class="label" for="patron_message">Special Instructions: </label><textarea tabindex="10" class="textarea" type="textarea" name="patron_message" ><?php if(isset($patron_message)){echo $patron_message;} ?></textarea></p>
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