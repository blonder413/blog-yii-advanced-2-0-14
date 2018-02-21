### Instalation
```
git clone https://github.com/blonder413/blog-yii-advanced-2-0-14
cd blog-yii-advanced-2-0-14/
php init
composer install
```
### Database and Seeder
Configure db Connection in ```common/config/main-local.php```
```
./yii migrate
```

The ```console/controllers/SeedController``` file contains the seeder configuration
you can modify this file for add seeder to new tables

If you want to execute the seeder you have to run the console command

```
./yii seed
```

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
