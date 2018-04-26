<?php
/**
 * @var $this LinkPager
 * @var $page integer, number page
 * @var $url string, link
 */
?>

<li class="page-item"><a class="page-link js--ajaxBtn" data-for="<?= $this->owner->getId() ?>" href="<?= $url ?>"><?= $page ?></a></li>