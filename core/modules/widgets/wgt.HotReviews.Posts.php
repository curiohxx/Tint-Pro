<?php
/**
 * Copyright (c) 2014-2016, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/10/26 21:36
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://www.webapproach.net/tint.html
 */
?>
<?php

/**
 * Class HotReviewPosts
 */
class HotReviewPosts extends WP_Widget {
    function __construct() {
        parent::__construct(false, __('TT-Hot Reviewed Posts', 'tt'), array( 'description' => __('TT-Show several most reviewed posts', 'tt') ,'classname' => 'widget_hot-posts widget_hotreviewed-posts'));
    }

    function widget($args, $instance) {
        // parent::widget($args, $instance); // TODO: Change the autogenerated stub
        // extract($args);
        $vm = HotReviewedPostsVM::getInstance($instance['num']);
        if($vm->isCache && $vm->cacheTime) {
            echo '<!-- Hot reviewed posts widget cached ' . $vm->cacheTime . ' -->';
        }
        $hotreviewed_posts = $vm->modelData;
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if($instance['title']) { echo $args['before_title'] . $instance['title'] . $args['after_title']; } ?>
        <div class="widget-content">
            <?php foreach ($hotreviewed_posts as $hotreviewed_post) { ?>
                <article id="<?php echo 'post-' . $hotreviewed_post['ID']; ?>" class="post type-post status-publish hotreview-post">
                    <div class="entry-thumb hover-scale">
                        <a href="<?php echo $hotreviewed_post['permalink']; ?>"><img width="200" height="136" src="<?php echo $hotreviewed_post['thumb']; ?>" class="thumb-small wp-post-image" alt="<?php echo $hotreviewed_post['title']; ?>"></a>
                    </div>
                    <div class="entry-detail">
                        <h2 class="entry-title"><a href="<?php echo $hotreviewed_post['permalink']; ?>" rel="bookmark"><?php echo $hotreviewed_post['title']; ?></a></h2>
                        <div class="entry-meta entry-meta-1">
                            <span class="comments-count text-muted"><i class="tico tico-comments-o"></i><a href="<?php echo $hotreviewed_post['permalink'] . '#respond'; ?>"><?php echo $hotreviewed_post['comment_count']; ?></a></span>
                            <span class="entry-date text-muted"><time class="entry-date" datetime="<?php echo $hotreviewed_post['datetime']; ?>" title="<?php echo $hotreviewed_post['datetime']; ?>"><i class="tico tico-alarm"></i><?php echo $hotreviewed_post['time']; ?></time></span>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </div>
        <?php echo $args['after_widget']; ?>
        <?php
    }

    function update($new_instance, $old_instance) {
        // TODO 清除小工具缓存

        return $new_instance;
    }

    function form($instance) {
        $title = esc_attr(isset($instance['title']) ? $instance['title'] : __('HOT REVIEWED', 'tt'));
        $num = absint(isset($instance['num']) ? $instance['num'] : 5);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title：','tt'); ?><input class="input-lg" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Number：','tt'); ?></label><input class="input-lg" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text"  value="<?php echo $num; ?>" /></p>
        <?php
    }
}

/* 注册小工具 */
if ( ! function_exists( 'tt_register_widget_hot_reviewed_posts' ) ) {
    function tt_register_widget_hot_reviewed_posts() {
        register_widget( 'HotReviewPosts' );
    }
}
add_action( 'widgets_init', 'tt_register_widget_hot_reviewed_posts' );