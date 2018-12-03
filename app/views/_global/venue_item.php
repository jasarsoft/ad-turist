<div class='venue-item'>
    <img src='<?php echo Configuration::BASE_URL . $venue->images[0]->path; ?>' alt='<?php echo htmlspecialchars($venue->title); ?>' class='venue-image'>
    <h2><?php htmlspecialchars($venue->title); ?></h2>
    <div class='venue-short-text'>
        <?php echo htmlspecialchars($venue->short_text); ?>
    </div>
    <div>
        <?php foreach($venue->tags as $tag): ?>
        <i class='<?php echo htmlspecialchars($tag->image_class); ?>' title='<?php echo htmlspecialchars($tag->name); ?>' ></i>
        <?php endforeach; ?>
    </div>
</div>