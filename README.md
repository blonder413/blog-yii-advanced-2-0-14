### Instalation
```
git clone https://github.com/blonder413/blog-yii-advanced-2-0-14
cd blog-yii-advanced-2-0-14/
php init
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
