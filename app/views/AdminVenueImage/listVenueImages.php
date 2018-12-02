<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <h1>Spisak svih slika</h1>
        <div class="page-content">
            <table class='table table-hover table-condensed'>
                <thead>
                    <tr>
                        <td colspan='4' class='align-right'>
                            <?php Misc::url('admin/images/venue/' . $DATA['venue_id'] . '/add' , 'Add new image to this venue'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($DATA['images'] as $image): ?>
                    <tr>
                        <td><?php echo $image->image_id; ?></td>
                        <td>
                            <img src='<?php echo Configuration::BASE_URL . htmlspecialchars($image->path); ?>' class='small-image-new' >
                        </td>
                        <td><?php Misc::url('admin/images/venue/' . $DATA['venue_id'] . '/edit/' . $image ->image_id, 'Delete'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>