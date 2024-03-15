<?php
/**
 * @var array $selectedMovie
 */
?>

<div class="content-oneMovie">
	<div class="container-oneMovie">
		<div class="upper-oneMovie">
			<div class="firstUpper-oneMovie">
				<div class="header-oneMovie"><?= $selectedMovie['TITLE'] ?></div>
				<a class="likee" href="#">
					<img class="like" src="data/site/icon-with-like.png" alt="Векторный логотип">
				</a>
			</div>
			<div class="secondUpper-oneMovie">
				<div class="caption"><?= $selectedMovie['ORIGINAL_TITLE'] ?></div>
				<div class="rating"><?= $selectedMovie['AGE_RESTRICTION'] ?>+</div>
			</div>
		</div>
		<div class="separator"></div>
		<div class="main-OneMovie">
			<div class="poster-container">
				<div class="poster"
					 style="background-image: url('data/content/images/<?= $selectedMovie['ID'] ?>.jpg')"></div>
			</div>

			<div class="all-about">
				<div class="graph-rating">
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-square"></div>
					<div class="rat-round"><?= $selectedMovie['RATING'] ?></div>
				</div>
				<div class="mini-header">О фильме</div>
				<div class="about-movie">
					<div class="params">
						<div class="param">Год производства:</div>
						<div class="param">Режиссер:</div>
						<div class="param">В главных ролях:</div>
					</div>
					<div class="values">
						<div class="value"><?= $selectedMovie['RELEASE_DATE'] ?></div>
						<div class="value"><?= $selectedMovie['DIRECTOR_ID'] ?></div>
						<div class="value"><?= implode(', ', $selectedMovie['CAST']) ?></div>
					</div>
				</div>
				<div class="mini-header">Описание</div>
				<div class="desc"><?= $selectedMovie['DESCRIPTION'] ?></div>
			</div>
		</div>