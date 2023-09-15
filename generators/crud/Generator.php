<?php

namespace uzdevid\dashboard\generators\crud;

use yii\gii\CodeFile;
use yii\helpers\Inflector;
use yii\helpers\VarDumper;
use Yii;

class Generator extends \yii\gii\generators\crud\Generator {
    public $baseControllerClass = 'uzdevid\dashboard\base\web\Controller';

    public function generateActiveField($attribute) {
        $tableSchema = $this->getTableSchema();
        if ($tableSchema === false || !isset($tableSchema->columns[$attribute])) {
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $attribute)) {
                return "\$form->field(\$model, '$attribute', ['options' => ['class' => 'mb-3']])->passwordInput()";
            }

            return "\$form->field(\$model, '$attribute', ['options' => ['class' => 'mb-3']])";
        }

        $column = $tableSchema->columns[$attribute];

        if ($column->phpType === 'boolean') {
            return "\$form->field(\$model, '$attribute', ['options' => ['class' => 'mb-3']])->checkbox()";
        }

        if ($column->type === 'text') {
            return "\$form->field(\$model, '$attribute', ['options' => ['class' => 'mb-3']])->textarea(['rows' => 6])";
        }

        if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
            $input = 'passwordInput';
        } else {
            $input = 'textInput';
        }

        if (is_array($column->enumValues) && count($column->enumValues) > 0) {
            $dropDownOptions = [];
            foreach ($column->enumValues as $enumValue) {
                $dropDownOptions[$enumValue] = Inflector::humanize($enumValue);
            }
            return "\$form->field(\$model, '$attribute', ['options' => ['class' => 'mb-3']])->dropDownList("
                . preg_replace("/\n\s*/", ' ', VarDumper::export($dropDownOptions)) . ", ['prompt' => ''])";
        }

        if ($column->phpType !== 'string' || $column->size === null) {
            return "\$form->field(\$model, '$attribute', ['options' => ['class' => 'mb-3']])->$input()";
        }

        return "\$form->field(\$model, '$attribute', ['options' => ['class' => 'mb-3']])->$input(['maxlength' => true])";
    }

    public function generate() {
        $controllerFile = Yii::getAlias('@' . str_replace('\\', '/', ltrim($this->controllerClass, '\\')) . '.php');

        $files = [
            new CodeFile($controllerFile, $this->render('controller.php')),
        ];

        if (!empty($this->searchModelClass)) {
            $searchModel = Yii::getAlias('@' . str_replace('\\', '/', ltrim($this->searchModelClass, '\\') . '.php'));
            $files[] = new CodeFile($searchModel, $this->render('search.php'));
        }

        $viewPath = $this->getViewPath();
        $templatePath = $this->getTemplatePath() . '/views';
        foreach (scandir($templatePath) as $file) {
            if (empty($this->searchModelClass) && $file === '_search.php') {
                continue;
            }
            if (is_file($templatePath . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $files[] = new CodeFile("$viewPath/$file", $this->render("views/$file"));
            }
        }

        $templatePath = $this->getTemplatePath() . '/views/modal';
        foreach (scandir($templatePath) as $file) {
            if (empty($this->searchModelClass) && $file === '_search.php') {
                continue;
            }
            if (is_file($templatePath . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $files[] = new CodeFile("$viewPath/modal/$file", $this->render("views/modal/$file"));
            }
        }

        return $files;
    }
}
