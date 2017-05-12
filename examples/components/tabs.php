<?php

$tabs = $_val('tabs') ?? null;

?>
<?php if ($tabs) : ?>
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-tabs" id="tabs<?= $_prop('_id') ?>" role="tablist">
                <?php foreach ($tabs as $id => $tab) : ?>
                    <?php
                        $isActive = isset($tab['active']) && $tab['active']
                    ?>
                    <li role="presentation"<?= $isActive ? ' class="active"' : null ?>>
                        <a href="#<?= $id ?>" aria-controls="<?= $id ?>" role="tab" data-toggle="tab">
                            <?= $tab['label'] ?>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
            <br>
            <div class="tab-content">
                <?php foreach ($tabs as $id => $tab) : ?>
                    <?php
                        $isActive = isset($tab['active']) && $tab['active']
                    ?>
                    <div role="tabpanel" class="tab-pane<?= $isActive ? ' active' : null ?>" id="<?= $id ?>">
                        <div class="lead"><?= $tab['content'] ?></div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#tabs<?= $_prop('_id') ?>').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        });
    }, false);
    </script>
<?php endif ?>
