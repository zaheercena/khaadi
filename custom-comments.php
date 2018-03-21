<?php
if ( post_password_required() ) {
	return;
}
?>
<?php
//echo wp_get_current_commenter();
// echo get_comment_author();
// echo get_comment_time();
// echo get_comment_date();
?>
<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
  <h2><?php //echo get_comment_time();?></h2>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'twentyseventeen' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'twentyseventeen'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>

		<ol class="comment-list">

			<?php
      $d = "j F Y";
				wp_list_comments( array(
          'per_page' => 2,
					'avatar_size' => 0,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => twentyseventeen_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'twentyseventeen' ),
					'echo'        => false,
					'reverse_top_level' => true,
					
				) );?>
				<div>
				<?php echo get_avatar(get_the_author_id(), 50);?>
        <?php echo get_comment_author();
        echo "   ";
        echo get_comment_date($d);
			?><br>
      <?php echo get_comment_text();?>
		</div>
		<br>
		<?php $comments = get_comments($post_id);
			foreach($comments as $comment) :
				echo($comment->comment_author); echo "   ";
				echo($comment->comment_date);?> <br><?php
				echo($comment->comment_content );
				?><br><?php
			endforeach;
			?>

		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'twentyseventeen' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyseventeen' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
