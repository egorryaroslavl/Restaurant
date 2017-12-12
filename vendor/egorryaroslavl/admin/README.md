# AdminDepartment

 Installation
 -------
```
 composer require "egorryaroslavl/admin":"1.0.10" 
```
Then, add serviceProvider:

```
Egorryaroslavl\Admin\AdminServiceProvider::class,
```

and run
```
php artisan vendor:publish 
```
and  run
```
php artisan migrate
```