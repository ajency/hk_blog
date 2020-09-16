<?php
/**
 *
 * Footer
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>
</div>
<footer id="footer" class="footer">
    <div id="footer-widgets" class="footer-widgets">
        <div class="footer-wrapper row container m-auto p-0">
            <div class="footer-sidebar col-12">
                <?php
                    if(is_active_sidebar('footer-sidebar-1')){
                    dynamic_sidebar('footer-sidebar-1');
                    }
                ?>
            </div>
            <div class="footer-sidebar col-12">
                <?php
                    if(is_active_sidebar('footer-sidebar-2')){
                    dynamic_sidebar('footer-sidebar-2');
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="footer-text-section">
        <div class="row container m-auto p-0">
            <div class="disclaimer-copyright col-12">
                <?php
                    if(is_active_sidebar('footer-sidebar-3')){
                    dynamic_sidebar('footer-sidebar-3');
                    }
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>