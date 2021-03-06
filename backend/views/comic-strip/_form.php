<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\Comic;

use MongoDB\BSON\UTCDateTime;

?>
<?php $form = ActiveForm::begin(['enableClientValidation' => false]) ?>
<?= $form->errorSummary($model) ?>
<?= Html::activeHiddenInput($model, 'comic_id') ?>
<?= $form->field($model, 'url') ?>
<?= $form->field($model, 'index')->textInput([
    'value' =>
        $model->index instanceof UTCDateTime
            ? $model->index->toDateTime()->format(Yii::$app->getFormatter()->fieldDateFormat)
            : $model->index
]) ?>
<?= $form->field($model, 'date')->textInput([
    'value' =>
        $model->date instanceof UTCDateTime
            ? $model->date->toDateTime()->format(Yii::$app->getFormatter()->fieldDateFormat)
            : $model->date
]) ?>
<?= $form->field($model, 'skip')->checkbox() ?>
<?= $form->field($model, 'next')->textInput([
    'value' =>
        $model->next instanceof UTCDateTime
            ? $model->next->toDateTime()->format(Yii::$app->getFormatter()->fieldDateFormat)
            : $model->next
]) ?>
<?= $form->field($model, 'previous')->textInput([
    'value' =>
        $model->previous instanceof UTCDateTime
            ? $model->previous->toDateTime()->format(Yii::$app->getFormatter()->fieldDateFormat)
            : $model->previous
]) ?>
<?php if (!$model->getIsNewRecord()) {
    if (!$model->skip) {
        if (is_array($model->img)) {
            foreach ($model->img as $k => $v) { ?>
                <div>
                    <img src="<?= Url::to(['comic-strip/render-image', 'id' => (String)$model->_id . '_' . $k]) ?>"/>
                </div>
            <?php }
        } else { ?>
            <div>
                <img src="<?= Url::to(['comic-strip/render-image', 'id' => (String)$model->_id]) ?>"/>
            </div>
        <?php }
    } ?>
<?php } ?>
    <div class="toolbar comic-strip-form-end">
        <?= Html::submitButton(
            Yii::t(
                'app',
                $model->getIsNewRecord() ? 'Create' : 'Save'
            ),
            ['class' => 'btn btn-success']
        ) ?>
        <?php if (!$model->getIsNewRecord()) {
            echo Html::a(
                Yii::t('app', 'Refresh Scrape'),
                ['comic-strip/refresh-scrape', 'id' => (string)$model->_id],
                ['class' => 'btn btn-default']
            );
        } ?>
    </div>
<?php $form->end() ?>
