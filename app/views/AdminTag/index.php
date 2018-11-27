<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <h1>Spisak svih tagova</h1>
        <div class="page-content">
            <table class='table table-hover table-condensed'>
                <thead>
                    <tr>
                        <td colspan='4' class='align-right'>
                            <?php Misc::url('admin/tags/add/', 'Add new tag'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Image class</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($DATA['tags'] as $tag): ?>
                    <tr>
                        <td><?php echo $tag->tag_id; ?></td>
                        <td><?php echo htmlspecialchars($tag->name); ?></td>
                        <td><?php echo htmlspecialchars($tag->image_class); ?></td>
                        <td><?php Misc::url('admin/tags/edit/' . $tag->tag_id, 'Edit'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>