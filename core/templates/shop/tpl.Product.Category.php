<?php
/**
 * Copyright (c) 2014-2016, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/11/15 23:17
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://www.webapproach.net/tint
 */
?>
<?php $category = get_queried_object(); ?>
<?php tt_get_header('shop'); ?>
<!-- Left Menu -->
<div class="menu_wrapper">

</div>
<div class="wrapper">
    <div class="content text-center">
        <div class="billboard" style="background-image: url(<?php echo THEME_ASSET . '/img/shop-billboard.gif'; ?>)">
            <div class="billboard-text">
                <h1><i class="tico tico-folder-open-o"></i><?php echo $category->name; ?></h1>
                <p><?php echo $category->description; ?></p>
            </div>
        </div>
    </div>
    <?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>
    <?php $vm = ShopCategoryVM::getInstance($paged, $category->term_id); ?>
    <?php if($vm->isCache && $vm->cacheTime) { ?>
        <!-- Products cached <?php echo $vm->cacheTime; ?> -->
    <?php } ?>
    <div class="content">
        <?php if($data = $vm->modelData) { $pagination_args = $data->pagination; $products = $data->products; ?>
            <div class="row loop-grid products-loop-grid mb20 clearfix">
                <?php foreach ($products as $product) { ?>
                    <div class="col col-md-4 col-sm-4 col-xs-12">
                        <article class="product" id="<?php echo 'product-' . $product['ID']; ?>">
                            <div class="entry-thumb">
                                <a href="<?php echo $product['permalink']; ?>">
                                    <img class="thumb-medium wp-post-image fadeIn" src="<?php echo $product['thumb']; ?>">
                                    <span class="product-stats clearfix">
                                <span class="product-stat"><i class="tico tico-eye"></i><?php echo $product['views']; ?></span>
                                <span class="product-stat"><i class="tico tico-comments"></i><?php echo $product['comment_count']; ?></span>
                                <span class="product-stat"><i class="tico tico-truck"></i><?php echo $product['sales']; ?></span>
                            </span>
                                </a>
                            </div>
                            <div class="entry-detail">
                                <div class="pull-right entry-meta">
                            <span class="meta-price">
                                <a href="<?php echo $product['permalink']; ?>" title="<?php if($product['price'] > 0) : printf('%d %s', $product['price'], $product['price_unit']); else : echo __('Free', 'tt'); endif; ?>">
                                    <?php if(!($product['price'] > 0)) { ?>
                                        <span><?php echo __('FREE', 'tt'); ?></span>
                                    <?php }elseif($product['currency'] == 'credit') { ?>
                                        <i class="tico tico-diamond"></i>
                                        <span><?php echo (int)$product['price']; ?></span>
                                    <?php }else{ ?>
                                        <i class="tico tico-cny"></i>
                                        <span><?php echo $product['price']; ?></span>
                                    <?php } ?>
                                </a>
                            </span>
                                    <span class="meta-stars">
                                <a href="javascript:;" title="<?php printf('%d %s', $product['stars'], __('ZAN', 'tt')); ?>">
                                    <i class="tico tico-triangle-up"></i>
                                    <span><?php echo $product['stars']; ?></span>
                                </a>
                            </span>
                                </div>
                                <h2 class="entry-title"><a href="<?php echo $product['permalink']; ?>" rel="bookmark"><?php echo $product['title']; ?></a></h2>
                            </div>
                        </article>
                    </div>
                <?php } ?>
            </div>
            <?php if($pagination_args['max_num_pages'] > 1) { ?>
                <div class="pagination-wrap">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php $pagination = paginate_links(array(
                                'base' => $pagination_args['base'],
                                'format' => '?paged=%#%',
                                'current' => $pagination_args['current_page'],
                                'total' => $pagination_args['max_num_pages'],
                                'type' => 'array',
                                'prev_next' => true,
                                'prev_text' => '<i class="tico tico-angle-left"></i>',
                                'next_text' => '<i class="tico tico-angle-right"></i>'
                            )); ?>
                            <?php foreach ($pagination as $page_item) {
                                echo '<li class="page-item">' . $page_item . '</li>';
                            } ?>
                        </ul>
                        <div class="page-nums">
                            Page&nbsp;<span class="current-page"><?php echo $pagination_args['current_page']; ?></span>
                            <span class="separator">/</span>
                            <span class="max-page"><?php echo $pagination_args['max_num_pages']; ?></span>
                        </div>
                    </nav>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<?php tt_get_footer(); ?>