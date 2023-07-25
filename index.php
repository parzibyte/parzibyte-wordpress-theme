<?php get_header(); ?>
<div class="flex flex-col sm:flex-row justify-center sm:flex-wrap md:flex-nowrap bg-white p-2 pb-8">
    <?php get_sidebar("left") ?>
    <div class="flex-grow px-2 md:order-2 sm:order-1 sm:w-1/3 container">

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="tarjeta post">
                    <h2>
                        <a href="<?php the_permalink() ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No se encontraron posts.</p>
        <?php endif; ?>
    </div>
    <?php get_sidebar("right") ?>
</div>
<?php get_footer(); ?>