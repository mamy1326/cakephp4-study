<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string|array $message
 */

if (is_array($message)) {
    $message = implode('<br>', array_map(function ($v) use ($params) {
        if (!isset($params['escape']) || $params['escape'] !== false) {
            $v = h($v);
        }
        return $v;
    }, $message));
} else {
    if (!isset($params['escape']) || $params['escape'] !== false) {
        $message = h($message);
    }
}
?>
<section class="content-header">
    <div class="alert alert-success alert-dismissible">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> <?= __('Alert') ?>!</h4>
        <?= $message ?>
    </div>
</section>
