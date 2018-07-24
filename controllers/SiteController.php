<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\PriceForm;
use app\models\DiffPrice;
use Yii;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        $model = new PriceForm();
        return $this->render('index', compact('model'));
    }

    public function actionAmount() {
        $model = new PriceForm();
        if ($model->load(Yii::$app->request->post(), 'PriceForm') && $model->validate()) {
            $amount = new DiffPrice([
                'tolerance' => $model->tolerance,
                'currentPrice' => $model->currentPrice,
                'previousPrice' => $model->previousPrice,
            ]);
            return $this->render('amount', compact('amount'));
        }
    }

}
