<h2><?= esc($news['title']) ?></h2>

<p><?= esc($news['body']) ?></p>

<p><a href="/news/edit/<?= esc($news['slug'], 'url') ?>">Edit a news item</a></p>

<form action="/news/delete" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($news['id']) ?>">
    <input type="submit" name="submit" value="Delete a news item">
</form>

<p><a href="/news">Back to list</a></p>