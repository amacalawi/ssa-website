

<div class="mailman">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="icon">
                <h2><i class="fa fa-user"></i></h2>
            </div>
            <div class="content">
                <h2><?php echo @$mailman_options['sender']; ?></h2>
            </div>
        </div>
        <div class="panel-heading">
            <div class="icon">
                <h2><i class="fa fa-envelope"></i></h2>
            </div>
            <div class="content">
                <p><a href="mailto:<?php echo @$mailman_options['sender_email']; ?>"><?php echo @$mailman_options['sender_email']; ?></a></p>
            </div>
        </div>
        <div class="panel-body">
            <div class="icon">
                <h2><i class="fa fa-comments"></i></h2>
            </div>
            <div class="content"><?php
                $content = get_post_meta($post->ID, $editor_id, true);
                echo wpautop($content); ?>
            </div>
        </div>
    </div>
</div>
