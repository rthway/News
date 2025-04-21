<div class="container my-4">
  <div class="row">
    <!-- Left Side: Featured Post -->
    <div class="col-md-7">
      <?php
      $featured = new WP_Query([
        'category_name' => 'आर्थिक',
        'posts_per_page' => 1
      ]);
      if ($featured->have_posts()) :
        while ($featured->have_posts()) : $featured->the_post(); ?>
          <div class="position-relative text-white">
            <?php if (has_post_thumbnail()) : ?>
              <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid w-100" style="height: 400px; object-fit: cover;" alt="<?php the_title(); ?>">
            <?php endif; ?>
            <div class="position-absolute bottom-0 start-0 w-100 p-3" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);">
              <h4 class="fw-bold"><?php the_title(); ?></h4>
              <small><i class="bi bi-clock"></i> <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' अघि'; ?></small>
            </div>
          </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <!-- Right Side: 7 Posts -->
    <div class="col-md-5">
      <?php
      $economics = new WP_Query([
        'category_name' => 'आर्थिक',
        'posts_per_page' => 7,
        'offset' => 1
      ]);
      if ($economics->have_posts()) :
        while ($economics->have_posts()) : $economics->the_post(); ?>
          <div class="d-flex mb-3 pb-3 border-bottom">
            <div class="me-3">
              <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" class="img-fluid" style="width: 100px; height: 70px; object-fit: cover;" alt="<?php the_title(); ?>">
              <?php endif; ?>
            </div>
            <div>
              <a href="<?php the_permalink(); ?>" class="text-dark fw-semibold d-block"><?php the_title(); ?></a>
              <small class="text-muted"><i class="bi bi-clock"></i> <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' अघि'; ?></small>
            </div>
          </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </div>

  <!-- Update Button -->
  <div class="text-center mt-4">
    <button class="btn w-100 text-white fw-semibold" style="background-color: #f7931e;">
      <i class="bi bi-arrow-clockwise"></i> २४ घण्टाका ताजा अपडेट
    </button>
  </div>
</div>
