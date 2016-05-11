<?php
/*
The comments page
*/

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<div class="alert alert-info"><?php _e("This post is password protected. Enter the password to view comments.","wpbootstrap"); ?></div>
	<?php
	return;
} ?>

<?php if ( have_comments() ) : ?>
	<div class="comments row">
	    <div class="col-sm-12">
	        <p class="comments-head text-uppercase">
	            <strong><?php comments_number() ?></strong>
	        </p>
			<ul class="commented">
				<?php wp_list_comments('type=comment&callback=wp_bootstrap_comments'); ?>
			</ul>

			<?php if ( ! empty($comments_by_type['pings']) ) : ?>
				<h3 id="pings">Trackbacks/Pingbacks</h3>
				<ol class="pinglist">
					<?php wp_list_comments('type=pings&callback=list_pings'); ?>
				</ol>
			<?php endif; ?>

			<nav id="comment-nav">
				<ul class="clearfix list-unstyled">
			  		<li><?php previous_comments_link( __("Older comments","wpbootstrap") ) ?></li>
			  		<li><?php next_comments_link( __("Newer comments","wpbootstrap") ) ?></li>
				</ul>
			</nav>
	    </div>
	</div>


<?php endif; ?>


<?php if ( comments_open() ) : ?>
	<div class="col-sm-12 comment-bottom">
		<div class="row">
	        <div class="col-sm-offset-1 col-sm-10">
				<?php
				/**
				 * Comment Form
				 */
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				$fields =  array(
					'author' => '<div class="form-group"><label class="sr-only" for="author">' . __( 'Name', 'domainreference' ) . '</label><input id="author" name="author" type="text"class="form-control input-lg" placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
					'email' => '<div class="form-group"><label class="sr-only" for="email">' . __( 'Email', 'domainreference' ) . '</label><input id="email" name="email" type="text" class="form-control input-lg" placeholder="Email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
					'redirect_to' => '<input type="hidden" name="redirect_to" value="'.get_permalink().'"/>',
				);
				$comment_args = array(
					'fields' => $fields,
					'title_reply' => '',
					'label_submit' => 'Comment',
					'class_form' => 'commenting',
					'class_submit' => 'submit',
					'comment_field' => '<div class="form-group"><textarea id="comment" name="comment" class="form-control input-lg" rows="5" placeholder="Comment"></textarea></div>',
				);
				comment_form($comment_args); ?>
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="alert alert-warning">
		<?php _e('Commenting is closed at the moment.', 'ssa') ?>
	</div>
<?php endif; // if you delete this the sky will fall on your head ?>