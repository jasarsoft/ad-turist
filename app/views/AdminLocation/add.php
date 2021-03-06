<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <header>
            <h1>Dodavanje nove lokacije</h1>
        </header>
        
        <form method='post'>
            <label for='name'>Ime lokacije:</label>
            <input type='text' name='name' id='name' required><br>
            
            <label for='slug'>Slug lokacije:</label>
            <input type='text' name='slug' id='slug' required pattern='[a-z0-9\-]+'><br>
            
            <button type='submit'>Dodaj lokaciju</button>
        </form>
        
        <?php if (isset($DATA['message'])): ?>
        <p><?php echo htmlspecialchars($DATA['message']); ?></p>
        <?php endif; ?>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>