<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news/edit" method="post">
    <?= csrf_field() ?>
    <label for="title">Title</label>
    <input type="text" name="title" value="<?= set_value('title', isset($news['title']) ? $news['title'] : '') ?>">
    <br>
    <label for="body">Text</label>
    <textarea type="text" name="body" cols="45" rows="4"><?= set_value('body', isset($news['body']) ? $news['body'] : '') ?></textarea>
    <br>
    <input type="hidden" name="slug" value="<?= set_value('slug', isset($news['slug']) ? $news['slug'] : '') ?>">
    <input type="hidden" name="id" value="<?= set_value('id', isset($news['id']) ? $news['id'] : '') ?>">
    <input type="submit" name="submit" value="Save news item">
</form>

<p><a href="/news">Back to list</a></p>