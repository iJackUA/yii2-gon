<?php
namespace ijackua\gon;

use yii\base\Component;
use yii\helpers\Json;
use yii\web\View;

class GonComponent extends Component
{
    /**
     * Global JS variable name 'window.'
     *
     * @var string
     */
    public $jsVariableName = 'gon';
    /**
     * Array with global accessible data for each request
     *
     * @var array
     */
    public $globalData = [];
    /**
     * Show or hide 'window.gon' if there is no data pushed
     *
     * @var bool
     */
    public $showEmptyVar = true;


    protected $data = [];

    public function init()
    {
        parent::init();
        \Yii::$app->view->on(View::EVENT_BEFORE_RENDER, function () {
            $this->registerJs();
        });
    }

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
        return array_merge($this->globalData, $this->data);
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
        if ($this->dataExists() || $this->showEmptyVar) {
            \Yii::$app->view->registerJs($this->gonScriptWrapped(), View::POS_HEAD);
        }
    }
}
