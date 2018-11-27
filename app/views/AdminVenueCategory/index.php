<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <h1>Spisak svih kategorija</h1>
        <div class="page-content">
            <table class='table table-hover table-condensed'>
                <thead>
                    <tr>
                        <td colspan='4' class='align-right'>
                            <?php Misc::url('admin/categories/add/', 'Add new category'); ?>
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
                    <?php foreach($DATA['categories'] as $category): ?>
                    <tr>
                        <td><?php echo $category->venue_category_id; ?></td>
                        <td><?php echo htmlspecialchars($category->name); ?></td>
                        <td><?php echo htmlspecialchars($category->slug); ?></td>
                        <td><?php Misc::url('admin/categories/edit/' . $category ->venue_category_id, 'Edit'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>