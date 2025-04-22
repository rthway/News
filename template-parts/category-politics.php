
<?php
$category_slug = 'राजनीति';
$category = get_category_by_slug($category_slug);
$category_link = get_category_link($category->term_id);
?>

<div class="container my-4 economic-section">
  <!-- Category Heading and Link -->
  <div class="d-flex justify-content-between align-items-center mb-3 economic-header">
    <h2 class="economic-title m-0"><?php echo esc_html($category->name); ?></h2>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-primary btn-sm rounded-pill economic-more-btn">
      थप हेर्नुहोस् <i class="bi bi-arrow-right ms-1"></i>
    </a>
 
  </div>
<hr>
  <div class="row economic-content">
    <!-- Left Column: Featured Post -->
    <div class="col-md-7 economic-featured-post">
      <?php
      $featured = new WP_Query([
        'category_name' => $category_slug,
        'posts_per_page' => 1
      ]);
      if ($featured->have_posts()) :
        while ($featured->have_posts()) : $featured->the_post(); ?>
          <div class="position-relative text-white">
            <?php if (has_post_thumbnail()) : ?>
              <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid w-100 economic-featured-img" alt="<?php the_title(); ?>">
            <?php endif; ?>
            <div class="position-absolute bottom-0 start-0 w-100 p-3 economic-featured-caption">
              <h4 class="fw-bold fs-4"><?php the_title(); ?></h4>
              <small><i class="bi bi-clock"></i> <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' अघि'; ?></small>
            </div>
          </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <!-- Right Column: More Posts -->
    <div class="col-md-5 economic-side-posts">
      <?php
      $economics = new WP_Query([
        'category_name' => $category_slug,
        'posts_per_page' => 3,
        'offset' => 1
      ]);
      if ($economics->have_posts()) :
        while ($economics->have_posts()) : $economics->the_post(); ?>
          <div class="d-flex mb-3 pb-3 border-bottom economic-post-item">
            <div class="me-3">
              <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" class="img-fluid economic-post-thumb" alt="<?php the_title(); ?>">
              <?php endif; ?>
            </div>
            <div>
              <a href="<?php the_permalink(); ?>" class="text-dark fw-semibold d-block economic-post-title"><?php the_title(); ?></a>
              <small class="text-muted"><i class="bi bi-clock"></i> <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' अघि'; ?></small>
            </div>
          </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </div>

  <!-- Refresh Button -->
  <div class="text-center mt-4 economic-refresh-btn">
    <a href="<?php echo esc_url($category_link); ?>" class="btn w-100 text-white fw-semibold" style="background-color: #f7931e;">
      <i class="bi bi-arrow-clockwise"></i> २४ घण्टाका ताजा अपडेट
    </a>
  </div>
</div>
