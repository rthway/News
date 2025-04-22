<div class="container my-4">
  <?php
  $categories = ['आर्थिक', 'कर्पोरेट', 'शेयर', 'बिमा', 'पर्यटन'];
  ?>

  <!-- Tab Buttons -->
  <ul class="nav nav-tabs" id="categoryTabs">
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

  <!-- Top Heading and "थप हेर्नुहोस्" Link -->
  <?php
  $first_cat = get_category_by_slug(sanitize_title($categories[0]));
  $category_link = get_category_link($first_cat->term_id);
  ?>
  <div class="d-flex justify-content-between align-items-center mt-3">
    <!-- <h4 class="category-heading text-dark">श्रेणी अनुसार पोस्ट</h4> -->
    <a href="<?php echo esc_url($category_link); ?>" class="btn btn-outline-primary btn-sm more-link">
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
            <div class="col-md-4 mb-3">
              <div class="card h-100">
                <?php if (has_post_thumbnail()) : ?>
                  <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="">
                <?php endif; ?>
                <div class="card-body">
                  <h5 class="card-title"><?php the_title(); ?></h5>
                  <!-- <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Read More</a> -->
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

      // Set active tab
      document.querySelectorAll('#categoryTabs .nav-link').forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');

      // Update "थप हेर्नुहोस्" link
      const moreLink = document.querySelector('.more-link');
      if (moreLink) {
        moreLink.setAttribute('href', catLink);
      }

      // AJAX call to load posts
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

/* Category Tabs */
#categoryTabs .nav-link {
  font-size: 1.5em;
  font-weight: 500;
  color: #333;
  border: none;
  background-color: #f8f9fa;
  margin-right: 5px;
  border-radius: 0.25rem;
  transition: background-color 0.3s ease, color 0.3s ease;
}

#categoryTabs .nav-link:hover {
  background-color: #e2e6ea;
  color: #0d6efd;
}

#categoryTabs .nav-link.active {
  background-color: #0d6efd;
  color: #fff;
}

/* Post Titles */
.card-title {
  font-size: 1.5em;
  font-weight: 600;
  color: #222;
  margin-bottom: 10px;
}

/* Post Excerpt or Body (if added) */
.card-body p {
  font-size: 1.2em;
  color: #555;
}

/* More Button Styling */
.more-link {
  font-size: 14px;
  color: #0d6efd;
  border-color: #0d6efd;
  transition: all 0.3s ease;
}

.more-link:hover {
  background-color: #0d6efd;
  color: #fff;
}

</style>