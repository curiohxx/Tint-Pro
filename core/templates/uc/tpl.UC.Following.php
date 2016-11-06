<?php
/**
 * Copyright (c) 2014-2016, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/11/06 17:58
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://www.webapproach.net/tint.html
 */
?>
<?php tt_get_header(); ?>
<div id="content" class="wrapper">
    <?php load_mod('uc/uc.TopPane'); ?>
    <!-- 主要内容区 -->
    <section class="container author-area">
        <div class="inner">
            <?php load_mod('uc/uc.NavTabs'); ?>
            <?php load_mod('uc/uc.Tab.Following'); ?>
        </div>
    </section>
</div>
<?php tt_get_footer(); ?>