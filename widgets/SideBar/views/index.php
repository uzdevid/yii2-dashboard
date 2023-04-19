<?php

use uzdevid\dashboard\widgets\SideBar\View;
use uzdevid\dashboard\models\Menu;

/**
 * @var Menu[] $menu
 * @var View $this
 */
?>

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <?php foreach ($menu as $item): ?>
            <?php if (empty($item->menus)): ?>
                <?php echo $this->createLink($item); ?>
            <?php else: ?>
                <?php echo $this->createList($item); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</aside>