<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');?>
<header class="index-header">
    <div class="index-header__bg top-bg" style="background-image:url(<?php $this->options->themeUrl('/img/default_bg.jpg'); ?>)"></div>
</header>

<section class="not-found">
    <div class="not-found__main">
        <div class="not-found__main--icon">
            <img src="<?php $this->options->themeUrl('/img/404.jpg');?>" alt="LOGO">
        </div>
        <h1 class="not-found__main--text">404</h1>
        <h1 class="not-found__main--text">找不到页面啦~</h1>
    </div>
</section>

<?php $this->need('footer.php'); ?>
