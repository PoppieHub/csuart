<?php
use app\models\Students;
use app\models\Teacher;
use app\models\Subject;
use app\models\Plus;
use app\models\Group;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>
<?php

$array = $_POST['FirstForm'];

$teacher = $array['teacher'];

$group = $array['group'];

$subject = $array['subject'];

$date = $array['date'];
?>
<div class="get-index">

    <p>
    <h3><b>Группа: </b><?= $v->group ?></h3>
    </p>
    <p><b>Преподаватель: </b><?   $teacher_table = Teacher::find()->where(['id' => $teacher])->all();
                foreach ($teacher_table as $v)
                {
                    echo $v->teacher_sur_name.' '.$v->teacher_name.' '.$v->teacher_patronymic_name.' ';
                }?></p>
          <b>Предмет: </b> <?  $subject_table = Subject::find()->where(['id' => $subject])->all();
                foreach ($subject_table as $v)
                {
                    echo $v->subject;
                }
                $date_view = date_create($date);

                echo '<h4>'.date_format($date_view, 'j F Y').'</h4>';
            ?>
    <div class="visit-form">
        <h3>Студенты: </h3>
    <?php $form = ActiveForm::begin(); ?>
        <table>
            <?php

            //$operation = $form->field($model, 'operation')->label('')->dropDownList(Plus::find()->select(['operation', 'id'])->indexBy('id')->column(), ['prompt' => '']);

            foreach ($visits as $index => $v)
            {
                echo $form->field($v, "[$index]plus_id")->dropDownList(Plus::find()->select(['operation', 'id'])->indexBy('id')->column(), ['prompt' => ''])->label($v->students->name.' '.$v->students->sur_name);
                echo $form->field($v, "[$index]students_id", [
					 	'template' => "{input}",
					 	'options' => ['tag' => false]               
                ])->hiddenInput();
                echo $form->field($v, "[$index]subject_id", [
					 	'template' => "{input}",
					 	'options' => ['tag' => false]               
                ])->label('')->hiddenInput();
					 echo $form->field($v, "[$index]teacher_id", [
					 	'template' => "{input}",
					 	'options' => ['tag' => false]               
                ])->label('')->hiddenInput();
					 echo $form->field($v, "[$index]date", [
					 	'template' => "{input}",
					 	'options' => ['tag' => false]               
                ])->label('')->hiddenInput();
            }
//                foreach ($students as $v)
//                {
//                    echo "<tr>";
//                    echo "<td><input type='text' name='students' readonly value='$v->name $v->sur_name'></td>";
//                    echo "<td>".$operation."</td>";
//                    echo "</tr>";
//                }

            ?>
            </table><br>
        <div class="form-group">
            <?= Html::submitButton('Дальше', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>