<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <header>
            <h1>Dodavanje novog taga</h1>
        </header>
        
        <form method='post'>
            <label for='name'>Ime taga:</label>
            <input type='text' name='name' id='name' required><br>
            
            <label for='image_class'>Image klase taga:</label>
            <input type='text' name='image_class' id='image_class' required pattern='[a-z0-9\- ]+'><br>
            
            <button type='submit'>Dodaj tag</button>
        </form>
        
        <?php if (isset($DATA['message'])): ?>
        <p><?php echo htmlspecialchars($DATA['message']); ?></p>
        <?php endif; ?>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>