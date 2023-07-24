<footer class="site-footer">
    <div class="container">
        <p class="text-center">Proudly brought to you by <a href="https://parzibyte.me/blog">Parzibyte</a> &copy; <?php echo date('Y'); ?></p>
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'container' => false,
                "menu_class" => "border border-gray-500 justify-center font-medium flex flex-col p-4  mt-4  rounded-lg  md:flex-row md:space-x-8 md:mt-0 bg-white"
            ));
            ?>
        </nav>
    </div>
</footer>