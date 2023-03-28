<div class="modal modal-transparent fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php if (!empty($title)): ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo $title; ?></h4>
                </div>
            <?php endif; ?>

            <?php //( ! empty($content)) && print($content); ?>

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
<style type="text/css">
    /* .modal-transparent */

    .modal-transparent {
        background: transparent;
    }
    .modal-transparent .modal-content {
        background: transparent;
    }
    .modal-backdrop.modal-backdrop-transparent {
        background: #ffffff;
    }
    .modal-backdrop.modal-backdrop-transparent.in {
        opacity: .9;
        filter: alpha(opacity=90);
    }

    @media (min-width: 768px) {
        .modal-fullscreen .modal-dialog {
            width: 750px;
        }
    }
    @media (min-width: 992px) {
        .modal-fullscreen .modal-dialog {
            width: 970px;
        }
    }
    @media (min-width: 1200px) {
        .modal-fullscreen .modal-dialog {
            width: 1170px;
        }
    }
</style>
<script type="text/javascript">
    $(".modal-transparent").on('show.bs.modal', function () {
        setTimeout(function () {
            $(".modal-backdrop").addClass("modal-backdrop-transparent");
        }, 0);
    });
    $(".modal-transparent").on('hidden.bs.modal', function () {
        $(".modal-backdrop").addClass("modal-backdrop-transparent");
    });
</script>