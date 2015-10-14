<?php
namespace ijackua\gon;

use yii\base\Component;
use yii\helpers\Json;
use yii\web\View;

class GonComponent extends Component
{

    public $jsVariableName = 'gon';

    protected $data = [];

    /**
     * Push key => value from PHP to JS
     *
     * @param $key
     * @param $value
     */
    public function push($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function allVariables()
    {
        return $this->data;
    }

    public function clear()
    {
        $this->data = [];
    }

    public function dataExists()
    {
        return count($this->allVariables()) > 0;
    }

    public function gonScript()
    {
        return Json::encode($this->allVariables());
    }

    public function gonScriptWrapped()
    {
        $script = $this->gonScript();
        $defScript = "window.{$this->jsVariableName} = {};";
        if ($this->dataExists()) {
            $script = "{$defScript} window.{$this->jsVariableName} = {$script};";
        } else {
            $script = $defScript;
        }
        return $script;
    }

    public function registerJs()
    {
        if ($this->dataExists()) {
            \Yii::$app->view->registerJs($this->gonScriptWrapped(), View::POS_HEAD);
        }
    }
}
