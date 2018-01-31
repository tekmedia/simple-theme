
<footer id="footer">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> - <?php echo get_bloginfo('name'); ?>. <?php echo get_bloginfo('description'); ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="designer">
                    <p><a href="http://tekmedia.ru">Разработка сайта</a> - TekMedia</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" id="back-to-top" title="Back to top">&uarr;</a>

<?php wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.fancybox.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/backtotop.js"></script>
</body>
</html>