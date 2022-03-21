<?php
/**
 * 单栏页面模板
 *
 * @package custom
 */
?>
<?php $this->need('header.php'); ?>

<?php $imgrand = rand(); ?>
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
    <?php elseif($this->options->postImgUrl): ?>
    <div class="inner-header__bg top-bg" style="background-image:url(<?php echo $this->options->postImgUrl ?>?rand=<?php echo $imgrand;?>)">
    <?php else: ?>
    <div class="inner-header__bg top-bg" style="background-image:url(<?php $this->options->themeUrl('/img/default_bg.jpg'); ?>)">
    <?php endif; ?>
    </div>
    <div class="inner-header__waves top-waves">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(252,252,252,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(252,252,252,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(252,252,252,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="rgb(252,252,252)" />
            </g>
        </svg>
    </div>
</header>

<section class="post">
    <div class="post__wrap">
        <div class="post-main post-main-s">
            <div id="post-main-section" class="article-content line-numbers">
                <?php echo Service::set_lazyload($this->content); ?>
            </div>
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
</section>

<?php $this->need('footer.php'); ?>