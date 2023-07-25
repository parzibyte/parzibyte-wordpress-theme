<footer class="site-footer">
    <div class="container">
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'container' => false,
                "menu_class" => "justify-end font-medium flex flex-col p-4  mt-4  rounded-lg  md:flex-row md:space-x-8 md:mt-0 bg-white"
            ));
            ?>
        </nav>
        <p class="text-center">Proudly brought to you by <a href="https://parzibyte.me/blog">Parzibyte</a> &copy; <?php echo date('Y'); ?></p>
    </div>
</footer>