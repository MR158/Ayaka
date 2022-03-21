<?php
/**
 * 一款基于响应式设计的简约风博客主题
 * 
 * @package Ayaka
 * @author MR158
 * @version 1.1.2
 * @link https://mr158.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');?>
<header class="index-header">
    <div class="index-header__bg top-bg" style="background-image:url(<?php $this->options->themeUrl('/img/default_bg.jpg'); ?>)"></div>
    <div class="index-header__waves top-waves">
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

<section class="profile">
    <div class="profile__main">
        <div class="profile__main--avatar">
            <?php if($this->options->logoUrl): ?>
                <img src="<?php echo $this->options->logoUrl; ?>" alt="LOGO">
            <?php else: ?>
                <img src="<?php $this->options->themeUrl('/img/default_avatar.jpg');?>" alt="LOGO">
            <?php endif; ?>
        </div>
        <?php if($this->options->homeTitle):?>
            <h1 class="profile__main--title"><?php $this->options->homeTitle(); ?></h1>
        <?php else: ?>
            <h1 class="profile__main--title"><?php $this->options->title(); ?></h1>
        <?php endif; ?>
        <?php if($this->options->homeDesc):?>
            <p class="profile__main--desc"><?php $this->options->homeDesc(); ?></p>
        <?php else: ?>
            <p class="profile__main--desc"><?php $this->options->description(); ?></p>
        <?php endif; ?>
        <div class="profile__main--social-icons social-icons">
            <?php if($this->options->socialQQ): ?>
            <a class="social-icons__item" href="http://wpa.qq.com/msgrd?v=3&uin=<?php $this->options->socialQQ() ?>&site=qq&menu=yes" target="_blank">
                <div class="social-qq">
                    <i class="iconfont icon-qq"></i>
                </div>
            </a>
            <?php endif; ?>
            <?php if($this->options->socialGithubUrl): ?>
            <a class="social-icons__item" href="<?php $this->options->socialGithubUrl() ?>" target="_blank">
                <div class="social-github">
                    <i class="iconfont icon-github"></i>
                </div>
            </a>
            <?php endif; ?>
            <?php if($this->options->socialEmail): ?>
            <a class="social-icons__item" href="mailto:<?php $this->options->socialEmail() ?>" target="_blank">
                <div class="social-email">
                    <i class="iconfont icon-mail-alt"></i>
                </div>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="content">
    <div class="content__wrap">
        <section class="post-list-wrap">
            <section class="post-list">
            <?php while($this->next()): ?>
                <article class="post-item ayaka-block">
                    <figure class="post-item__thumb">
                        <a href="<?php $this->permalink() ?>">
                            <div class="post-loading lazy-load-placeholder">
                                <div class="post-loading__1"></div>
                                <div class="post-loading__2"></div>
                                <div class="post-loading__3"></div>
                            </div>
                            <img src="<?php $this->options->themeUrl('/img/default_thumb.jpg'); ?>"
                            <?php if(Service::get_postthumb($this)): ?>
                                 data-src="<?php echo Service::get_postthumb($this) ?>"
                            <?php else: ?>
                                 data-src="<?php $this->options->themeUrl('/img/default_thumb.jpg'); ?>" 
                            <?php endif; ?>
                                 alt="<?php $this->title() ?>"
                                 class="lazy-load">
                        </a>
                    </figure>
                    <div class="post-item__info">
                        <h2 class="post-item__info--title">
                            <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                        </h2>
                        <div class="post-item__info--tags">
                            <div class="post-tag-time tag-primary">
                                <i class="iconfont icon-clock"></i>
                                <time datetime="<?php $this->date('c'); ?>"><?php $this->date('Y年m月d日'); ?></time>
                            </div>
                            <?php foreach($this->categories as $cat): ?>
                            <a href="<?php echo $cat["permalink"]?>" class="post-tag-cat tag-warning">
                                <i class="iconfont icon-folder"></i>
                                <span><?php echo $cat["name"] ?></span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="post-item__info--desc text-ellipsis">
                            <a href="<?php $this->permalink() ?>">
                                <?php $this->excerpt(120, ' ...'); ?>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
            </section>
            <nav class="pagination">	
                <?php $this->pageNav('<i class="iconfont icon-angle-left"></i>', '<i class="iconfont icon-angle-right"></i>'); ?>
            </nav>
        </section>
    </div>
</section>

<?php $this->need('footer.php'); ?>
