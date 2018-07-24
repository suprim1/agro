<?php

namespace app\models;

use yii\base\Model;

class PriceForm extends Model {

    /**
     * Допустимое отклонение в %
     * @var int
     */
    public $tolerance;

    /**
     * Текущая цена
     * @var int
     */
    public $currentPrice;

    /**
     * Предыдущая цена
     * @var int
     */
    public $previousPrice;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['tolerance', 'currentPrice', 'previousPrice'], 'required'],
            [['currentPrice', 'previousPrice', 'tolerance'], 'number', 'min' => 0],
        ];
    }



}
