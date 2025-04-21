<?php
function bihani_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('menus');

    register_nav_menus([
        'primary' => __('Primary Menu', 'bihani'),
        'footer'  => __('Footer Menu', 'bihani'),
    ]);
}
add_action('after_setup_theme', 'bihani_theme_setup');

function bihani_enqueue_scripts() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('bihani-style', get_stylesheet_uri());
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], null, true);
    wp_enqueue_style( 'mukta-font', 'https://fonts.googleapis.com/css2?family=Mukta:wght@400;500;600;700&display=swap', false );

}
add_action('wp_enqueue_scripts', 'bihani_enqueue_scripts');





// ==========================
// Count Post Views
// ==========================
function bihani_set_post_views($postID) {
    $count_key = 'bihani_post_views';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function bihani_get_post_views($postID) {
    $count_key = 'bihani_post_views';
    $count = get_post_meta($postID, $count_key, true);
    return $count ? $count . ' views' : '0 views';
}

remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// ==========================
// Add View Count to Admin Column
// ==========================
function bihani_add_views_column($columns) {
    $columns['post_views'] = 'Views';
    return $columns;
}
add_filter('manage_posts_columns', 'bihani_add_views_column');

function bihani_display_views_column($column_name, $post_id) {
    if ($column_name === 'post_views') {
        $views = get_post_meta($post_id, 'bihani_post_views', true);
        echo $views ? $views : '0';
    }
}
add_action('manage_posts_custom_column', 'bihani_display_views_column', 10, 2);

// Sortable Views Column
function bihani_sortable_views_column($columns) {
    $columns['post_views'] = 'post_views';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'bihani_sortable_views_column');

function bihani_sort_views_column_query($query) {
    if (!is_admin()) return;

    if ($query->get('orderby') === 'post_views') {
        $query->set('meta_key', 'bihani_post_views');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'bihani_sort_views_column_query');

// ==========================
// Custom "Featured" Checkbox Field
// ==========================
function bihani_add_featured_meta_box() {
    add_meta_box(
        'bihani_featured_post',
        'Featured Post',
        'bihani_featured_meta_box_callback',
        'post',
        'side'
    );
}
add_action('add_meta_boxes', 'bihani_add_featured_meta_box');

function bihani_featured_meta_box_callback($post) {
    wp_nonce_field('bihani_save_featured_post', 'bihani_featured_post_nonce');
    $value = get_post_meta($post->ID, '_bihani_featured_post', true);
    ?>
    <label>
        <input type="checkbox" name="bihani_featured_post" <?php checked($value, 'yes'); ?> />
        Mark as Featured
    </label>
    <?php
}

function bihani_save_featured_post($post_id) {
    if (!isset($_POST['bihani_featured_post_nonce']) || !wp_verify_nonce($_POST['bihani_featured_post_nonce'], 'bihani_save_featured_post')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $is_featured = isset($_POST['bihani_featured_post']) ? 'yes' : 'no';
    update_post_meta($post_id, '_bihani_featured_post', $is_featured);
}
add_action('save_post', 'bihani_save_featured_post');

// ==========================
// Add Featured Column to Admin
// ==========================
function bihani_add_featured_column_custom($columns) {
    $columns['bihani_featured'] = __('Featured');
    return $columns;
}
add_filter('manage_posts_columns', 'bihani_add_featured_column_custom');

function bihani_display_featured_column_custom($column_name, $post_id) {
    if ($column_name === 'bihani_featured') {
        $value = get_post_meta($post_id, '_bihani_featured_post', true);
        echo $value === 'yes' ? 'Yes' : 'No';
    }
}
add_action('manage_posts_custom_column', 'bihani_display_featured_column_custom', 10, 2);

// Sortable Featured Column
function bihani_sortable_featured_column($columns) {
    $columns['bihani_featured'] = 'bihani_featured';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'bihani_sortable_featured_column');

function bihani_sort_featured_query($query) {
    if (!is_admin()) return;

    if ($query->get('orderby') === 'bihani_featured') {
        $query->set('meta_key', '_bihani_featured_post');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'bihani_sort_featured_query');

// ==========================
// To justify paragraph text in the WordPress Add Post
// ==========================
function bihani_classic_editor_justify_style() {
    add_editor_style('admin-editor-style.css');
}
add_action('admin_init', 'bihani_classic_editor_justify_style');



// ==========================
// Header Ads and Social Links Customizer
// ==========================

// Customizer Settings for Header Ads and Social Links
function bihani_customize_register($wp_customize) {
    // Header Ad Section
    $wp_customize->add_section('header_ads', array(
        'title'    => __('Header Ads', 'bihani'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('header_ad_image', array(
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_ad_image', array(
        'label'    => __('Header Ad Image (970x70)', 'bihani'),
        'section'  => 'header_ads',
        'settings' => 'header_ad_image',
    )));

    $wp_customize->add_setting('header_ad_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('header_ad_url', array(
        'label'    => __('Header Ad URL', 'bihani'),
        'section'  => 'header_ads',
        'type'     => 'url',
    ));

    // Social Links Section
    $wp_customize->add_section('social_links', array(
        'title'    => __('Social Links', 'bihani'),
        'priority' => 40,
    ));

    $social_networks = array('facebook', 'twitter', 'instagram', 'linkedin');

    foreach ($social_networks as $network) {
        $wp_customize->add_setting("{$network}_link", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("{$network}_link", array(
            'label'   => ucfirst($network) . ' URL',
            'section' => 'social_links',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'bihani_customize_register');





// ==========================
// Change the WordPress login 

// ==========================
// Custom WordPress login page with modern and creative design
function custom_modern_login_style() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
    $background_image = get_template_directory_uri() . '/assets/img/login-bg.jpg';
    ?>
    <style>
        /* Full page background */
        body.login {
            margin: 0;
            padding: 0;
            background: url('<?php echo esc_url($background_image); ?>') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Login card */
        #login {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            animation: fadeInUp 0.8s ease;
        }

        /* Logo */
        #login h1 a {
            background-image: url('<?php echo esc_url($logo_url); ?>');
            background-size: contain;
            background-repeat: no-repeat;
            width: 180px;
            height: 80px;
            margin: 0 auto 30px;
            display: block;
        }

        /* Form styling */
        .login form {
            background: none;
            border: none;
            box-shadow: none;
            padding: 0;
        }

        .login form .input, .login input[type="text"], .login input[type="password"] {
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 12px 15px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .login form .input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.3);
            outline: none;
        }

        .wp-core-ui .button-primary {
            background-color: #1d4ed8;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s ease;
        }

        .wp-core-ui .button-primary:hover {
            background-color: #2563eb;
        }

        /* Links below the form */
        .login #nav, .login #backtoblog {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        .login #nav a, .login #backtoblog a {
            color: #1e40af;
            transition: color 0.3s ease;
        }

        .login #nav a:hover, .login #backtoblog a:hover {
            color: #3b82f6;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'custom_modern_login_style');

// Set logo URL to site home
function custom_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

// Set logo hover title
function custom_login_logo_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'custom_login_logo_title');






// ==========================
// compress uploaded image
// ==========================
function compress_uploaded_image($file) {
    $image_mime = $file['type'];
    $image_path = $file['tmp_name'];
    $image_ext  = pathinfo($file['name'], PATHINFO_EXTENSION);

    $quality = 75; // Set your desired compression quality (0-100)

    switch ($image_mime) {
        case 'image/jpeg':
        case 'image/jpg':
            $image = imagecreatefromjpeg($image_path);
            imagejpeg($image, $image_path, $quality);
            imagedestroy($image);
            break;

        case 'image/png':
            $image = imagecreatefrompng($image_path);
            // Convert to palette-based PNG (smaller)
            imagetruecolortopalette($image, true, 256);
            imagepng($image, $image_path, 9); // 0 (no compression) to 9
            imagedestroy($image);
            break;

        case 'image/webp':
            $image = imagecreatefromwebp($image_path);
            imagewebp($image, $image_path, $quality);
            imagedestroy($image);
            break;

        default:
            // Unsupported type (GIF, SVG, etc.) - do nothing
            break;
    }

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'compress_uploaded_image');

// ==========================
// Register Sidebar
// ==========================
// Register Sidebar Widget Area
function bihani_register_sidebar() {
    register_sidebar( array(
        'name'          => 'Main Sidebar',
        'id'            => 'main_sidebar',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'bihani_register_sidebar' );




// ==========================
// Load all custom widgets from /inc/widgets directory
// ==========================
// Load all custom widgets from /inc/widgets directory
add_action('widgets_init', 'bihani_load_custom_widgets');
function bihani_load_custom_widgets() {
    require_once get_template_directory() . '/inc/widgets/trending-widget.php';
}
add_action('widgets_init', 'bihani_load_custom_widgets');
