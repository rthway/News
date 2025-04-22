<?php
$category_slug = 'जिवनशैली';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 jivansthali-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <div class="d-flex align-items-center">
      <i class="bi bi-sun-fill fs-3 text-warning me-2"></i>
      <h2 class="m-0"><?php echo esc_html($category_slug); ?></h2>
    </div>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-warning">
      थप हेर्नुहोस्
    </a>
  </div>

  <?php
  $lifestyle_posts = new WP_Query(array(
    'category_name'  => $category_slug,
    'posts_per_page' => 6
  ));

  if ($lifestyle_posts->have_posts()) :
    $lifestyle_posts->the_post(); // Get first post
  ?>
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>">
              <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid rounded-top w-100 object-fit-cover" alt="<?php the_title(); ?>">
            </a>
          <?php endif; ?>
          <div class="card-body p-4">
            <h3>
              <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                <?php the_title(); ?>
              </a>
            </h3>
            <p class="text-muted"><?php echo wp_trim_words(get_the_excerpt(), 35); ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row row-cols-1 g-3">
          <?php while ($lifestyle_posts->have_posts()) : $lifestyle_posts->the_post(); ?>
            <div class="col">
              <div class="d-flex border-bottom pb-3">
                <?php if (has_post_thumbnail()) : ?>
                  <a href="<?php the_permalink(); ?>" class="me-3" style="width: 120px;">
                    <img src="<?php the_post_thumbnail_url('medium'); ?>" class="img-fluid rounded object-fit-cover" alt="<?php the_title(); ?>">
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
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  <?php
    wp_reset_postdata();
  else :
    echo '<p>हाल कुनै जिवनशैली सम्बन्धी सामग्री उपलब्ध छैन।</p>';
  endif;
  ?>
</div>
<style>
/* === JivanSthali Block === */
.jivansthali-block h2 {
  font-size: 28px;
  font-weight: 600;
  color: #f59e0b; /* Tailwind's amber-500 */
}

.jivansthali-block .card h3,
.jivansthali-block h6 {
  font-weight: 600;
  font-size: 20px;
  color: #212529;
}

.jivansthali-block p {
  font-size: 15px;
  line-height: 1.5;
  color: #6c757d;
}

.jivansthali-block a {
  color: #111;
  transition: color 0.3s;
  font-weight: 500;
}

.jivansthali-block a:hover {
  color: #f59e0b;
}

.btn-outline-warning {
  color: #f59e0b;
  border-color: #f59e0b;
  font-size: 14px;
  padding: 6px 14px;
  border-radius: 25px;
}

.btn-outline-warning:hover {
  background-color: #f59e0b;
  color: #fff;
}

/* Responsive */
@media (max-width: 767px) {
  .jivansthali-block h2 {
    font-size: 24px;
  }

  .jivansthali-block .card h3,
  .jivansthali-block h6 {
    font-size: 18px;
  }

  .jivansthali-block .btn-outline-warning {
    font-size: 13px;
    padding: 5px 12px;
  }
}
</style>
