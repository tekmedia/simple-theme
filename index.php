<?php get_header(); ?>
<section class="content">
    <div class="container">
        <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
                <div class="post">
                    <div class="section-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="entry"><?php the_content(); ?></div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>