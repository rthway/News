<?php get_header(); ?>
<main class="container py-5">

<?php
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'meta_key'       => '_bihani_featured_post',
    'meta_value'     => 'yes',
);

$featured_query = new WP_Query($args);

if ($featured_query->have_posts()) :
    while ($featured_query->have_posts()) : $featured_query->the_post();

        // Get the post thumbnail URL
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
        ?>
        
        <div class="featured-post text-center">
            <h2 class="post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            
            <div class="post-meta">
                <span class="post-author"><?php the_author(); ?></span> | 
                <span class="post-time"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' अघि'; ?></span> | 
                <span class="post-comments"><?php comments_number(); ?></span>
            </div>

            <?php if ($thumbnail_url): ?>
                <div class="post-thumbnail">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>" class="img-fluid" />
                </div>
            <?php endif; ?>

            <div class="post-content">
                <?php 
                $content = wp_trim_words(get_the_content(), 25, '...'); 
                echo $content; 
                ?>
            </div>

            <a href="<?php the_permalink(); ?>" class="read-more">थप पढ्नुहोस्</a>
        </div>

    <?php endwhile;
    wp_reset_postdata();
else :
    echo '<p>No featured posts found.</p>';
endif;
?>



<hr>

<?php
get_template_part('category', 'politics'); // Include the politics category template
?>
<?php
get_template_part('category-interview'); // Include the politics category template
?>
<?php
get_template_part('category-health'); // Include the politics category template
?>

<?php
get_template_part('category-education-block'); // Include the politics category template
?>


<!-- Main Content Section - first content block-->
<div class="row my-4">
        <div class="col-lg-8">
            <!-- Get and display the first content block -->
            <?php get_template_part('category-rajniti-block'); ?>
        </div>
        
        <div class="col-lg-4">
            <?php if (is_active_sidebar('sidebar-ad-1')) : ?>
                <!-- Display the sidebar ad if it's active -->
                <?php dynamic_sidebar('sidebar-ad-1'); ?>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
