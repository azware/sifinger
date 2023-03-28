<div class="modal modal-fullscreen fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" style="display: none;">
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
    /* .modal-fullscreen */

    .modal-fullscreen {
        background: transparent;
    }
    .modal-fullscreen .modal-content {
        background: transparent;
        border: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    .modal-backdrop.modal-backdrop-fullscreen {
        background: #ffffff;
    }
    .modal-backdrop.modal-backdrop-fullscreen.in {
        opacity: .97;
        filter: alpha(opacity=97);
    }

    /* .modal-fullscreen size: we use Bootstrap media query breakpoints */

    .modal-fullscreen .modal-dialog {
        margin: 0;
        margin-right: auto;
        margin-left: auto;
        width: 100%;
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
    @media (min-width: 1280px) {
        .modal-fullscreen .modal-dialog {
            width: 1200px;
        }
    }
</style>
<script type="text/javascript">
    $(".modal-fullscreen").on('show.bs.modal', function () {
        setTimeout(function () {
            $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
        }, 0);
    });
    $(".modal-fullscreen").on('hidden.bs.modal', function () {
        $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
    });
</script>











