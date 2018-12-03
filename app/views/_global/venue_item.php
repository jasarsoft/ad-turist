<div class='venue-item'>
    <a href='<?php echo Configuration::BASE_URL ?>venue/<?php echo $venue->slug; ?>' >
        <img src='<?php echo Configuration::BASE_URL . $venue->images[0]->path; ?>' alt='<?php echo htmlspecialchars($venue->title); ?>' class='venue-image'>
    </a>
    
    <h2>
        <a href='<?php echo Configuration::BASE_URL ?>venue/<?php echo $venue->slug; ?>' >
            <?php htmlspecialchars($venue->title); ?>
        </a>
    </h2>
    <div class='venue-short-text'>
        <?php echo htmlspecialchars($venue->short_text); ?>
    </div>
    <div class='venue-tags'>
        <?php foreach($venue->tags as $tag): ?>
        <i class="<?php echo htmlspecialchars($tag->image_class); ?>" title="<?php echo htmlspecialchars($tag->name); ?>" ></i>
        <?php endforeach; ?>
    </div>
</div>