<?php
/**
 * Copyright (c) 2014-2016, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/10/09 19:53
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://webapproach.net/tint.html
 */
?>
<?php

/**
 * 保存文章时添加最近变动字段
 *
 * @since   2.0.0
 * @param   $post_ID
 * @return  void
 */
function tt_add_post_review_fields($post_ID) {
    if(!wp_is_post_revision($post_ID)) {
        update_post_meta($post_ID, 'tt_latest_reviewed', time());
    }
}
add_action('save_post', 'tt_add_post_review_fields');

/**
 * 删除文章时删除最近变动字段
 *
 * @since   2.0.0
 * @param   $post_ID
 * @return  void
 */
function tt_delete_post_review_fields($post_ID) {
    if(!wp_is_post_revision($post_ID)) {
        delete_post_meta($post_ID, 'tt_latest_reviewed');
    }
}
add_action('delete_post', 'tt_delete_post_review_fields');