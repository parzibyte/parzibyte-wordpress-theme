<?php get_header(); ?>
<div class="flex flex-col sm:flex-row justify-center sm:flex-wrap md:flex-nowrap bg-white p-2 pb-8">
    <?php get_sidebar("left") ?>
    <div class="flex-grow px-2 md:order-2 sm:order-1 sm:w-1/3 container">

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post();
                get_template_part("post", "content");
            endwhile; ?>
        <?php else : ?>
            <p>No se encontraron posts.</p>
        <?php endif; ?>
        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>
    </div>
    <?php get_sidebar("right") ?>
</div>
<?php get_footer(); ?>