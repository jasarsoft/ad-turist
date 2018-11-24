<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <h1>Spisak svih lokacija</h1>
        <div class="page-content">
            <table class='table table-hover table-condensed'>
                <thead>
                    <tr>
                        <td colspan='4' class='align-right'>
                            <?php Misc::url('admin/locations/add/', 'Add new location'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($DATA['location'] as $location): ?>
                    <tr>
                        <td><?php echo $location->location_id; ?></td>
                        <td><?php echo htmlspecialchars($location->name); ?></td>
                        <td><?php echo htmlspecialchars($location->slug); ?></td>
                        <td><?php Misc::url('admin/locations/edit/' . $location->location_id, 'Edit'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>