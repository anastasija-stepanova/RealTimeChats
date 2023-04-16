# Real time chats
## How to run
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
