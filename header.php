<?php
/**
 * The header for the theme
 *
 * @package Bihani
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Nepali news, breaking news, live updates, political news, business, sports, health, entertainment, and more. Stay updated with the latest headlines from Nepal.">
    <meta name="keywords" content="Nepali news, Today’s news Nepal, Breaking news Nepal, Nepal headlines, Nepali samachar, Politics, Government updates, Business news, NEPSE updates, Crime news, Health updates, Education, Sports, Entertainment, Weather, World news">
    <meta name="author" content="Roshan Kumar Thapa">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'name' ); ?>" />
    <meta property="og:description" content="Nepali news, breaking news, live updates, political news, business, sports, health, entertainment, and more. Stay updated with the latest headlines from Nepal." />
    <meta property="og:image" content="<?php echo esc_url( get_template_directory_uri() . '/assets/img/og-image.jpg' ); ?>" />
    <meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>" />
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
    <meta property="og:type" content="website" />
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:creator" content="@yourtwitterhandle">
    <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'name' ); ?>" />
    <meta name="twitter:description" content="Nepali news, breaking news, live updates, political news, business, sports, health, entertainment, and more. Stay updated with the latest headlines from Nepal." />
    <meta name="twitter:image" content="<?php echo esc_url( get_template_directory_uri() . '/assets/img/og-image.jpg' ); ?>" />

    <!-- Favicon -->
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/favicon.ico' ); ?>" type="image/x-icon">

    <!-- Canonical Tag -->
    <link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>" />

    <!-- RSS Feed Link -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php echo esc_url( get_feed_link() ); ?>" />

    <!-- Preload Key Resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" as="style" />
    <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/assets/css/style.css' ); ?>" as="style" />

    <!-- Ensure Font Awesome is Loaded -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Structured Data (JSON-LD) for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "headline": "<?php the_title(); ?>",
      "datePublished": "<?php the_date( 'Y-m-d' ); ?>",
      "dateModified": "<?php the_modified_date( 'Y-m-d' ); ?>",
      "author": {
        "@type": "Person",
        "name": "Roshan Kumar Thapa"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Bihani News",
        "logo": {
          "@type": "ImageObject",
          "url": "<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>"
        }
      },
      "image": "<?php echo esc_url( get_the_post_thumbnail_url() ); ?>"
    }
    </script>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="container-fluid bg-primary text-white py-2">
        <div class="row">
            <div class="col-md-6">
            <?php
             // Check if the Nepali Date Converter plugin is active and the shortcode exists
                if (is_plugin_active('nepali-date-converter/ndc.php') && shortcode_exists('ndc-today-date')) {
                // If active and the shortcode exists, echo the Nepali date using the shortcode
                echo do_shortcode('[ndc-today-date disable_today_eng_date="1" title=""]');
                } else {
                // If not active or shortcode does not exist, fall back to the default WordPress date
                echo date('l, F j, Y');
                }
            ?>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?php echo get_theme_mod('facebook_link', '#'); ?>" class="text-white me-2">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="<?php echo get_theme_mod('twitter_link', '#'); ?>" class="text-white me-2">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="<?php echo get_theme_mod('instagram_link', '#'); ?>" class="text-white me-2">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="<?php echo get_theme_mod('linkedin_link', '#'); ?>" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
                ?>
            </div>
            <div class="col-md-6 text-end">
                <?php if (get_theme_mod('header_ad_image')) : ?>
                    <img src="<?php echo esc_url(get_theme_mod('header_ad_image')); ?>" alt="Header Ad" class="img-fluid">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container">
            <!-- Site Brand/Logo -->
            <a class="navbar-brand text-white" href="<?php echo home_url(); ?>">
                <?php bloginfo('name'); ?>
                 <!-- <?php echo('बिहानी आवाज '); ?> -->
            </a>

            <!-- Mobile Nav Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Main Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left side - Menu items -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 custom-menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => true,
                        'items_wrap' => '%3$s', // Output only <li> elements
                        // 'menu_class' => 'custom-menu-class',
                        'depth' => 2, // Allow sub-menu items
                        'walker' => new Bootstrap_NavWalker()

                    ));
                    ?>
                </ul>

                <!-- Right side - Buttons and Search Icon -->
                <div class="d-flex align-items-center gap-2">
                    <a href="#" class="btn btn-outline-danger d-flex align-items-center gap-1">
                    <i class="fa fa-video-camera" aria-hidden="true"></i><span>Youtube</span>
                    </a>
                    
                    <!-- User Icon Button (Login/Profile) -->
                    <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo esc_url(admin_url('profile.php')); ?>" class="btn btn-outline-light d-flex align-items-center gap-1">
                            <i class="fas fa-user"></i> <span>Profile</span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="btn btn-outline-light d-flex align-items-center gap-1">
                            <i class="fas fa-user"></i> <span>Login</span>
                        </a>
                    <?php endif; ?>
                    
                    <!-- Search Icon Button -->
                    <button class="btn btn-outline-light" type="button" data-bs-toggle="collapse" data-bs-target="#searchForm" aria-expanded="false" aria-controls="searchForm">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Hidden Search Form (Collapsed by default) -->
        <div class="collapse" id="searchForm">
            <div class="container mt-2">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" name="s" value="<?php echo get_search_query(); ?>">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

</header>

