<?php
declare(strict_types = 1);
/**
 * @var $currentPage
 * @var $menuItem
 */
?>

<?php
foreach ($menuItem as $key => $value): ?>
	<a class="menu-button <?= ($currentPage === $key) ? 'menu-button-active' : ''; ?>"
	   href="/<?= $key; ?>"><?= ($value); ?></a>
<?php
endforeach; ?>