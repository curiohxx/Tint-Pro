<?php
/**
 * Copyright (c) 2014-2017, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/01/09 20:57
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://webapproach.net/tint.html
 */
?>
<?php tt_get_header(); ?>
    <div id="content" class="wrapper">
        <!-- 主要内容区 -->
        <section class="container main-area">
            <div class="inner row">
                <?php load_mod('management/mg.NavMenu'); ?>
                <?php load_mod('management/mg.Tab.Products'); ?>
            </div>
        </section>
    </div>
<?php tt_get_footer(); ?>