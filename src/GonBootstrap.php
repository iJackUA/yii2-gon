<?php
namespace ijackua\gon;

use yii\base\BootstrapInterface;
use yii\base\Application;
use yii\web\View;

class GonBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->view->on(View::EVENT_BEFORE_RENDER, function () use ($app) {
            $app->gon->registerJs();
        });
    }
}
