# newsletters-demo

Приложение для рассылки писем.

Рассылки создаются из веб-интерфейса и ставятся в очередь на отправку.
Отправка происходит в background режиме.

Worker отправки писем запускается командой:

    bin/console send 
    
Команда сбора информации (генерации отчета) по статусу доставки писем:

    bin/console report 
    
Требования: Mysql5.6

Для создания базы данных и применения миграций запустить:

    bin/console doctrine:database:create
    bin/console doctrine:migrations:migrate 
