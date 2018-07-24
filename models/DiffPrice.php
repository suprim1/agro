<?php

namespace app\models;

use yii\base\BaseObject;

/**
 * контролирует отклонение между текущей ценой и предыдущей
 *
 * ```php
 * $DiffPrice = new DiffPrice([
 *      'tolerance' => $tolerance,
 *      'currentPrice' => $currentPrice,
 *      'previousPrice' => $previousPrice,
 *      ]);
 * ```
 *
 * для получения результата вычисления необходимо вызвать:
 * ```php
 * $DiffPrice->amount;
 * ```
 */
class DiffPrice extends BaseObject {

    /**
     * Допустимое отклонение в %
     * @var float
     */
    public $tolerance;

    /**
     * Текущая цена
     * @var float
     */
    public $currentPrice;

    /**
     * Предыдущая цена
     * @var float
     */
    public $previousPrice;

    /**
     * Результат в %
     * @var float
     */
    private $_amount;

    /**
     * Конструктор класса
     *
     */
    public function __construct(array $config) {
        parent::__construct($config);
    }

    public function init() {
        parent::init();
        if ($this->previousPrice && $this->currentPrice) {
            $this->calculation();
        }
    }

    /**
     * Метод сравнения текущей цены с предыдущей
     * В случае, если результат будет больше, чем допустимое отклонение,
     * то ме тод должен вернутm false.
     * @return bool
     */
    public function diff(): bool {
        return $this->amount > $this->tolerance ? false : true;
    }

    private function calculation() {
        if ($this->currentPrice == $this->previousPrice) {
            $amount = 0;
        } else {
            $amount = (($this->currentPrice - $this->previousPrice) / $this->previousPrice) * 100;
        }
        $this->setAmount(abs(round($amount, 2)));
    }

    /**
     * Получаем результат вычесления
     * @return float
     */
    public function getAmount(): float {
        return $this->_amount;
    }

    /**
     * Записываеем результат вычисления (сеттер)
     * @param float $amount
     */
    private function setAmount(float $amount) {
        $this->_amount = $amount;
    }

}
