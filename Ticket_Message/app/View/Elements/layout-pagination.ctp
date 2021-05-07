<?php
    $prev = array('tag' => false, 'escape' => false, 'class' => array('prev'));
    $next = array('tag' => false, 'escape' => false, 'class' => array('next'));
?>

<div class="pagination">
    <div class="counter">
        <?php echo $this->Paginator->counter('{:start}-{:end} de {:count}'); ?>
    </div>

    <?php echo $this->Paginator->prev('<div class="icon"></div>', $prev); ?>
    <?php echo $this->Paginator->next('<div class="icon"></div>', $next); ?>
</div>