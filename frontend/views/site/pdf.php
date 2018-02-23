<?php
setlocale(LC_TIME, 'es_CO.UTF-8');
$date = strftime("%c", strtotime($article->created_at));
?>

<h1><?= $article->title ?></h1>

<p class='data-author'>
	Publicado por: <strong><?= $article->createdBy->name ?></strong> el día <strong><?= $date ?></strong>
</p>

<?= $article->detail ?>

<?php if ($article->video and $article->download): ?>
	<div class='alert-warning'>
		Este artículo contiene material y un video que puede ver y descargar desde
		<a href="<?php echo "http://www.blonder413.com/articulo/$article->slug" ?>">
			<?php echo "http://www.blonder413.com/articulo/$article->slug" ?>
		</a>
	</div>


<?php elseif ($article->video): ?>
	<div class='alert-warning'>
		Este artículo contiene un video que puede ver desde
		<a href="<?php echo "http://www.blonder413.com/articulo/$article->slug" ?>">
			<?php echo "http://www.blonder413.com/articulo/$article->slug" ?>
		</a>
	</div>


<?php elseif ($article->download): ?>
	<div class='alert-warning'>
		Este artículo contiene material que puede descargarse desde
		<a href="<?php echo "http://www.blonder413.com/articulo/$article->slug" ?>">
			<?php echo "http://www.blonder413.com/articulo/$article->slug" ?>
		</a>
	</div>
<?php endif; ?>
