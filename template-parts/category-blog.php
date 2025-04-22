<?php
$category_slug = 'बिचार-ब्लग';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 bichar-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="m-0"><i class="bi bi-chat-left-text fs-3 me-2 text-primary"></i> <?php echo esc_html($category_slug); ?></h2>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-primary">
      थप  हेर्नुहोस्
    </a>
  </div>

  <?php
  $bichar_posts = new WP_Query(array(
    'category_name'  => $category_slug,
    'posts_per_page' => 4,
  ));

  if ($bichar_posts->have_posts()) :
    $count = 0;
    echo '<div class="row g-4">';
    while ($bichar_posts->have_posts()) : $bichar_posts->the_post();
      if ($count === 0) : ?>
        <!-- Featured post -->
        <div class="col-12">
          <div class="card border-0 shadow-lg">
            <div class="row g-0">
              <div class="col-md-5">
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid rounded-start w-100 h-100 object-fit-cover" alt="<?php the_title(); ?>">
                </a>
              </div>
              <div class="col-md-7 p-4">
                <h3>
                  <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <p class="text-muted"><?php echo wp_trim_words(get_the_excerpt(), 35); ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php else : ?>
        <!-- Grid posts -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top object-fit-cover" style="height:200px;" alt="<?php the_title(); ?>">
            </a>
            <div class="card-body">
              <h6>
                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                  <?php the_title(); ?>
                </a>
              </h6>
              <p class="small text-muted"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
            </div>
          </div>
        </div>
      <?php
      endif;
      $count++;
    endwhile;
    echo '</div>';
    wp_reset_postdata();
  else :
    echo '<p>हाल कुनै बिचार वा ब्लग उपलब्ध छैन।</p>';
  endif;
  ?>
</div>
<style>
/* === Bichar Block === */
.bichar-block h2 {
  font-size: 2em;
  font-weight: 700;
  color: #0d6efd;
}

.bichar-block h3 {
  font-size: 1.5em;
  font-weight: 600;
  color: #212529;
}

.bichar-block h6 {
  font-size: 1.5em;
  font-weight: 600;
}

.bichar-block p {
  font-size: 1.2em;
  color: #6c757d;
  line-height: 1.6;
}

.bichar-block a {
  transition: color 0.3s;
  font-weight: 500;
}

.bichar-block a:hover {
  color: #0d6efd;
}

.btn-outline-primary {
  color: #0d6efd;
  border-color: #0d6efd;
  font-size: 14px;
  padding: 6px 14px;
  border-radius: 25px;
}

.btn-outline-primary:hover {
  background-color: #0d6efd;
  color: #fff;
}

@media (max-width: 767px) {
  .bichar-block h2 {
    font-size: 22px;
  }

  .bichar-block h3,
  .bichar-block h6 {
    font-size: 16px;
  }

  .btn-outline-primary {
    font-size: 13px;
    padding: 5px 12px;
  }
}
</style>
