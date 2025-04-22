<?php
$category_slug = 'बिश्व';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 world-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="m-0 text-primary"><i class="bi bi-globe-central-south-asia me-2 fs-3"></i> <?php echo esc_html($category_slug); ?></h2>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-primary">थप बिश्व समाचार</a>
  </div>

  <div class="row g-4">
    <!-- Featured Post -->
    <div class="col-md-6">
      <?php
      $featured_world = new WP_Query(array(
        'category_name'  => $category_slug,
        'posts_per_page' => 1
      ));
      if ($featured_world->have_posts()) :
        while ($featured_world->have_posts()) : $featured_world->the_post(); ?>
          <a href="<?php the_permalink(); ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
              <img src="<?php the_post_thumbnail_url('large'); ?>" class="card-img-top" style="height: 370px; object-fit: cover;" alt="<?php the_title(); ?>">
              <div class="card-body">
                <h5 class="text-dark"><?php the_title(); ?></h5>
                <p class="text-muted"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
              </div>
            </div>
          </a>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <!-- Four grid posts -->
    <div class="col-md-6">
      <div class="row g-3">
        <?php
        $more_world = new WP_Query(array(
          'category_name'  => $category_slug,
          'posts_per_page' => 4,
          'offset'         => 1
        ));
        if ($more_world->have_posts()) :
          while ($more_world->have_posts()) : $more_world->the_post(); ?>
            <div class="col-6">
              <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                <div class="card h-100">
                  <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" style="height: 150px; object-fit: cover;" alt="<?php the_title(); ?>">
                  <div class="card-body p-2">
                    <h6 class="text-dark"><?php the_title(); ?></h6>
                  </div>
                </div>
              </a>
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
      </div>
    </div>
  </div>
</div>
<style>
/* === World Block === */
.world-block h2 {
  font-size: 2em;
  font-weight: 700;
  color: #0d6efd;
}

.world-block h5, .world-block h6 {
    font-size: 1.5em;
  font-weight: 600;
  color: #212529;
}

.world-block .btn-outline-primary {
  color: #0d6efd;
  border-color: #0d6efd;
  border-radius: 25px;
  padding: 6px 14px;
  transition: all 0.3s;
}

.world-block .btn-outline-primary:hover {
  background-color: #0d6efd;
  color: #fff;
}

.world-block p {
  color: #6c757d;
}

@media (max-width: 767px) {
  .world-block h2 {
    font-size: 22px;
  }

  .world-block .btn-outline-primary {
    font-size: 13px;
    padding: 5px 12px;
  }

  .world-block .card-img-top {
    height: 200px !important;
  }
}
</style>
