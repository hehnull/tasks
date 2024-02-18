<?php
/** @var array $selectedMovies */
?>

<div class="content">

	<?php
	if (empty($selectedMovies))
	{
		echo '<div class="not-found"> Ничего не найдено!</div>';
	}
	else
	{
		foreach ($selectedMovies as $movie)
		{
			echo view('components/main-page/card-output', ['movie' => $movie]);
		}
	}
	?>
</div>

