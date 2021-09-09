# Лаба по вебу #1

Выполнил Неевин Кирилл P3213, вариант #13201

## Дебаг
Чтобы сбросить сессию, нужно добавить к запросу `php/index.php` флаг `&reset=yes`

## Деплой

Деплой на helios:
```shell
ssh s313087@helios.se.ifmo.ru -p 2222
mkdir public_html
scp -r -P 2222 src s313087@helios.se.ifmo.ru:/home/s313087/public_html/
```
