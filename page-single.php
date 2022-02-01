<?php
/**
 * 单栏页面模板
 *
 * @package custom
 */
?>
<?php $this->need('header.php'); ?>

<header class="inner-header">
    <div class="inner-header__main">
        <div class="post-info post-info-s">
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
        <div class="post-main post-main-s">
            <div id="post-main-section" class="article-content">
                <?php $this->content(); ?>
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
</section>

<?php $this->need('footer.php'); ?>