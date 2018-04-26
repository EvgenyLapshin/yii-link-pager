<?php
/**
 * @var $this LinkPager
 * @var $page integer, number page
 * @var $url string, link
 */
?>

<?php if ($page == 0) { ?>
    <li class="page-item disabled"><a class="page-link" href="#">←</a></li>
<?php } else { ?>
    <li class="page-item"><a class="page-link js--ajaxBtn" data-for="<?= $this->owner->getId() ?>" href="<?= $url ?>">←</a></li>
<?php } ?>