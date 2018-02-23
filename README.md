### Instalation
```
git clone https://github.com/blonder413/blog-yii-advanced-2-0-14
cd blog-yii-advanced-2-0-14/
php init
composer install
```

Also is important you configure ```frontend\config\params-local.php```,
specially ```securityKey```, this is the secure key for email encryptation
from user comments

### Database and Seeder
Configure db Connection in ```common/config/main-local.php``` and
use the follow commands to create the project and RBAC tables

```
./yii migrate
yii migrate --migrationPath=@yii/rbac/migrations
```

The ```console/controllers/SeedController``` file contains the seeder configuration
you can modify this file for add seeder to new tables

If you want to execute the seeder you have to run the console command

```
./yii seed
```

If you want insert roles and premissions by default, you have to run the following commands

```
./yii seed/rbac
```

### Layouts

The frontend layout configuration is in ```frontend\config\main.php```
```layout``` key.
The CSS files for frontend layouts is en ```frontend\web\css\layout_name```
where ```layout_name``` is the name of the folder layout in ```frontend\views\layouts```
The images for layouts must be in ```frontend\web\img``` folder

You need to add the CSS files to ```frontend\web\assets\AppAsset.php```.

### turn on maintenance

When you need to do changes in the web, you can turn on maintenance mode,
for that you need uncomment ```catchAll``` key on ```frontend/config/main.php``` file.
The file ```frontend/views/site/offline.php``` will be rendering, you can personalize this page
and change the page you want to be rendering in ```frontend/config/main.php``` on ```catchAll``` key.


### Extensions

Extensions is only a reference for other applications,
if you run ```composer install``` you will have all extensions
for this project

- https://github.com/kartik-v/yii2-widget-select2

```
composer require kartik-v/yii2-widget-select2 "@dev"
```

- yii2-ckeditor-widget (https://github.com/2amigos/yii2-ckeditor-widget)

```
composer require 2amigos/yii2-ckeditor-widget
```

- yii2-widget-datetimepicker (https://github.com/kartik-v/yii2-widget-datetimepicker)

```
composer require kartik-v/yii2-widget-datetimepicker "*"
```

- Bootstrap DateTimePicker Widget for Yii2 (https://github.com/2amigos/yii2-date-time-picker-widget)

```
composer require 2amigos/yii2-date-time-picker-widget:~1.0
```

- Bootstrap DatePicker Widget for Yii2 (https://github.com/2amigos/yii2-date-picker-widget)

```
composer require 2amigos/yii2-date-picker-widget:~1.0
```

- yii2-widget-alert (https://github.com/kartik-v/yii2-widget-alert)

```
composer require kartik-v/yii2-widget-alert "*"
```

- yii2-widget-growl

```
composer require kartik-v/yii2-widget-growl "*"
```

- yii2-adminlte-asset (http://www.yiiframework.com/extension/yii2-adminlte-asset/)

```
composer require dmstr/yii2-adminlte-asset "*"
```
