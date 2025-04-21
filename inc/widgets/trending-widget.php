
<?php
// Trending Posts This Week Widget
class Trending_Posts_This_Week_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'trending_posts_this_week',
            __('Trending', 'textdomain'),
            array('description' => __('Trending posts this week in list view', 'textdomain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        $title = apply_filters('widget_title', 'Trending');
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Query trending posts based on comment count from last 7 days
        $week_ago = date('Y-m-d H:i:s', strtotime('-7 days'));

        $trending_posts = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'orderby'        => 'comment_count',
            'order'          => 'DESC',
            'date_query'     => array(
                array(
                    'after' => $week_ago,
                ),
            ),
        ));

        if ($trending_posts->have_posts()) {
            echo '<div class="trending-widget">';
            $count = 1;
            while ($trending_posts->have_posts()) {
                $trending_posts->the_post();
                echo '<div class="trending-item">';
                echo '<div class="trending-rank"><strong>' . $count . '.</strong> <a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
                echo '<hr>';
                echo '</div>';
                $count++;
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>No trending posts found.</p>';
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        echo '<p>This widget displays the most commented posts from the past 7 days.</p>';
    }

    public function update($new_instance, $old_instance) {
        return $old_instance;
    }
}

// Register the widget
function register_trending_posts_this_week_widget() {
    register_widget('Trending_Posts_This_Week_Widget');
}
add_action('widgets_init', 'register_trending_posts_this_week_widget');
?>
<style>
.trending-widget {
    font-family: Arial, sans-serif;
}

.trending-item {
    padding: 5px 0;
}

.trending-rank a {
    text-decoration: none;
    color: #222;
}

.trending-rank a:hover {
    color: #0073aa;
}
</style>
