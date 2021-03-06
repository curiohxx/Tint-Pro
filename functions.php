<?php
/**
 * Copyright 2016, WebApproach.net
 * All right reserved.
 *
 * @author Zhiyan
 * @date 16/5/27 16:30
 * @license GPL v3 LICENSE
 */
?>
<?php

/* 安全检测 */
//defined( 'ABSPATH' ) || exit;
if (!defined('ABSPATH')){
    wp_die(__('Lack of WordPress environment', 'tt'), __('WordPress internal error', 'tt'), array('response'=>500));
}

/* 引入常量 */
require_once 'core/functions/Constants.php';

/* 设置默认时区 */
date_default_timezone_set('PRC');

if(!function_exists('load_dash')){
	function load_dash($path){
		load_template(THEME_DIR.'/dash/'.$path.'.php');
	}
}

if(!function_exists('load_api')){
    function load_api($path){
        load_template(THEME_DIR.'/core/api/'.$path.'.php');
    }
}

if(!function_exists('load_class')){
	function load_class($path, $safe = false){
		if($safe) {
            @include_once(THEME_DIR.'/core/classes/'.$path.'.php');
        }else{
            load_template(THEME_DIR.'/core/classes/'.$path.'.php');
        }
	}
}

if(!function_exists('load_func')){
    function load_func($path, $safe = false){
        if($safe){
            @include_once(THEME_DIR.'/core/functions/'.$path.'.php');
        }else{
            load_template(THEME_DIR.'/core/functions/'.$path.'.php');
        }
    }
}

if(!function_exists('load_mod')){
    function load_mod($path, $safe = false){
        if($safe) {
            @include_once(THEME_DIR.'/core/modules/'.$path.'.php');
        }else{
            load_template(THEME_DIR.'/core/modules/'.$path.'.php');
        }
    }
}

if(!function_exists('load_widget')){
    function load_widget($path, $safe = false){
        if($safe) {
            @include_once(THEME_DIR.'/core/modules/widgets/'.$path.'.php');
        }else{
            load_template(THEME_DIR.'/core/modules/widgets/'.$path.'.php');
        }
    }
}

if(!function_exists('load_vm')){
    function load_vm($path, $safe = false){
        if($safe) {
            @include_once(THEME_DIR.'/core/viewModels/'.$path.'.php');
        }else{
            load_template(THEME_DIR.'/core/viewModels/'.$path.'.php');
        }
    }
}

/* 载入option_framework */
load_dash('of_inc/options-framework');

/* 载入主题选项 */
load_dash('options');
/* 调试模式选项保存为全局变量 */
defined('TT_DEBUG') || define('TT_DEBUG', of_get_option('tt_theme_debug', false));
if(TT_DEBUG) {
    ini_set("display_errors","On");
    error_reporting(E_ALL);
}else{
    ini_set("display_errors","Off");
}

/* 载入后台相关处理逻辑 */
if( is_admin() ){
    load_dash('dash');
}

/* 载入REST API功能控制函数 */
load_api('api.Config');

/* 载入类 */
load_class('class.Avatar');
load_class('class.Captcha');
load_class('class.Open');
load_class('class.PostImage');
load_class('class.Utils');
if(is_admin()) {
    load_class('class.Tgm.Plugin.Activation');
}

/* 载入功能函数 */
load_func('func.L10n');
load_func('func.Account');
load_func('func.Avatar');
load_func('func.Cache');
load_func('func.Comment');
load_func('func.Init');
load_func('func.Install');
load_func('func.Kits');
load_func('func.Mail');
load_func('func.Metabox');
load_func('func.Module');
load_func('func.Optimization');
load_func('func.Page');
load_func('func.PostMeta');
load_func('func.Rewrite');
load_func('func.Robots');
load_func('func.Schedule');
load_func('func.Script');
load_func('func.Seo');
load_func('func.Sidebar');
load_func('func.Template');
load_func('func.Thumb');
load_func('func.User');
load_func('func.Content');

/* 载入数据模型 */
load_vm('vm.Base');
load_vm('vm.Home.Slides');
load_vm('vm.Home.Popular');
load_vm('vm.Home.Latest');
load_vm('vm.Home.FeaturedCategory');
load_vm('vm.Single.Post');
load_vm('vm.Post.Comments');
load_vm('vm.Category.Posts');
load_vm('vm.Tag.Posts');
load_vm('vm.Date.Archive');
load_vm('vm.Term.Posts');
load_vm('vm.Widget.Author');
load_vm('vm.Widget.HotHit.Posts');
load_vm('vm.Widget.HotReviewed.Posts');
load_vm('vm.Widget.Recent.Comments');
load_vm('vm.Widget.Latest.Posts');

/* 载入小工具 */
load_widget('wgt.TagCloud');
load_widget('wgt.Author');
load_widget('wgt.HotHits.Posts');
load_widget('wgt.HotReviews.Posts');
load_widget('wgt.RecentComments');
load_widget('wgt.Latest.Posts');
load_widget('wgt.UC');
load_widget('wgt.Float');
load_widget('wgt.EnhancedText');
load_widget('wgt.Donate');