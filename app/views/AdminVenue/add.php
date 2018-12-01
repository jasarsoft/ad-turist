<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <header>
            <h1>Dodavanje novog smjestajnog kapaciteta</h1>
        </header>
        
        <form method='post'>
            <label for='title'>Ime:</label>
            <input type='text' name='title' id='title' required><br>
            
            <label for='slug'>Slug:</label>
            <input type='text' name='slug' id='slug' required pattern='[a-z0-9\-]+'><br>
            
            <label for='short_text'>Kratki tekst:</label>
            <input type='text' name='short_text' id='short_text' required><br>
            
            <label for='long_text'>Detaljan opis:</label>
            <textarea name='long_text' id='long_text' required></textarea><br>
            
            <label for='price'>Cijena:</label>
            <input type='number' name='price' id='price' required min='0.01' step='any'><br>
            
            <label for='location_id'>Lokacija:</label>
            <select name='location_id' id='location_id'>
                <?php foreach ($DATA['locations'] as $item): ?>
                <option value='<?php echo $item->location_id; ?>'><?php echo htmlspecialchars($item->name); ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for='venue_category_id'>Kategorija</label>
            <select name='venue_category_id' id='venue_category_id'>
                <?php foreach ($DATA['categories'] as $item): ?>
                <option value='<?php echo $item->venue_category_id; ?>'><?php echo htmlspecialchars($item->name); ?></option>
                <?php endforeach; ?>
            </select>
            
            <label>Specijalni dodaci/tagovi</label><br>
            <?php foreach ($DATA['tags'] as $tag): ?>
            <input type='checkbox' name='tag_ids[]' value='<?php echo $tag->tag_id; ?>' > <?php echo htmlspecialchars($tag->name); ?><br>
            <?php endforeach; ?><br>
            
            <button type='submit'>Dodaj</button>
        </form>
        
        <?php if ($DATA['message']): ?>
        <p><?php echo htmlspecialchars($DATA['message']); ?></p>
        <?php endif; ?>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>