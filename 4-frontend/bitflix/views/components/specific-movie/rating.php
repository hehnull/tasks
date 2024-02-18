<?php

/**
 * @var int $partRatingPercent
 * @var int $wholeRatingPercent
 */

?>

.graph-rating :nth-child(-n+<?= $wholeRatingPercent ?>) {
background-color: #E78818;
}

.graph-rating :nth-child(<?= $wholeRatingPercent + 1 ?>) {
background: linear-gradient(to right, #E78818 0%, #E78818 <?= $partRatingPercent ?>%, #F2F2F2 <?= $partRatingPercent ?>%, #F2F2F2 100%);
}
