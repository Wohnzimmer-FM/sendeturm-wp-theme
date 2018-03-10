<?php

class Sendeturm_Comment_Walker extends Walker_Comment
{

    protected function html5_comment( $comment, $depth, $args )
    {
?>
        <div id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'has-children media' : ' media'); ?>>
            <div class="d-flex mr-3">
                <?php echo get_avatar( $comment, $args['avatar_size'],'mm','', array('class'=>"comment_avatar rounded-circle") ); ?>
            </div>

            <div class="media-body" id="div-comment-<?php comment_ID(); ?>">
                <div class="media-content">
                    <span class="mt-0 comment-author font-weight-bold"><?php echo get_comment_author_link() ?></span>

                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
                        <time class="small" datetime="<?php comment_time( 'c' ); ?>">
                                <?php comment_date() ?>,
                                <?php comment_time() ?>
                        </time>
                    </a>

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="text-danger small"><?php _e('Your comment is awaiting moderation.'); ?></p>
                    <?php endif; ?>
                    
                    <?php comment_text(); ?>
        
                    <?php
                        comment_reply_link( array_merge( $args, array(
                            'add_below' => 'div-comment',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'before'    => '<p class="mb-0"><i class="fa fa-reply text-primary"></i> ',
                            'after'     => '</p>'
                        ) ) );
                    ?>

                    <?php edit_comment_link( __( 'Edit' ), '<p class="mb-0"><i class="fa fa-edit text-danger"></i> ', '</p>' ); ?>
                </div>

<?php
    }

    public static function end_parent_html5_comment( $comment, $depth, $args )
    {
?>
            </div> <!-- end of media-body -->
        </div><!-- end of comment -->
<?php
    }
}

