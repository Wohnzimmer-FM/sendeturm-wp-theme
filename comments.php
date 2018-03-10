<?php

require_once('classes/comment_walker.php');

if ( post_password_required() ) {
	return;
}

?>


<div id="comments" class="comments-area">

<?php if ( have_comments() ) : ?>
    <h2 class="comments-title">
        <?php echo _e('Comments', 'sendeturm'); ?>
    </h2>

    <?php #twentyfifteen_comment_nav(); ?>

    <div class="comment-list">
        <?php
            wp_list_comments( array(
                'style'         => 'div',
                'max_depth'     => 4,
                'short_ping'    => true,
                'avatar_size'   => '50',
                'end-callback'  => 'Sendeturm_Comment_Walker::end_parent_html5_comment',
                'walker'        => new Sendeturm_Comment_Walker(),
            ) );
        ?>
    </div><!-- .comment-list -->

    <?php #twentyfifteen_comment_nav(); ?>

<?php endif; // have_comments() ?>

<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
    <p class="no-comments"><?php _e( 'Comments are closed.', 'sendeturm' ); ?></p>
<?php endif; ?>

<?php comment_form(); ?>

</div>
