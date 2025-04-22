<?php
$category_slug = 'अन्तरवार्ता';
$category_obj  = get_category_by_slug($category_slug);
$category_link = get_category_link($category_obj);
?>

<div class="container my-5 antarwbarta-block">
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <div class="d-flex align-items-center">
      <i class="bi bi-mic-fill fs-3 text-danger me-2"></i>
      <h2 class="m-0"><?php echo esc_html($category_slug); ?></h2>
    </div>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-danger">
      सबै अन्तरवार्ता हेर्नुहोस्
    </a>
  </div>

  <!-- Carousel of featured interviews -->
  <div class="overflow-auto pb-3">
    <div class="d-flex flex-nowrap gap-3">
      <?php
      $interview_posts = new WP_Query(array(
        'category_name'  => $category_slug,
        'posts_per_page' => 5,
      ));
      if ($interview_posts->have_posts()) :
        while ($interview_posts->have_posts()) : $interview_posts->the_post(); ?>
          <div class="card flex-shrink-0 border-0 shadow-sm" style="width: 280px;">
            <?php if (has_post_thumbnail()) : ?>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top object-fit-cover" style="height:180px;" alt="<?php the_title(); ?>">
              </a>
            <?php endif; ?>
            <div class="card-body">
              <h6 class="card-title">
                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                  <?php the_title(); ?>
                </a>
              </h6>
              <p class="card-text small text-muted mb-1"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
            </div>
          </div>
        <?php endwhile;
        wp_reset_postdata();
      else :
        echo '<p>हाल कुनै अन्तरवार्ता उपलब्ध छैन।</p>';
      endif;
      ?>
    </div>
  </div>

</div>
<style>
/* === Antarwbarta Block === */
.antarwbarta-block h2 {
  font-size: 2em;
  font-weight: 700;
  color: #dc3545;
}

.antarwbarta-block .card h6 {
  font-size: 1.5em;
  font-weight: 600;
}

.antarwbarta-block p {
  font-size: 1.2em;
  color: #6c757d;
}

.antarwbarta-block a {
  color: #111;
  transition: 0.3s ease;
  font-weight: 500;
}

.antarwbarta-block a:hover {
  color: #dc3545;
}

.btn-outline-danger {
  color: #dc3545;
  border-color: #dc3545;
  font-size: 14px;
  padding: 6px 14px;
  border-radius: 25px;
}

.btn-outline-danger:hover {
  background-color: #dc3545;
  color: #fff;
}

.antarwbarta-block .card {
  transition: transform 0.3s ease;
}

.antarwbarta-block .card:hover {
  transform: translateY(-5px);
}

@media (max-width: 767px) {
  .antarwbarta-block h2 {
    font-size: 22px;
  }

  .antarwbarta-block .card h6 {
    font-size: 16px;
  }

  .btn-outline-danger {
    font-size: 13px;
    padding: 5px 12px;
  }
}
</style>
