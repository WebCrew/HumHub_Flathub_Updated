<?php

use humhub\modules\topic\widgets\TopicPicker;
use yii\helpers\Html;
use humhub\modules\content\assets\ContentFormAsset;
use humhub\modules\file\widgets\FilePreview;
use humhub\modules\space\models\Space;
use humhub\modules\user\widgets\UserPickerField;
use humhub\modules\file\widgets\UploadButton;
use humhub\modules\file\widgets\FileHandlerButtonDropdown;
use humhub\modules\file\widgets\UploadProgress;
use humhub\widgets\Link;
use humhub\widgets\Button;
use humhub\modules\ui\form\widgets\ActiveForm;

/* @var $defaultVisibility integer */
/* @var $submitUrl string */
/* @var $form string */
/* @var $submitButtonText string */
/* @var $fileHandlers \humhub\modules\file\handler\BaseFileHandler[] */
/* @var $canSwitchVisibility boolean */
/* @var $contentContainer \humhub\modules\content\components\ContentContainerActiveRecord */

ContentFormAsset::register($this);

$this->registerJsConfig('content.form', [
    'defaultVisibility' => $defaultVisibility,
    'disabled' => ($contentContainer instanceof Space && $contentContainer->isArchived()),
    'text' => [
        'makePrivate' => Yii::t('ContentModule.widgets_views_contentForm', 'Make private'),
        'makePublic' => Yii::t('ContentModule.widgets_views_contentForm', 'Make public'),
        'info.archived' => Yii::t('ContentModule.widgets_views_contentForm', 'This space is archived.')
]]);

$pickerUrl = ($contentContainer instanceof Space) ? $contentContainer->createUrl('/space/membership/search') : null;

?>

<div class="panel panel-default clearfix">
    <div class="panel-body message-new" id="contentFormBody" style="display:none;" data-action-component="content.form.CreateForm" >
        <?php $form = ActiveForm::begin(['acknowledge' => true]); ?>

        <?= $wallCreateContentForm->renderActiveForm($form) ?>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- /panel body -->
</div> <!-- /panel -->
