<?php
$category_slug = 'स्वास्थ्य';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 swasthya-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <div class="d-flex align-items-center">
      <i class="bi bi-heart-pulse-fill fs-3 text-danger me-2"></i>
      <h2 class="m-0"><?php echo esc_html($category_slug); ?></h2>
    </div>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-danger">
      थप हेर्नुहोस्
    </a>
  </div>

  <?php
  $swasthya_posts = new WP_Query(array(
    'category_name'  => $category_slug,
    'posts_per_page' => 5
  ));

  if ($swasthya_posts->have_posts()) :
    $count = 0;
  ?>
    <div class="row g-4">
      <?php while ($swasthya_posts->have_posts()) : $swasthya_posts->the_post(); $count++; ?>

        <?php if ($count === 1) : ?>
          <!-- Featured Post -->
          <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
              <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid rounded-top w-100 object-fit-cover featured-img" alt="<?php the_title(); ?>">
                </a>
              <?php endif; ?>
              <div class="card-body p-4">
                <h3>
                  <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <p class="text-muted"><?php echo wp_trim_words(get_the_excerpt(), 40); ?></p>
              </div>
            </div>
          </div>

          <!-- Right Column: Start -->
          <div class="col-md-6">
            <div class="row g-3">
        <?php else : ?>
              <div class="col-12 col-sm-6">
                <div class="card h-100 border-0 shadow-sm">
                  <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                      <img src="<?php the_post_thumbnail_url('medium'); ?>" class="img-fluid rounded-top object-fit-cover" alt="<?php the_title(); ?>">
                    </a>
                  <?php endif; ?>
                  <div class="card-body py-3 px-2">
                    <h6 class="mb-1">
                      <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                        <?php the_title(); ?>
                      </a>
                    </h6>
                    <p class="text-muted small mb-0"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                  </div>
                </div>
              </div>
        <?php endif; ?>
      <?php endwhile; ?>
            </div> <!-- inner row -->
          </div> <!-- right column -->
    </div> <!-- main row -->
    <?php wp_reset_postdata(); ?>
  <?php else : ?>
    <p>हाल कुनै स्वास्थ्य सम्बन्धी समाचार उपलब्ध छैन।</p>
  <?php endif; ?>
</div>

<style>
.swasthya-block h2 {
  font-size: 2em;
  font-weight: 600;
  color: #dc3545;
  margin: 0;
}

.swasthya-block .card h3,
.swasthya-block .card h6 {
  font-weight: 600;
  font-size: 1.5em;
  color: #212529;
}

.swasthya-block .card p {
  font-size: 1.5em;
  line-height: 1.6;
  color: #6c757d;
}

.swasthya-block .card a {
  transition: color 0.3s;
  font-weight: 600;
  color: #111;
}

.swasthya-block .card a:hover {
  color: #dc3545;
}

.swasthya-block .btn-outline-danger {
  font-size: 1.2em;
  padding: 6px 14px;
  border-radius: 25px;
  font-weight: 500;
}

.swasthya-block .featured-img {
  height: 350px;
  object-fit: cover;
  width: 100%;
  display: block;
}

@media (max-width: 767px) {
  .swasthya-block h2 {
    font-size: 24px;
  }

  .swasthya-block .card h3,
  .swasthya-block .card h6 {
    font-size: 18px;
  }

  .swasthya-block .btn-outline-danger {
    font-size: 13px;
    padding: 5px 12px;
  }

  .swasthya-block .featured-img {
    height: 220px;
  }
}
</style>
