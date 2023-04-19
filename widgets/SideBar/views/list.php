<?php

use uzdevid\dashboard\models\Menu;
use uzdevid\dashboard\models\service\MenuService;

/**
 * @var Menu $list
 * @var bool $isActive
 * @var int $level
 */
?>

<li id="nav-<?php echo md5($list->id); ?>" class="nav-item">
    <a class="nav-link <?php echo $isActive ? '' : 'collapsed'; ?>" data-bs-target="#list-<?php echo md5($list->id); ?>" data-bs-toggle="collapse" href="<?php echo MenuService::link($list); ?>">
        <i class="<?php echo $list->icon; ?>"></i>
        <span><?php echo $list->translatedTitle; ?></span>
        <i class="bi bi-chevron-down ms-auto"></i>
    </a>

    <ul id="list-<?php echo md5($list->id); ?>" class="<?php echo ($level > 1) ? 'ps-2' : ''; ?> nav-content <?php echo $isActive ? 'show' : 'collapse'; ?>" data-bs-parent="#nav-<?php echo md5($list->id); ?>">
        <?php foreach ($list->menus as $child): ?>
            <?php if (empty($child->menus)): ?>
                <?php echo $this->createLink($child, 'active'); ?>
            <?php else: ?>
                <?php echo $this->createList($child, $level + 1); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</li>