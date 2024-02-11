<?php
/** @var array $movie */
?>

<div class="card">
	<div class="card-overlay">
		<a href="/movie?id=<?= $movie['id']; ?>" class="overlay-button">
			ПОДРОБНЕЕ
		</a>
	</div>
	<div class="card-img"
		 style="background-image: url('data/content/images/<?= $movie['id']; ?>.jpg'); background-size: cover;">
	</div>
	<div class="card-info">
		<p class="title"><?= $movie['title']; ?></p>
		<p class="original-title"><?= $movie['original-title']; ?></p>
		<div class="card-line"></div>
		<p class="description"><?= truncate($movie['description']); ?></p>
		<div class="duration-genre">
			<img src="data/site/clock.svg" alt="" class="clock">
			<p class="duration"><?= outputDuration($movie['duration']); ?></p>
			<p class="genre">
				<?
				foreach ($movie['genres'] as $genre): ?>
					<?= $genre; ?>
				<?php
				endforeach; ?>
			</p>
		</div>
	</div>
</div>
