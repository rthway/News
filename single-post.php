<?php get_header(); ?>

<div class="container my-5">
    <div class="row">

        <!-- Main Content (8 columns) -->
        <div class="col-lg-8">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <!-- Post Heading -->
                <h1 class="mb-3"><?php the_title(); ?></h1>

                <!-- Author, Date & Text Size -->
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <div class="text-muted">
                        <i class="fa fa-user-circle"></i>
                        <?php the_author(); ?> | <i class="fa fa-clock-o"></i><?php echo get_the_date(); ?>
                    </div>
                    <div class="text-size-options">
                        <span class="me-2">Text Size:</span>
                        <button class="btn btn-sm btn-light me-1" onclick="changeTextSize('small')">S</button>
                        <button class="btn btn-sm btn-light me-1" onclick="changeTextSize('medium')">M</button>
                        <button class="btn btn-sm btn-light" onclick="changeTextSize('large')">L</button>
                    </div>
                </div>

                <!-- Thumbnail -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-4">
                        <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Content -->
                <div id="post-content" class="post-content mb-5 text-justify">
                    <?php the_content(); ?>
                </div>

                <!-- Related News -->
                <div class="related-news mt-5">
                    <h3 class="mb-4 border-bottom pb-2">सम्बन्धित खबर</h3>
                    <div class="row">
                        <?php
                        $related = new WP_Query([
                            'category__in'   => wp_get_post_categories($post->ID),
                            'posts_per_page' => 6,
                            'post__not_in'   => [$post->ID]
                        ]);

                        if ($related->have_posts()) :
                            while ($related->have_posts()) : $related->the_post(); ?>
                                <div class="col-md-4 mb-3">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'img-fluid mb-2']); ?>
                                        <?php endif; ?>
                                        <h6><?php the_title(); ?></h6>
                                    </a>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        else : ?>
                            <p>No related news found.</p>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endwhile; endif; ?>
        </div>

        <!-- Sidebar (4 columns) -->
<div class="col-lg-4">
    <?php if ( is_active_sidebar( 'main_sidebar' ) ) : ?>
        <div id="sidebar" class="widget-area">
            <?php dynamic_sidebar( 'main_sidebar' ); ?>
        </div>
    <?php else : ?>
        <p>No widgets found. Please add widgets from the WordPress admin panel.</p>
    <?php endif; ?>
</div>


    </div>
</div>

<!-- Text Size Script -->
<script>
    function changeTextSize(size) {
        const content = document.getElementById('post-content');
        content.style.fontSize = size === 'small' ? '14px' :
                                 size === 'medium' ? '18px' :
                                 '22px';
    }
</script>

<?php get_footer(); ?>
<style>
    .text-justify {
    text-align: justify;
}
</style>