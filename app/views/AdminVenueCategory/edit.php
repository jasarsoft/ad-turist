<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <header>
            <h1>Izmjena kategorije</h1>
        </header>
        
        <form method='post'>
            <label for='name'>Ime kategorije:</label>
            <input type='text' name='name' id='name' required value='<?php echo htmlspecialchars($DATA['category']->name); ?>'><br>
            
            <label for='slug'>Slug kategorije:</label>
            <input type='text' name='slug' id='slug' required pattern='[a-z0-9\-]+' value='<?php echo htmlspecialchars($DATA['category']->slug); ?>'><br>
            
            <button type='submit'>Izmjena kategoriju</button>
        </form>
        
        <?php if (isset($DATA['message'])): ?>
        <p><?php echo htmlspecialchars($DATA['message']); ?></p>
        <?php endif; ?>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>