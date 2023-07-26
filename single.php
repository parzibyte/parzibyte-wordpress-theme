<?php get_header(); ?>
<div class="flex flex-col sm:flex-row justify-center sm:flex-wrap md:flex-nowrap bg-white p-2 pb-8">
    <?php get_sidebar("left") ?>
    <div class="flex-grow px-2 md:order-2 sm:order-1 sm:w-1/3">
        <?php while (have_posts()) : the_post();
            get_template_part("post", "content");
        endwhile; ?>
        <hr class="border border-gray-950">
        <?php get_template_part("post-tags-and-categories"); ?>
        <div class="flex flex-col md:flex-row my-2">
            <div class="md:w-1/2">
                <?php previous_post_link('&laquo; %link'); ?>
            </div>
            <div class="md:w-1/2 flex justify-end items-center">
                <?php next_post_link('%link &raquo;'); ?>
            </div>
        </div>
        <hr class="border border-gray-950">
        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif; ?>

    </div>
    <?php get_sidebar("right") ?>
</div>

<?php get_footer(); ?>