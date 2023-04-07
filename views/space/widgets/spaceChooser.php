<?php

/* @var $this \humhub\components\WebView */
/* @var $currentSpace \humhub\modules\space\models\Space */

use humhub\modules\space\assets\SpaceChooserAsset;
use humhub\modules\space\widgets\SpaceChooserItem;
use humhub\modules\space\widgets\Image;
use yii\helpers\Url;
use yii\helpers\Html;

SpaceChooserAsset::register($this);

$noSpaceView = '<div class="no-space topbar-bth-div"><i class="fa fa-dot-circle-o"></i></div>';

$this->registerJsConfig('space.chooser', [
    'noSpace' => $noSpaceView,
    'remoteSearchUrl' =>  Url::to(['/space/browse/search-json']),
    'text' => [
        'info.remoteAtLeastInput' => Yii::t('SpaceModule.widgets_views_spaceChooser', 'To search for other spaces, type at least {count} characters.', ['count' => 2]),
        'info.emptyOwnResult' => Yii::t('SpaceModule.widgets_views_spaceChooser', 'No member or following spaces found.'),
        'info.emptyResult' => Yii::t('SpaceModule.widgets_views_spaceChooser', 'No result found for the given filter.'),
    ],
]);
?>

<div class="dropdown">
    <a href="#" id="space-menu" class="dropdown-toggle" data-toggle="dropdown">
        <!-- start: Show space image and name if chosen -->
        <?php if ($currentSpace) : ?>
            <?= Image::widget([
                'space' => $currentSpace,
                'width' => 30,
                'htmlOptions' => [
                    'class' => 'current-space-image',
                ]
            ]);
            ?>
        <?php endif; ?>

        <?php if (!$currentSpace) : ?>
            <?= $noSpaceView ?>
        <?php endif; ?>
        <!-- end: Show space image and name if chosen -->
    </a>

    <ul class="dropdown-menu" id="space-menu-dropdown">
        <li>
            <div class="arrow"></div>
            <form action="" class="dropdown-controls">
                <div class="input-group">
                    <input type="text" id="space-menu-search" class="form-control" autocomplete="off" 
                           placeholder="<?= Yii::t('SpaceModule.widgets_views_spaceChooser', 'Search'); ?>"
                           title="<?= Yii::t('SpaceModule.widgets_views_spaceChooser', 'Search for spaces'); ?>">
                    <span id="space-directory-link" class="input-group-addon" >
                        <a href="<?= Url::to(['/directory/directory/spaces']); ?>">
                            <i class="fa fa-book"></i>
                        </a>
                    </span>
                </div>
            </form>
        </li>

        <li class="divider"></li>
        <li>
            <ul class="media-list notLoaded" id="space-menu-spaces">
                <?= $renderedItems ?>
            </ul>
        </li>
        <li class="remoteSearch">
            <ul id="space-menu-remote-search" class="media-list notLoaded"></ul>
        </li>

    <?php if ($canCreateSpace) : ?>
        <li>
            <div class="dropdown-footer">
                <a href="#" class="btn btn-info col-md-12" data-action-click="ui.modal.load" data-action-url="<?= Url::to(['/space/create/create']) ?>">
                    <?= Yii::t('SpaceModule.widgets_views_spaceChooser', 'Create new space') ?>
                </a>
            </div>
        </li>
    <?php endif; ?>
    </ul>
</div>
