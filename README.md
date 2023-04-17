# Real time chats
## How to run

*Make sure that these ports are free: 80, 3306*

```
git clone https://github.com/anastasija-stepanova/RealTimeChats.git
cd RealTimeChats
composer install
./vendor/bin/sail up --build
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
laravel-echo-server start
```
Get to: http://localhost
