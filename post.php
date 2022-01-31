<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<header class="inner-header">
    <div class="inner-header__main">
        <figure class="post-thumb">
            <?php if(get_postthumb($this)): ?>
                <img src="<?php echo get_postthumb($this) ?>">
            <?php else: ?>
                <img src="<?php $this->options->themeUrl('img/default_thumb.jpg'); ?>">
            <?php endif; ?>
        </figure>
        <div class="post-info">
            <h1 class="post-info__title"><?php $this->title() ?></h1>
            <div class="post-info__meta">
                <div class="post-info__meta--author">
                    <img class="author-avatar" src="<?php $this->options->logoUrl() ?>">
                    <a class="author-name" href="<?php $this->author->permalink(); ?>"><?php $this->author() ?></a>
                </div>
                <div class="post-info__meta--time">
                    <i class="iconfont icon-clock"></i>
                    <time datetime="<?php $this->date('c'); ?>"><?php $this->date('Y年m月d日'); ?></time>
                </div>
            </div>
        </div>
    </div>
    <?php if(get_postthumb($this)): ?>
    <div class="inner-header__bg top-bg" style="background-image:url(<?php echo get_postthumb($this) ?>)">
    <?php else: ?>
    <div class="inner-header__bg top-bg" style="background-image:url(<?php $this->options->themeUrl('/img/default_thumb.jpg'); ?>)">
    <?php endif; ?>
    </div>
</header>

<section class="main">
    <div class="main__wrap">
        <div id="post-nav" class="post-menu"></div>
        <div class="post-main">
            <div class="post-main__tags">
                <?php foreach($this->categories as $cat): ?>
                <a href="<?php echo $cat["permalink"]?>" class="post-tag-cat tag-warning">
                    <i class="iconfont icon-folder"></i>
                    <span><?php echo $cat["name"] ?></span>
                </a>
                <?php endforeach; ?>
                <?php foreach($this->tags as $tag): ?>
                <a href="<?php echo $tag["permalink"]?>" class="post-tag-tag tag-success">
                    <i class="iconfont icon-tag"></i>
                    <span><?php echo $tag["name"] ?></span>
                </a>
                <?php endforeach; ?>
            </div>
            <div id="post-main-section" class="article-content">
                <?php $this->content(); ?>
            </div>
            <ul class="post-near">
                <li>
                    <i class="iconfont icon-angle-left"></i>
                    <?php $this->theNext('%s','没有了'); ?>
                </li>
                <li>
                    <?php $this->thePrev('%s','没有了'); ?>
                    <i class="iconfont icon-angle-right"></i>
                </li>
            </ul>
            <?php $this->need('comments.php'); ?>
        </div>
    </div>
</section>

<?php $this->need('footer.php'); ?>
