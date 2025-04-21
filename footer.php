<footer class="bg-dark text-white text-center py-4">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        <?php wp_nav_menu(['theme_location' => 'footer', 'menu_class' => 'nav justify-content-center']); ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
