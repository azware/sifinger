<div class="modal modal-alert modal-<?php echo $title['alert-class']; ?> fade" id="<?php echo $id; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php if (!empty($title)): ?>
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $title['icon']; ?></h4>
                </div>
            <?php endif; ?>

            <?php (!empty($content)) && print($content); ?>

            <?php if (!empty($body)): ?>
                <div class="modal-body">
                    <?php echo $body; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($buttons)): ?>
                <div class="modal-footer">
                    <?php echo implode('', $buttons); ?>
                </div>
            <?php endif; ?>

            <?php (!empty($footer)) && print($footer); ?>
        </div>
    </div>
</div>