<?php
$category_slug = 'समाज';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 samaj-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <div class="d-flex align-items-center">
      <i class="bi bi-people-fill fs-3 text-purple me-2"></i>
      <h2 class="m-0"><?php echo esc_html($category_slug); ?></h2>
    </div>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-purple">
      सबै समाज समाचार
    </a>
  </div>

  <?php
  $samaj_posts = new WP_Query(array(
    'category_name'  => $category_slug,
    'posts_per_page' => 7
  ));

  if ($samaj_posts->have_posts()) :
    $count = 0;
    while ($samaj_posts->have_posts()) : $samaj_posts->the_post(); $count++;
  ?>
      <?php if ($count === 1) : ?>
        <!-- Featured Large Post -->
        <div class="card mb-4 shadow-sm border-0">
          <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>">
              <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid w-100 object-fit-cover rounded-top" style="height: 380px;" alt="<?php the_title(); ?>">
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

        <!-- Grid for next 6 posts -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php else : ?>
        <div class="col">
          <div class="card h-100 shadow-sm border-0">
            <?php if (has_post_thumbnail()) : ?>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="img-fluid w-100 object-fit-cover rounded-top" style="height: 180px;" alt="<?php the_title(); ?>">
              </a>
            <?php endif; ?>
            <div class="card-body">
              <h6>
                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                  <?php the_title(); ?>
                </a>
              </h6>
              <p class="text-muted small mb-0"><?php echo wp_trim_words(get_the_excerpt(), 14); ?></p>
            </div>
          </div>
        </div>
      <?php endif; ?>
  <?php
    endwhile;
    echo '</div>'; // Close row
    wp_reset_postdata();
  else :
    echo '<p>हाल कुनै समाज सम्बन्धी समाचार उपलब्ध छैन।</p>';
  endif;
  ?>
</div>

<style>
/* === Samaj Block === */
.samaj-block h2 {
  font-size: 2em;
  font-weight: 600;
  color: #6f42c1;
}

.samaj-block .card h3,
.samaj-block .card h6 {
    font-size: 1.5em;
  font-weight: 600;
  color: #212529;
}

.samaj-block .card p {
  font-size: 1.2em;
  color: #6c757d;
  line-height: 1.6;
}

.samaj-block a {
  transition: color 0.3s;
  color: #111;
  font-weight: 500;
}

.samaj-block a:hover {
  color: #6f42c1;
}

.btn-outline-purple {
  color: #6f42c1;
  border-color: #6f42c1;
  font-size: 14px;
  padding: 6px 14px;
  border-radius: 25px;
}

.btn-outline-purple:hover {
  background-color: #6f42c1;
  color: #fff;
}

/* Responsive */
@media (max-width: 767px) {
  .samaj-block h2 {
    font-size: 24px;
  }

  .samaj-block .card h3,
  .samaj-block .card h6 {
    font-size: 18px;
  }

  .btn-outline-purple {
    font-size: 13px;
    padding: 5px 12px;
  }
}
</style>
