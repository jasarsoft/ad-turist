<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <header>
            <h1>Dodavanje nove slike</h1>
        </header>
        
        <form method='post' enctype='multipart/form-data'>
            <label for='image'>Izaberite sliku:</label>
            <input type='file' name='image' id='image' required><br>
            
            <button type='submit'>Dodaj sliku</button>
        </form>
        
        <?php if (isset($DATA['message'])): ?>
        <p><?php echo htmlspecialchars($DATA['message']); ?></p>
        <?php endif; ?>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>