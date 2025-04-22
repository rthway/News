<div class="container-fluid py-4">
    <div class="row">
        <!-- Video Player Area -->
        <div class="col-lg-8 mb-4" id="video-player-area">
            <?php
            $main_video_query = new WP_Query(array(
                'category_name' => 'video',
                'posts_per_page' => 1,
            ));

            if ($main_video_query->have_posts()) :
                $main_video_query->the_post();
                $main_video_id = get_the_ID();
                $video_url = get_post_meta(get_the_ID(), 'video_url', true);
            ?>
                <div class="ratio ratio-16x9" id="main-video">
                    <?= $video_url ? wp_oembed_get($video_url) : the_content(); ?>
                </div>
                <h5 class="mt-3"><?php the_title(); ?></h5>
                <p><?php the_excerpt(); ?></p>
            <?php endif; wp_reset_postdata(); ?>
        </div>

        <!-- Playlist -->
        <div class="col-lg-4" style="max-height: 600px; overflow-y: auto;">
            <?php
            $playlist_query = new WP_Query(array(
                'category_name' => 'video',
                'posts_per_page' => 10,
                'post__not_in' => array($main_video_id ?? 0),
            ));

            if ($playlist_query->have_posts()) :
                while ($playlist_query->have_posts()) : $playlist_query->the_post();
                    $video_url = get_post_meta(get_the_ID(), 'video_url', true); ?>
                    <div class="d-flex mb-3 playlist-item" data-title="<?php echo esc_attr(get_the_title()); ?>"
                         data-url="<?php echo esc_url($video_url); ?>" style="cursor: pointer;">
                        <div class="me-2">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('thumbnail', ['class' => 'rounded']);
                            } else { ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/default.png" width="120" height="90" class="rounded" />
                            <?php } ?>
                        </div>
                        <div>
                            <strong class="d-block"><?php the_title(); ?></strong>
                            <small class="text-muted"><?php echo get_the_date(); ?></small>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p>No videos found in playlist.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.playlist-item').forEach(item => {
        item.addEventListener('click', function () {
            const videoUrl = this.dataset.url;
            const title = this.dataset.title;

            if (videoUrl) {
                const playerArea = document.getElementById('video-player-area');
                const embedHtml = `<div class="ratio ratio-16x9">${getEmbedCode(videoUrl)}</div><h5 class="mt-3">${title}</h5>`;
                playerArea.innerHTML = embedHtml;
            }
        });
    });

    function getEmbedCode(url) {
        const embed = wp_embed_code(url);
        return embed || `<p>Unable to load video.</p>`;
    }

    function wp_embed_code(url) {
        // Naive YouTube embed fallback
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            const videoId = url.split('v=')[1] || url.split('/').pop();
            return `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
        }
        return '';
    }
});
</script>
<style>
.playlist-item:hover {
    background-color: #f0f0f0;
    border-radius: 5px;
}
</style>