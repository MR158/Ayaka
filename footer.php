<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer>
    <p>Copyright @ <?php echo(date("Y")) ?>
        <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    </p>
    <p>
        Theme by <a target="_blank" href="https://mr158.cn/archives/theme-ayaka.html">Ayaka</a>.
    </p>
</footer>
</main>

<div id="to-top">
    <i class="iconfont icon-angle-up"></i>
</div>

<?php $this->footer(); ?>
	<!-- <script src="<?php $this->options->themeUrl('js/jquery.pjax.js'); ?>" data-no-instant></script> -->
	<script src="<?php $this->options->themeUrl('js/prism.js'); ?>"></script>
	<script src="<?php $this->options->themeUrl('js/main.js'); ?>?v1.1.2"></script>
    <script data-no-instant src="https://cdnjs.cloudflare.com/ajax/libs/instantclick/3.0.1/instantclick.min.js"></script>
    <script data-no-instant>
        var SW_LOADING = <?php echo $this->options->swLoading === "able" ? "true" : "false" ?>

        InstantClick.on('change', function (isInit) {
            if(SW_LOADING && !isInit) pageLoading.active = true
            init()
            if(SW_LOADING) pageLoading.active = false
        })
        InstantClick.init('mousedown');
    </script>
    <?php if ($this->options->analytics): ?>
    <script data-no-instant>
        <?php $this->options->analytics();?>
    </script>
    <?php endif; ?>
</body>
</html>
