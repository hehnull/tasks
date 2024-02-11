<?php
/** @var string $selectedMovies */
?>

<div class="content">

	<?php
	if (empty($selectedMovies))
	{
		echo '<div class="not-found"> Ничего не найдено!</div>';
	}
	foreach ($selectedMovies as $movie)
	{
		echo view('components/main-page/card-output', ['movie' => $movie]);
	}
	?>
</div>

