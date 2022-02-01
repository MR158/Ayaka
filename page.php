<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<header class="inner-header">
    <div class="inner-header__main">
        <figure class="post-thumb">
            <?php if(Service::get_postthumb($this)): ?>
                <img src="<?php echo Service::get_postthumb($this) ?>">
            <?php else: ?>
                <img src="<?php $this->options->themeUrl('img/default_thumb.jpg'); ?>">
            <?php endif; ?>
        </figure>
        <div class="post-info">
            <h1 class="post-info__title"><?php $this->title() ?></h1>
            <div class="post-info__meta">
                <div class="post-info__meta--author">
                    <?php if($this->options->logoUrl): ?>
                        <img class="author-avatar" src="<?php $this->options->logoUrl() ?>">
                    <?php else: ?>
                        <img class="author-avatar" src="<?php $this->options->themeUrl('/img/default_avatar.jpg');?>">
                    <?php endif; ?>
                    <a class="author-name" href="<?php $this->author->permalink(); ?>"><?php $this->author() ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php if(Service::get_postthumb($this)): ?>
    <div class="inner-header__bg top-bg" style="background-image:url(<?php echo Service::get_postthumb($this) ?>)">
    <?php else: ?>
    <div class="inner-header__bg top-bg" style="background-image:url(<?php $this->options->themeUrl('/img/default_bg.jpg'); ?>)">
    <?php endif; ?>
    </div>
</header>

<section class="post">
    <div class="post__wrap">
        <div id="post-nav" class="post-menu"></div>
        <div class="post-main">
            <div id="post-main-section" class="article-content">
                <?php $this->content(); ?>
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
</section>

<?php $this->need('footer.php'); ?>