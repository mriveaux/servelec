<div class="post-style-2 rpc-bg rpc-box card p-1 pb-3 text-center rounded blue-hover">
    <div class="wcp-img-wrap view overlay">
        <a href="<?php the_permalink(); ?>">
            <?php do_action('rpc_carousel_thumbnail', $post_id, $carousel_settings); ?>
        </a>
    </div>

    <div class="wcp-content-wrap">
        <h3 class="text-center mt-2 mb-1 align-middle" style="line-height: 1.25;height: 65px;">
            <a class="rpc-title" href="<?php echo get_permalink($post_id); ?>"
               target="<?php echo $carousel_settings['read_more_target']; ?>" class="rpc-title">
                <?php do_action('rpc_carousel_title', $post_id, $carousel_settings); ?>
            </a>
        </h3>
        <?php if (!isset($carousel_settings['hidemeta'])) { ?>
            <div class="wcp-post-meta wcp-disable-post-meta"
                 style="color: <?php echo (isset($carousel_settings['desc_color'])) ? $carousel_settings['desc_color'] : ''; ?>;">
            <span class="wcp-post-author"><i class="fa fa-user"></i>
                <?php the_author_posts_link(); ?>
            </span>
                &nbsp;
                <span class="wcp-post-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></span>
            </div>
        <?php } ?>
        <div class="wcp-post-contents rpc-content">
            <div class="text-justify my-2" style="height: 75px;">
                <?php do_action('rpc_carousel_desc', $post_id, $carousel_settings); ?>
            </div>

            <?php do_action('rpc_read_more_btn', $post_id, $carousel_settings); ?>

        </div>
    </div>
</div>