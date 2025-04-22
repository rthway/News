<div class="container my-4">
  <?php
  $categories = ['आर्थिक', 'कर्पोरेट', 'शेयर', 'बिमा', 'पर्यटन'];
  ?>
<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <div class="d-flex align-items-center">
      <i class="bi bi-heart-pulse-fill fs-3 text-danger me-2"></i>
      <h2 class="m-0 section-title">आर्थिक</h2>
    </div>
   
  </div>
  <!-- Tabs and "थप हेर्नुहोस्" on same line -->
  <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap">
    <ul class="nav nav-tabs border-0" id="categoryTabs">
      <?php foreach ($categories as $index => $cat_name) :
        $category = get_category_by_slug(sanitize_title($cat_name));
        if ($category) : ?>
          <li class="nav-item">
            <button class="nav-link <?php if ($index === 0) echo 'active'; ?>"
                    data-category-id="<?php echo esc_attr($category->term_id); ?>"
                    data-category-link="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                    data-bs-toggle="tab">
              <?php echo esc_html($cat_name); ?>
            </button>
          </li>
      <?php endif; endforeach; ?>
    </ul>
    <?php
    $first_cat = get_category_by_slug(sanitize_title($categories[0]));
    $category_link = get_category_link($first_cat->term_id);
    ?>
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-primary btn-sm more-link ms-2 mt-2 mt-md-0">
      थप हेर्नुहोस्
    </a>
  </div>

  <!-- Post Content -->
  <div class="tab-content mt-3" id="categoryContent">
    <div class="tab-pane fade show active">
      <div class="row" id="category-posts">
        <?php
        $query = new WP_Query([
          'cat' => $first_cat->term_id,
          'posts_per_page' => 5
        ]);
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post(); ?>
            <div class="col-md-4 mb-4">
              <div class="custom-card shadow-sm border rounded overflow-hidden h-100">
                <?php if (has_post_thumbnail()) : ?>
                  <div class="card-img-container">
                    <a href="<?php the_permalink(); ?>">
                      <img src="<?php the_post_thumbnail_url('medium'); ?>" class="w-100" alt="<?php the_title(); ?>">
                    </a>
                  </div>
                <?php endif; ?>
                <div class="p-3">
                  <h5 class="post-title mb-0">
                    <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none">
                      <?php the_title(); ?>
                    </a>
                  </h5>
                </div>
              </div>
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('#categoryTabs button').forEach(button => {
    button.addEventListener('click', function () {
      const catId = this.getAttribute('data-category-id');
      const catLink = this.getAttribute('data-category-link');

      // Activate tab
      document.querySelectorAll('#categoryTabs .nav-link').forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');

      // Update "थप हेर्नुहोस्" button
      const moreLink = document.querySelector('.more-link');
      if (moreLink) {
        moreLink.setAttribute('href', catLink);
      }

      // Load new posts via AJAX
      fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=load_category_posts&cat_id=' + catId)
        .then(res => res.text())
        .then(html => {
          document.querySelector('#category-posts').innerHTML = html;
        });
    });
  });
});
</script>

<style>
/* Tab Nav Styles */
#categoryTabs .nav-link {
  font-size: 2em;
  font-weight: 500;
  color: #333;
  border: none;
  background-color: #f8f9fa;
  margin-right: 5px;
  border-radius: 0.25rem;
  transition: all 0.3s ease;
}

#categoryTabs .nav-link.active {
  background-color: #0d6efd;
  color: #fff;
}

/* More Link */
.more-link {
  font-size: 14px;
  padding: 6px 12px;
  border-radius: 5px;
}

/* Custom Post Card */
.custom-card {
  transition: transform 0.2s ease;
}

.custom-card:hover {
  transform: translateY(-3px);
}

.custom-card img {
  object-fit: cover;
  height: 180px;
}

.post-title {
  font-size: 8px;
  font-weight: 600;
  color: #222;
}

.post-title a:hover {
  color: #0d6efd;
}

</style>