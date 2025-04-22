<?php
$category_slug = 'समाज';
$category_link = get_category_link(get_category_by_slug($category_slug));
?>

<div class="container my-5 politics-block">
  <hr>
  <!-- Section Title with Button -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center">
      <i class="bi bi-megaphone fs-3 text-primary me-2"></i>
      <h2 class="m-0"><?php echo esc_html($category_slug); ?></h2>
    </div>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-primary">
      थप हेर्नुहोस्
    </a>
  </div>
  <hr>

  <?php
  $rajniti_posts = new WP_Query(array(
    'category_name'  => $category_slug,
    'posts_per_page' => 7
  ));

  if ($rajniti_posts->have_posts()) :
    $count = 0;
    while ($rajniti_posts->have_posts()) : $rajniti_posts->the_post();
      $count++;
      if ($count == 1) :
  ?>
        <!-- Featured First Post -->
        <div class="card mb-4 shadow-sm border-0 flex-md-row">
          <?php if (has_post_thumbnail()) : ?>
            <div class="col-md-5">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="<?php the_title(); ?>">
              </a>
            </div>
          <?php endif; ?>
          <div class="col-md-7 p-4">
            <h3 class="mb-2">
              <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                <?php the_title(); ?>
              </a>
            </h3>
            <p class="text-muted"><?php echo wp_trim_words(get_the_excerpt(), 45); ?></p>
          </div>
        </div>
        <div class="row g-4">
  <?php
      else :
  ?>
        <!-- Grid Cards (2 per row) -->
        <div class="col-md-6">
          <div class="card h-100 border-0 shadow-sm d-flex flex-row">
            <?php if (has_post_thumbnail()) : ?>
              <a href="<?php the_permalink(); ?>" class="col-5">
                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="<?php the_title(); ?>">
              </a>
            <?php endif; ?>
            <div class="p-3 col-7">
              <h6 class="mb-2">
                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                  <?php the_title(); ?>
                </a>
              </h6>
              
            </div>
          </div>
        </div>
  <?php
      endif;
    endwhile;
    echo '</div>'; // Close row
    wp_reset_postdata();
  else :
    echo '<p>हाल कुनै राजनीति सम्बन्धी समाचार उपलब्ध छैन।</p>';
  endif;
  ?>
</div>

<style>
/* ==== Politics Block Optimized CSS ==== */
.politics-block h2 {
  font-size: 2em;
  font-weight: 600;
  color: #0d6efd;
  margin: 0;
}

.politics-block .card h3,
.politics-block .card h6 {
  font-size: 1.5em;
  font-weight: 600;
  color: #212529;
}

.politics-block .card p {
  font-size: 1.2em;
  line-height: 1.6;
  color: #6c757d;
}

.politics-block .card a {
  transition: color 0.3s;
  color: rgb(9, 28, 56);
  font-size: 1.1em;
  font-weight: 600;
  text-decoration: none;
}

.politics-block .card a:hover {
  color: #0a58ca;
}

.politics-block .btn-outline-primary {
  font-size: 14px;
  padding: 6px 14px;
  border-radius: 25px;
  font-weight: 500;
}

.politics-block img {
  object-fit: cover;
  height: 100%;
  width: 100%;
  display: block;
}

/* Responsive tweaks */
@media (max-width: 767px) {
  .politics-block h2 {
    font-size: 24px;
  }

  .politics-block .card h3,
  .politics-block .card h6 {
    font-size: 18px;
  }

  .politics-block .btn-outline-primary {
    padding: 5px 12px;
    font-size: 13px;
  }
}
</style>
