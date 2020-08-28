<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DailyScrum */
/* @var $form yii\widgets\ActiveForm */
/* @var $usuarios array */


?>

<?php foreach ($usuarios as $usuario) { ?>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <div class="form-group ">
                    <label class="control-label">Usuário</label>
                    <input disabled class="form-control" value="<?=$usuario->usuario->nome?>" />
                    <input type="hidden" name="scrum[<?=$usuario->usuario_id?>][usuario_id]" value="<?=$usuario->usuario_id?>" />
                    <div class="help-block"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group ">
                    <label class="control-label">O que fez Ontem?</label>
                    <textarea class="form-control" name="scrum[<?=$usuario->usuario_id?>][fez_ontem]" aria-required="true" required></textarea>
                    <div class="help-block"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group ">
                    <label class="control-label">O que fará Hoje?</label>
                    <textarea class="form-control" name="scrum[<?=$usuario->usuario_id?>][fara_hoje]" aria-required="true" required></textarea>
                    <div class="help-block"></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group ">
                    <label class="control-label" >Impedimentos</label>
                    <textarea  class="form-control" name="scrum[<?=$usuario->usuario_id?>][impedimentos]" aria-required="true" required></textarea>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
