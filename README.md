# invoice_manager

_Simple Invoice Manager with Laravel._

## Starting

_These instructions will allow you to get a working copy of the project on your local machine._


### Pre requirements 📋

_Before starting, you need to make sure you have an environment with PHP 7.4, Composer 2, MySQL and git, in order to perform the installation process and run the application._


### Installation 🔧

_All the console instructions below are intended to be executed in environments with Linux distributions, but it should be noted that they may vary depending on the distribution and can also be carried out in a similar way in Windows and OS X environments.:_

1. Clone the project repository in the directory of your choice:

```
https://github.com/jsolorzano/invoice_manager.git
```

2. Install dependencies with Composer:

```
composer install
```
_This step is very important to have all the necessary libraries._


3. Configure the data of the new database to use with the project:

```
cd ../invoice_manager/
nano .env
```
_If the .env file does not exist you must copy the .env.example file, name it .env and configure it there._



## Execution 🚀

_Before the final step you must execute the corresponding migrations and data load:_

```
cd ../invoice_manager/
php artisan migrate
php artisan db:seed
```

_Once all the previous steps have been carried out, you will be ready to run the application._

```
cd ../invoice_manager/
php artisan serve
```

_If you have reached this point, you can load the site with the url indicated in the console._

_Test username and password: solorzano202009@gmail.com | admin123 _



---
⌨️ By [jsolorzano](https://github.com/jsolorzano)
