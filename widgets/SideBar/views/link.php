<?php

use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\service\MenuService;

/**
 * @var Menu $link
 * @var bool $isActive
 * @var string $activeClass
 */
?>

<li id="nav-<?php echo md5($link->id); ?>" class="nav-item">
    <a class="nav-link <?php echo $isActive ? $activeClass : 'collapsed'; ?>" href="<?php echo MenuService::link($link); ?>">
        <i class="<?php echo $link->icon; ?>"></i>
        <span><?php echo $link->translatedTitle; ?></span>
    </a>
</li>