<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    <header>
        <h1>Smjestajni kapaciteti</h1>
    </header>   
    
    <form method='post' class='form' action="<?php echo Configuration::BASE_URL; ?>search">
        <div class="row">
            <div class='col-sm-12 col-md-4'>
                <div class='form-group'>
                    <div class='input-group'>
                        <span clas='input-group-addon'>
                            <i class='glyphicon glyphicon-map-marker' ></i> Location
                        </span>
                        <select class='form-control' name='location_id'>
                            <option value='-1'>. . .</option>
                            <?php foreach ($DATA['locations'] as $location): ?>
                            <option value="<?php echo $location->location_id; ?>"><?php echo htmlspecialchars($location->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                 <div class='form-group'>
                    <div class='input-group'>
                        <span clas='input-group-addon'>
                            <i class='glyphicon glyphicon-list-altr' ></i> Category
                        </span>
                        <select class='form-control' name='venue_category_id'>
                            <option value='-1'>. . .</option>
                            <?php foreach ($DATA['categories'] as $category): ?>
                            <option value="<?php echo $category->location_id; ?>"><?php echo htmlspecialchars($category->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
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