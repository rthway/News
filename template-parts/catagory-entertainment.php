<?php
$category_slug = 'मनोरन्जन';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 entertainment-dark-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="m-0 text-white"><i class="bi bi-film fs-3 me-2"></i><?php echo esc_html($category_slug); ?></h2>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-light">थप मनोरन्जन</a>
  </div>

  <div class="row g-4">
    <?php
    $entertainment_posts = new WP_Query(array(
      'category_name'  => $category_slug,
      'posts_per_page' => 6
    ));
    if ($entertainment_posts->have_posts()) :
      while ($entertainment_posts->have_posts()) : $entertainment_posts->the_post(); ?>
        <div class="col-md-4 col-sm-6">
          <a href="<?php the_permalink(); ?>" class="text-decoration-none">
            <div class="dark-card">
              <div class="card-image-wrapper">
                <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="img-fluid" />
                <div class="overlay-title">
                  <h5><?php the_title(); ?></h5>
                </div>
              </div>
            </div>
          </a>
        </div>
    <?php endwhile; wp_reset_postdata(); endif; ?>
  </div>
</div>
<style>
/* === Entertainment Dark Block === */
.entertainment-dark-block {
  background-color:rgb(193, 198, 204);
  padding: 40px 20px;
  border-radius: 10px;
}

.entertainment-dark-block h2 {
  font-size: 2em;
  font-weight: 700;
    color:rgb(56, 29, 206);
}

.entertainment-dark-block .btn-outline-light {
  border-radius: 20px;
  padding: 6px 16px;
  font-weight: 500;
}

.dark-card {
  background-color:rgb(215, 191, 238);
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.03);
  transition: transform 0.3s ease;
}

.dark-card:hover {
  transform: translateY(-5px);
}

.card-image-wrapper {
  position: relative;
  height: 350px;
  overflow: hidden;
}

.card-image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(70%);
  transition: 0.4s ease-in-out;
}

.dark-card:hover img {
  filter: brightness(100%);
}

.overlay-title {
  position: absolute;
  bottom: 20px;
  left: 20px;
  right: 20px;
  color: #fff;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.7);
}

.overlay-title h5 {
  font-size: 20px;
  font-weight: 600;
  margin: 0;
}

@media (max-width: 768px) {
  .card-image-wrapper {
    height: 260px;
  }

  .overlay-title h5 {
    font-size: 16px;
  }
}
</style>
