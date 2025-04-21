<?php get_header(); ?>

<section class="py-5 bg-light">
    <div class="container">
        <h1 class="mb-4 border-bottom pb-2 text-primary fw-bold">
            <?php single_cat_title(); ?>
        </h1>

        <?php if (have_posts()) : ?>
            <div class="row g-4">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_post_thumbnail_url('medium_large'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                            
                            </div>
                            
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                <nav>
                    <?php
                    the_posts_pagination([
                        'mid_size'  => 1,
                        'prev_text' => '<span class="btn btn-outline-primary me-2">« Prev</span>',
                        'next_text' => '<span class="btn btn-outline-primary ms-2">Next »</span>',
                        'before_page_number' => '<span class="btn btn-primary mx-1">',
                        'after_page_number'  => '</span>',
                    ]);
                    ?>
                </nav>
            </div>

        <?php else : ?>
            <p class="text-muted"><?php _e('No posts found in this category.', 'textdomain'); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
