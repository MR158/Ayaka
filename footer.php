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
	<script src="<?php $this->options->themeUrl('js/main.js'); ?>"></script>
    <script data-no-instant src="https://cdnjs.cloudflare.com/ajax/libs/instantclick/3.0.1/instantclick.min.js"></script>
    <script data-no-instant>
        InstantClick.on('change', function () {
            init()
        })
        InstantClick.init('mousedown');
    </script>
</body>
</html>
