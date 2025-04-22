<?php
$category_slug = 'शिक्षा';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 shiksha-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <div class="d-flex align-items-center">
      <i class="bi bi-mortarboard-fill fs-3 text-primary me-2"></i>
      <h2 class="m-0"><?php echo esc_html($category_slug); ?></h2>
    </div>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-primary">
      सबै हेर्नुहोस्
    </a>
  </div>

  <?php
  $shiksha_posts = new WP_Query(array(
    'category_name'  => $category_slug,
    'posts_per_page' => 6
  ));

  if ($shiksha_posts->have_posts()) :
    $count = 0;
  ?>
    <div class="row g-4">
      <?php while ($shiksha_posts->have_posts()) : $shiksha_posts->the_post(); $count++; ?>

        <?php if ($count <= 2) : ?>
          <!-- Top 2 featured posts side by side -->
          <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
              <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid rounded-top w-100 object-fit-cover" style="height: 250px;" alt="<?php the_title(); ?>">
                </a>
              <?php endif; ?>
              <div class="card-body">
                <h5>
                  <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                    <?php the_title(); ?>
                  </a>
                </h5>
                <p class="text-muted mb-0"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
              </div>
            </div>
          </div>
        <?php else : ?>
          <!-- Remaining posts in two columns -->
          <div class="col-md-6">
            <div class="d-flex mb-3 border-bottom pb-2">
              <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" class="me-3 rounded object-fit-cover" style="width: 100px; height: 75px;" alt="<?php the_title(); ?>">
                </a>
              <?php endif; ?>
              <div>
                <h6 class="mb-1">
                  <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                    <?php the_title(); ?>
                  </a>
                </h6>
                <p class="text-muted small mb-0"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
  <?php else : ?>
    <p>हाल कुनै शिक्षा सम्बन्धी समाचार उपलब्ध छैन।</p>
  <?php endif; ?>
</div>

<style>
.shiksha-block h2 {
  font-size: 2em;
  font-weight: 600;
  color: #0d6efd;
  margin: 0;
}

.shiksha-block .card h5,
.shiksha-block h6 {
    font-size: 1.5em;
  font-weight: 600;
  color: #212529;
}

.shiksha-block .card p,
.shiksha-block p {
  font-size: 1.2em;
  line-height: 1.6;
  color: #6c757d;
}

.shiksha-block a {
  transition: color 0.3s;
  font-weight: 600;
  color: #111;
}

.shiksha-block a:hover {
  color: #0d6efd;
}

.shiksha-block .btn-outline-primary {
  font-size: 14px;
  padding: 6px 14px;
  border-radius: 25px;
  font-weight: 500;
}

@media (max-width: 767px) {
  .shiksha-block h2 {
    font-size: 24px;
  }

  .shiksha-block .card h5,
  .shiksha-block h6 {
    font-size: 17px;
  }

  .shiksha-block .btn-outline-primary {
    font-size: 13px;
    padding: 5px 12px;
  }
}
</style>
