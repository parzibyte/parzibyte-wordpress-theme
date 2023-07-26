<div class="tarjeta post">
    <h2>
        <a href="<?php the_permalink() ?>">
            <?php the_title(); ?>
        </a>
    </h2>
    <?php get_template_part("post-tags-and-categories"); ?>
    <div>
        <?php the_content(); ?>
    </div>
</div>