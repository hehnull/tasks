<?php
/** @var array $movie */
?>

<div class="card">
	<div class="card-overlay">
		<a href="/movie?id=<?= $movie['ID']; ?>" class="overlay-button">
			ПОДРОБНЕЕ
		</a>
	</div>
	<div class="card-img"
		 style="background-image: url('data/content/images/<?= $movie['ID']; ?>.jpg'); background-size: cover;">
	</div>
	<div class="card-info">
		<p class="title"><?= $movie['TITLE']; ?></p>
		<p class="original-title"><?= $movie['ORIGINAL_TITLE']; ?></p>
		<div class="card-line"></div>
		<p class="description"><?= truncate($movie['DESCRIPTION']); ?></p>
		<div class="duration-genre">
			<img src="data/site/clock.svg" alt="" class="clock">
			<p class="duration"><?= outputDuration($movie['DURATION']); ?></p>
			<p class="genre">
				<?
				foreach ($movie['GENRES'] as $genre): ?>
					<?= $genre; ?>
				<?php
				endforeach; ?>
			</p>
		</div>
	</div>
</div>
