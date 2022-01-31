<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    } 
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>
 
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div class="comment-self-wrap">
        <div class="comment-body__avatar">
            <?php $comments->gravatar('40', ''); ?>
        </div>
        <div class="comment-body__main">
            <div class="comment-body__main--meta">
                <div class="comment-author__meta">
                    <div class="comment-author__meta--wrap">
                        <h3><?php $comments->author(); ?></h3>
                        <?php if ($comments->authorId == $comments->ownerId) { ?>
                        <div class="comment-tag tag-primary">博主</div>
                        <?php } ?>
                    </div>
                    
                    <time datetime="<?php $comments->date('c'); ?>"><?php $comments->date('Y年m月d日 H:i'); ?></time>
                </div>
                <div class="comment-reply">
                    <?php $comments->reply(); ?>
                </div>
            </div>
            <div class="comment-body__main--text">
                <?php $comments->content(); ?>
            </div>
        </div>
    </div>
    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>

    
 
<?php } ?>

<div id="comments">
    <?php $this->comments()->to($comments); ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="reply-title">
    	    <h3 id="response"><?php _e('添加新评论'); ?></h3>
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>
        </div>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
    		    <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
            <?php else: ?>
                <div class="reply-userinfo">
                    <div class="reply-userinfo__item reply-name">
                        <input type="text" placeholder="<?php _e('称呼'); ?>" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
                    </div>
                    <div class="reply-userinfo__item reply-email">
                        <input type="email" placeholder="<?php _e('Email'); ?>" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </div>
                    <div class="reply-userinfo__item reply-url">
                        <input type="url" placeholder="<?php _e('网站'); ?>" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </div>
                </div>
            <?php endif; ?>
            <div class="reply-textarea">
                <textarea rows="8" cols="50" placeholder="<?php _e('内容'); ?>" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
            </div>
            <div class="reply-submit">
                <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
            </div>
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>


    <?php if ($comments->have()): ?>
	<h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
    
    <?php $comments->listComments(); ?>

    <div class="pagination">
        <?php $comments->pageNav('<i class="iconfont icon-angle-left"></i>', '<i class="iconfont icon-angle-right"></i>'); ?>
    </div>
    
    <?php endif; ?>
</div>