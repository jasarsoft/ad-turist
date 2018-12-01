<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <h1>Spisak svih smjestajnih kapaciteta prostora</h1>
        <div class="page-content">
            <table class='table table-hover table-condensed'>
                <thead>
                    <tr>
                        <td colspan='4' class='align-right'>
                            <?php Misc::url('admin/venues/add/', 'Add new venue'); ?>
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
                    <?php foreach($DATA['venues'] as $venue): ?>
                    <tr>
                        <td><?php echo $venue->venue_id; ?></td>
                        <td><?php echo htmlspecialchars($venue->title); ?></td>
                        <td><?php echo htmlspecialchars($venue->slug); ?></td>
                        <td><?php Misc::url('admin/locations/edit/' . $venue->venue_id, 'Edit'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>