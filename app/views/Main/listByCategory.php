<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
     <header>
         <h1>Smjestajni kapaciteti u kategoriji &quot;<?php echo htmlspecialchars($DATA['category']->name); ?> &quot;</h1>
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
            <?php foreach ($DATA['venues'] as $venue): ?>
            <?php require 'app/views/_global/venue_item.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>
