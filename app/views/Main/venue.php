<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    <header>
        <h1><?php echo htmlspecialchars($DATA['venue']->title); ?></h1>
    </header>
    
    <div class='row'>
        <div class='col-sm-12 col-md-3'>
            <nav>
                <ul>
                    <?php foreach ($DATA['categories'] as $category): ?>
                    <li>
                        <?php Misc::url('category/' . $category->slug, $category->name); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
        <div class='col-sm-12 col-md-9'>
            <div class='details'>
                <?php echo $DATA['venue']->long_text; ?>
            </div>
            
            <div class='image'>
                <?php foreach ($DATA['venue']->images as $image): ?>
                <img src="<?php echo Configuration::BASE_URL . $image->path; ?>" alt="<?php echo htmlspecialchars($DATA['venue']->title) . ' - ' . $image->image_id; ?>" class='gallery-image' >
                <?php endforeach; ?>
            </div>
            
            <div class='tags'>
                <?php foreach($DATA['venue']->tags as $tag): ?>
                <i class='<?php echo htmlspecialchars($tag->image_class); ?>' title='<?php echo htmlspecialchars($tag->name); ?>' ></i>
                <?php endforeach; ?>
            </div>
            
            <div class='info'>
                <i class='glyphicon glyphicon-map-marker'></i> <?php echo htmlspecialchars($DATA['venue']->location->name); ?><br>
                <i class='glyphicon glyphicon-list-alt'></i> <?php echo htmlspecialchars($DATA['venue']->venue_category->name); ?>
            </div>
        </div>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>