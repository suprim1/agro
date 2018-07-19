<?php

/**
 * контролирует отклонение между текущей ценой и предыдущей
 */
class DiffPrice {

    /**
     * Допустимое отклонение в %
     * @var int
     */
    public $tolerance;

    /**
     * Текущая цена
     * @var int
     */
    private $currentPrice;

    /**
     * Предыдущая цена
     * @var int
     */
    private $previousPrice;

    /**
     * Результат в %
     * @var int
     */
    private $amount;

    /**
     * Конструктор класса
     * @param int $tolerance
     * @param int $currentPrice
     * @param int $previousPrice
     * @param int $amount
     */
    public function __construct(int $tolerance, int $currentPrice, int $previousPrice = null, int $amount = null) {
        $this->tolerance = $tolerance;
        $this->currentPrice = $currentPrice;
        $this->previousPrice = $previousPrice;
        if ($this->previousPrice) {
            $this->calculation();
        } else {
            $this->setAmount($amount);
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
        if ($this->currentPrice > $this->previousPrice) {
            $amount = (($this->currentPrice - $this->previousPrice) / $this->currentPrice) * 100;
        } elseif ($this->currentPrice < $this->previousPrice) {
            $amount = (($this->previousPrice - $this->currentPrice) / $this->previousPrice) * 100;
        } else {
            $amount = 0;
        }
        $this->setAmount((int) $amount);
    }

    /**
     * Получаем результат вычесления
     * @return int
     */
    public function getAmount(): int {
        $this->calculation();
        return $this->amount;
    }

    /**
     * Записываеем результат вычисления (сеттер)
     * @param int $amount
     */
    private function setAmount(int $amount) {
        $this->amount = $amount;
    }

    /**
     * Записываем новую текущую цену
     * @param int $currentPrice
     */
    public function setCurrentPrice(int $currentPrice) {
        $this->previousPrice = $this->currentPrice;
        $this->currentPrice = $currentPrice;
    }

    /**
     * Даем возможность посмотреть текущую цену
     * @return int
     */
    public function getCurrentPrice(): int {
        return $this->currentPrice;
    }

    /**
     * Получаем предыдущую цену
     * @return type
     */
    public function getPreviousPrice(): int {
        return $this->previousPrice;
    }

}
