<?php 
$comment_form_disable = get_option('disable_form_comment');
$comment_list_disable = get_option('disable_list_comment');

$id = get_the_ID();
if ( comments_open()  && post_type_supports( get_post_type(), 'comments' ) ) :

    $disqus_enable = get_option('enable_disqus');
?>

<section id="comments" class="comments mt24 c-mt32">
    <header class="dfx aic fww f12 c-f16">
        <div class="ttl f24 h123-c py08 mr16"><?php if(!$disqus_enable){ echo get_comments_number( $id ); } ?> <?php echo lang_torotube('Comments', 'lang_comments'); ?></div>
    </header>
    <div id="disqus_thread">
        <form class="mt16 snow-b pd24 sw03" action="<?php echo site_url('/wp-comments-post.php') ?>" method="post">
            <?php if(!is_user_logged_in()){ ?>
                <p class="inp lg mt16"><input required type="text" id="author" name="author" placeholder="<?php echo lang_torotube('Name', 'lang_name'); ?>"></p>
                <p class="inp lg mt16"><input required type="email" id="email" name="email" placeholder="<?php echo lang_torotube('Email', 'lang_email'); ?>"></p>
            <?php } ?>
            <p class="inp lg mt16"><textarea id="comment-body" required name="comment" placeholder="<?php echo lang_torotube('Your comment', 'lang_your_comment'); ?>" cols="30" rows="3"></textarea></p>
            <p class="mt16"><button class="btn lg op08-h fwb w100p" type="submit"><?php echo lang_torotube('Send comment', 'lang_send_comment'); ?></button></p>
            <?php comment_form_hidden_fields(); ?>
        </form>
        <?php if( get_comments_number($id) < 1 ){ ?>
            
            <div class="comment-list mt40"><?php echo lang_torotube('No comments yet', 'lang_no_comments'); ?></div>
        <?php } else { ?>
            <ul class="comment-list mt40 link-c">
                <?php
                $comments_query = new WP_Comment_Query;
                $args = array(
                    'post_id' => $id,
                    'orderby' => 'comment_date_gmt',
                    'order'   => 'DESC', 
                    'number'  => 20,
                    'status'  => 'approve',
                );
                $comments__ = $comments_query->query( $args );
                wp_list_comments( array('callback'=>'review_comment'), $comments__); ?>
            </ul>
        <?php } ?>
    </div>
</section>
<?php endif; ?>