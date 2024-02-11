<?php
declare(strict_types = 1);
/**
 * @var $genre ;
 * @var $uri
 * @var $mainPageAdress
 * @var $favPageAdress
 * @var $mainPageName
 * @var $favPageName
 */
?>

<a class="menu-button <?= ($uri === $mainPageAdress) ? 'menu-button-active' : ''; ?>"
   href="<?= $mainPageAdress ?>"><?= $mainPageName ?></a>
<?php
foreach (getMovieGernes() as $key => $value): ?>
	<a class="menu-button <?= ($genre === $key) ? 'menu-button-active' : ''; ?>"
	   href="/?genre=<?= $key; ?>"><?= mb_strtoupper($value); ?></a>
<?php
endforeach; ?>

<a class="menu-button <?= ($uri === $favPageAdress || null) ? 'menu-button-active' : ''; ?>"
   href="<?= $favPageAdress ?>"><?= $favPageName ?></a>
<!--<a class="menu-button menu-button-active" href="#">ФАНТАСТИКА</a>-->