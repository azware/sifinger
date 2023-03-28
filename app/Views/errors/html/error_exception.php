<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php if ($_SERVER['CI_ENV'] !== 'production'): ?>
<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;" class="row">

    <h4>An uncaught Exception was encountered</h4>

    <p>Type: <?php echo get_class($exception); ?></p>
    <p>Message: <?php echo $message; ?></p>
    <p>Filename: <?php echo $exception->getFile(); ?></p>
    <p>Line Number: <?php echo $exception->getLine(); ?></p>

    <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

        <p>Backtrace:</p>
        <?php foreach ($exception->getTrace() as $error): ?>

            <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

                <p style="margin-left:10px">
                    File: <?php echo $error['file']; ?><br />
                    Line: <?php echo $error['line']; ?><br />
                    Function: <?php echo $error['function']; ?>
                </p>
            <?php endif ?>

        <?php endforeach ?>

    <?php endif ?>

</div>
<?php else: ?>
    <?php header("Location: https://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']) . 'ugmfw-error/error.php'); ?>
<?php endif; ?>