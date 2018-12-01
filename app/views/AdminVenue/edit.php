<?php include 'app/views/_global/beforeContent.php'; ?>

<article class="row">
    <div class="col-xs-12">
        <header>
            <h1>Izmjena lokacije</h1>
        </header>
        
        <form method='post'>
            <label for='name'>Ime:</label>
            <input type='text' name='name' id='name' required value='<?php echo htmlspecialchars($DATA['venue']->name); ?>'><br>
            
            <label for='slug'>Slug:</label>
            <input type='text' name='slug' id='slug' required pattern='[a-z0-9\-]+' value='<?php echo htmlspecialchars($DATA['venue']->slug); ?>'><br>
            
            <label for='short_text'>Kratki tekst:</label>
            <input type='text' name='short_text' id='short_text' required value='<?php echo htmlspecialchars($DATA['venue']->short_text); ?>'><br>
            
            <label for='long_text'>Detaljan opis:</label>
            <textarea name='long_text' id='long_text' required><?php echo htmlspecialchars($DATA['venue']->long_text); ?></textarea><br>
            
            <label for='price'>Cijena:</label>
            <input type='number' name='price' id='price' required min='0.01' step='any' value='<?php echo htmlspecialchars($DATA['venue']->price); ?>'><br>
            
            <label for='location_id'>Lokacija:</label>
            <select name='location_id' id='location_id'>
                <?php foreach ($DATA['locations'] as $item): ?>
                <option value='<?php echo $item->location_id; ?>' <?php if ($DATA['venue']->location_id == $item->location_id) echo 'selected' ?> >
                    <?php echo htmlspecialchars($item->name); ?>
                </option>
                <?php endforeach; ?>
            </select>
            
            <label for='venue_category_id'>Kategorija</label>
            <select name='venue_category_id' id='venue_category_id'>
                <?php foreach ($DATA['categories'] as $item): ?>
                <option value='<?php echo $item->venue_category_id; ?>' <?php if ($DATA['venue']->venue_category_id == $item->venue_category_id) echo 'selected' ?> >
                    <?php echo htmlspecialchars($item->name); ?>
                </option>
                <?php endforeach; ?>
            </select>
            
            <button type='submit'>Izmjeni</button>
        </form>
        
        <?php if (isset($DATA['message'])): ?>
        <p><?php echo htmlspecialchars($DATA['message']); ?></p>
        <?php endif; ?>
    </div>
</article>

<?php include 'app/views/_global/afterContent.php'; ?>