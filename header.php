<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/prism.css'); ?>?v1.1.1">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>?v1.1.1">
    <?php $this->header(); ?>
</head>
<body>
    <nav id="top-nav-pc" class="top-nav-pc">
        <ul>
            <li<?php if($this->is('index')): ?> class="current"<?php endif; ?>>
                <a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
            <li <?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?>>
                <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </nav>
    <nav id="top-nav-sp" class="top-nav-sp">
        <div class="top-nav-sp__btn">
            <div class="top-nav-btn">
                <div class="top-nav-btn__line"></div>
            </div>
        </div>
        <ul class="top-nav-sp__drawer">
            <li<?php if($this->is('index')): ?> class="current"<?php endif; ?>>
                <a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
            <li <?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?>>
                <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
            </li>
            <?php endwhile; ?>
        </ul>
    </nav>
    <div id="loading" class="loading" style="display: <?php echo $this->options->swLoading === "able" ? 'block' : 'none' ?>">
        <div class="loading__box"></div>
    </div>
    <main>
