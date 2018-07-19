# Тестовое задание
Контроль колебания цены

```php
$class = new DiffPrice(30, 10, 20, 10);
echo $class->diff();                //false
echo $class->getAmount();           //50   
$class->setCurrentPrice(12);
echo $class->getCurrentPrice();     //12
echo $class->getPreviousPrice();    //10
echo $class->getAmount();           //16
echo $class->diff();                //true
```

Использовать можно в сфере торговли 
Например отслеживать клебания цены у конкурента
Можно напоминать клиенту что товар который он просматривал недавно стал дешевле на N%