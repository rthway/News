<?php
$category_slug = 'बिज्ञान प्रबिधि';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 science-tech-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="m-0 text-success"><i class="bi bi-cpu me-2 fs-3"></i> <?php echo esc_html($category_slug); ?></h2>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-success">
      थप समाचार हेर्नुहोस्
    </a>
  </div>


  <!-- Grid of other posts -->
  <div class="row g-4">
    <?php
    $grid_posts = new WP_Query(array(
      'category_name'  => $category_slug,
      'posts_per_page' => 3,
      'offset'         => 3,
    ));
    while ($grid_posts->have_posts()) : $grid_posts->the_post(); ?>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <a href="<?php the_permalink(); ?>">
            <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php the_title(); ?>">
          </a>
          <div class="card-body">
            <h6><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a></h6>
            <p class="small text-muted"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
          </div>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</div>
<style>
/* === Science-Tech Block === */
.science-tech-block h2 {
  font-size: 2em;
  font-weight: 700;
  color: #198754;
}

.science-tech-block h5, .science-tech-block h6 {
    font-size: 2em;
  font-weight: 600;
  color:rgb(255, 255, 255);
}

.science-tech-block p {
  font-size: 1.5em;
  color:rgb(255, 255, 255);
}

.carousel-caption h5 {
  font-size: 1.5em;
  font-weight: 600;
}

.btn-outline-success {
  color: #198754;
  border-color: #198754;
  border-radius: 25px;
  padding: 6px 14px;
}

.btn-outline-success:hover {
  background-color: #198754;
  color: #fff;
}

/* Responsive */
@media (max-width: 767px) {
  .science-tech-block h2 {
    font-size: 22px;
  }

  .carousel-caption h5 {
    font-size: 16px;
  }

  .btn-outline-success {
    font-size: 13px;
    padding: 5px 12px;
  }
}
</style>