<?php
$category_slug = 'खेलकुद';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 sports-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="m-0 text-danger"><i class="bi bi-trophy-fill me-2 fs-3"></i> <?php echo esc_html($category_slug); ?></h2>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-danger">थप समाचार</a>
  </div>

  <div class="row g-4">
    <!-- Left: Featured Post -->
    <div class="col-md-6">
      <?php
      $featured_post = new WP_Query(array(
        'category_name'  => $category_slug,
        'posts_per_page' => 1
      ));
      if ($featured_post->have_posts()) :
        while ($featured_post->have_posts()) : $featured_post->the_post(); ?>
          <a href="<?php the_permalink(); ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm">
              <img src="<?php the_post_thumbnail_url('large'); ?>" class="card-img-top" style="height: 350px; object-fit: cover;" alt="<?php the_title(); ?>">
              <div class="card-body">
                <h5 class="text-dark"><?php the_title(); ?></h5>
                <p class="text-muted"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
              </div>
            </div>
          </a>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <!-- Right: List of more sports news -->
    <div class="col-md-6">
      <div class="list-group">
        <?php
        $sports_posts = new WP_Query(array(
          'category_name'  => $category_slug,
          'posts_per_page' => 5,
          'offset'         => 1
        ));
        if ($sports_posts->have_posts()) :
          while ($sports_posts->have_posts()) : $sports_posts->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action d-flex">
              <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" class="me-3 rounded" style="width: 100px; height: 70px; object-fit: cover;" alt="<?php the_title(); ?>">
              <div>
                <h6 class="mb-1"><?php the_title(); ?></h6>
                <small class="text-muted"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></small>
              </div>
            </a>
        <?php endwhile; wp_reset_postdata(); endif; ?>
      </div>
    </div>
  </div>
</div>
<style>
/* === Sports Block === */
.sports-block h2 {
  font-size: 2em;
  font-weight: 700;
  color: #dc3545;
}

.sports-block h5, .sports-block h6 {
    font-size: 1.5em;
  font-weight: 600;
  color: #212529;
}

.sports-block .btn-outline-danger {
  color: #dc3545;
  border-color: #dc3545;
  border-radius: 25px;
  padding: 6px 14px;
  transition: all 0.3s;
}

.sports-block .btn-outline-danger:hover {
  background-color: #dc3545;
  color: #fff;
}

.sports-block p, .sports-block small {
  color: #6c757d;
}

/* Responsive */
@media (max-width: 767px) {
  .sports-block h2 {
    font-size: 22px;
  }

  .sports-block .btn-outline-danger {
    font-size: 13px;
    padding: 5px 12px;
  }

  .sports-block .list-group-item {
    flex-direction: column;
    align-items: start;
  }

  .sports-block .list-group-item img {
    width: 100%;
    height: auto;
    margin-bottom: 10px;
  }
}
</style>
