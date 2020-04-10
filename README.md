# Laravel-Zodiac-Crawler


## Info
   - Laravel version : 5.5.48
   - SQL : MySQL 5.7
   
## Run at local
- start up the sql & redis 
    ```
    ### 在專案根目錄 
    docker-compose up -d
    ```
- install dependicy & prepare environment

    ```cd src/```

    ```composer install```
    
    ```cp .env.local .env```

-  run schedule for crawler

    ```php artisan schedule:run >> /dev/null 2>&1```
    
-  run serve

    ```php artisan serve```
    
##  example show

- home page

![](https://i.imgur.com/1xB6M7k.png)

- login page

![](https://i.imgur.com/qNsj1o1.png)

- register page

![](https://i.imgur.com/zWldtGH.png)

- login success

![](https://i.imgur.com/sslNcSz.png)

- show today's Zodiac

![](https://i.imgur.com/e6WCPUa.png)