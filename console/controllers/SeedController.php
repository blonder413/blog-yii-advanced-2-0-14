<?php
// commands/SeedController.php
namespace console\controllers;

use yii\console\Controller;

use Yii;

use yii\db\Expression;
use yii\db\QueryBuilder;
use yii\helpers\Console;

use yii\rbac\DbManager;

class SeedController extends Controller
{
    public function actionIndex()
    {
        $faker = \Faker\Factory::create('es_ES');

        $transaction = Yii::$app->db->beginTransaction();

        try {
          // -- ------------------------------------- Users --------------------------------------------
          $this->stdout("inserting registers for users table\n", Console::FG_YELLOW);
            for ($i=0; $i <10; $i++) {
                Yii::$app->db->createCommand()->batchInsert('users',
                    [
                        'name', 'username', 'auth_key', 'password_hash', 'password_reset_token',
                        'email', 'photo', 'status', 'created_at', 'updated_at'
                    ],
                    [
                        [
                            $faker->firstName,
                            $faker->userName,
                            $faker->word,
                            Yii::$app->security->generatePasswordHash('123456'),
                            null,
                            $faker->freeEmail,
                            $faker->slug . '.jpg',
                            10,
                            new Expression('NOW()'),
                            new Expression('NOW()')
                        ],
                    ]
                )->execute();

            }

            //$this->stdout("Users inserted\n", Console::BOLD);
            $this->stdout("inserted registers for users table\n", Console::FG_GREEN);
            // -- ------------------------------------- Categories --------------------------------------------
            $this->stdout("inserting registers for categories table\n", Console::FG_YELLOW);
            for ($i=0; $i <10; $i++){

                Yii::$app->db->createCommand()->batchInsert('categories',
                    [
                        'category', 'slug', 'description', 'image',
                        'created_by', 'created_at', 'updated_by', 'updated_at'
                    ],
                    [
                        [
                            $faker->unique()->word,
                            $faker->unique()->slug,
                            $faker->text(200),
                            'image-' . $i . '.png',
                            $faker->numberBetween(1,10),
                            new Expression('NOW()'),
                            $faker->numberBetween(1,10),
                            new Expression('NOW()')
                        ],
                    ]
                )->execute();
            }

            $this->stdout("inserted registers for categories table\n", Console::FG_GREEN);
            // -- ------------------------------------- Courses --------------------------------------------
            $this->stdout("inserting registers for courses table\n", Console::FG_YELLOW);
            for ($i=0; $i <10; $i++){

                Yii::$app->db->createCommand()->batchInsert('courses',
                    [
                        'course', 'slug', 'description', 'image',
                        'created_by', 'created_at', 'updated_by', 'updated_at'
                    ],
                    [
                        [
                            $faker->unique()->word,
                            $faker->unique()->slug,
                            $faker->text(200),
                            'image-' . $i . '.png',
                            $faker->numberBetween(1,10),
                            new Expression('NOW()'),
                            $faker->numberBetween(1,10),
                            new Expression('NOW()')
                        ],
                    ]
                )->execute();
            }

            $this->stdout("inserted registers for courses table\n", Console::FG_GREEN);
            // -- ------------------------------------- Types --------------------------------------------
            $this->stdout("inserting registers for types table\n", Console::FG_YELLOW);

            for ($i=0; $i <3; $i++) {

                Yii::$app->db->createCommand()->batchInsert('types',
                    [
                        'type',
                        'created_by', 'created_at', 'updated_by', 'updated_at'
                    ],
                    [
                        [
                            $faker->randomElement(['article','code','video']),
                            $faker->numberBetween(1,10),
                            new Expression('NOW()'),
                            $faker->numberBetween(1,10),
                            new Expression('NOW()')
                        ],
                    ]
                )->execute();
            }

            $this->stdout("inserted registers for types table\n", Console::FG_GREEN);
            // -- ------------------------------------- Articles --------------------------------------------
            $this->stdout("inserting registers for articles table\n", Console::FG_YELLOW);

            $video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/h371D0W46Dk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
            for ($i=0; $i <100; $i++) {

                Yii::$app->db->createCommand()->batchInsert('articles',
                    [
                        'number', 'title', 'slug', 'topic', 'detail', 'abstract', 'video', 'type_id',
                        'download', 'category_id', 'tags', 'status', 'visit_counter', 'download_counter',
                        'course_id', 'created_by', 'created_at', 'updated_by', 'updated_at'
                    ],
                    [
                        [
                            $faker->numberBetween(1,10),
                            $faker->unique()->text(100),
                            $faker->unique()->slug,
                            $faker->text(100),
                            $faker->text(300),
                            $faker->text(200),
                            $video,
                            $faker->numberBetween(1,3),
                            $faker->text(100),
                            $faker->numberBetween(1,10),
                            $faker->text(20),
                            random_int(0,1),
                            random_int(0,100),
                            random_int(0,100),
                            null,
                            $faker->numberBetween(1,10),
                            new Expression('NOW()'),
                            $faker->numberBetween(1,10),
                            new Expression('NOW()')
                        ],
                    ]
                )->execute();
            }

            $this->stdout("inserted registers for articles table\n", Console::FG_GREEN);
            // -- ------------------------------------- Comments --------------------------------------------
            $this->stdout("inserting registers for comments table\n", Console::FG_YELLOW);

            for ($i=0; $i <100; $i++){

                Yii::$app->db->createCommand()->batchInsert('comments',
                    [
                        'name', 'email', 'web', 'rel', 'comment', 'date',
                        'article_id', 'status', 'client_ip', 'client_port'
                    ],
                    [
                        [
                            $faker->firstName,
                            \common\models\Security::mcrypt($faker->freeEmail),
                            $faker->word,
                            'no follow',
                            $faker->text(200),
                            new Expression('NOW()'),
                            $faker->numberBetween(1,100),
                            $faker->numberBetween(0,1),
                            $faker->word,
                            '413'
                        ]
                    ]
                )->execute();
            }

            $this->stdout("inserted registers for comments table\n", Console::FG_GREEN);

            $transaction->commit();

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
    //----------------------------------------------- RBAC ----------------------------------------------

    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    public function actionRbac()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
          $auth = $this->getAuthManager();

          $tables = ['article', 'category', 'comment', 'course', 'streaming', 'type', 'user'];
          $permissions = ['create', 'delete', 'update', 'view', 'list'];

          $role_admin = $auth->createRole('admin');
          $role_admin->description = 'This user can admin the complete database';
          $auth->add($role_admin);
          $this->stdout("role admin has been created\n", Console::FG_GREEN);

          for ($i = 0; $i < count($tables); $i++) {
            $this->stdout("creating roles and permissions for $tables[$i] \n", Console::FG_YELLOW);

            $role = $auth->createRole( $tables[$i] . '-admin');
            $role->description = 'This user can admin all CRUD operations on ' . $tables[$i] . ' table';
            $auth->add($role);

            $auth->addChild($role_admin, $role);

            for ($j = 0; $j < count($permissions); $j++) {
              $permission = $auth->createPermission( $tables[$i] . '-' . $permissions[$j] );
              $permission->description = 'This user can ' . $permissions[$j] . ' registers on ' .$tables[$i] . ' table';
              $auth->add($permission);

              $auth->addChild($role, $permission);
            }

            if ($tables[$i] == 'article' or $tables[$i] == 'comment' or $tables[$i] == 'user') {
              $permission_status = $auth->createPermission( $tables[$i] . '-change-status' );
              $permission_status->description = 'This user can change the register status on ' .$tables[$i] . ' table';
              $auth->add($permission_status);
              $auth->addChild($role, $permission_status);
              $auth->addChild($permission_status, $permission);

            }

            $this->stdout("roles and premissions for $tables[$i] have been created\n", Console::FG_GREEN);
          }

          //------------------------------------------------------------------------------------------------

          // user can update only their own registers
          $rule = new \backend\rbac\AuthorRule;
          $auth->add($rule);

          // users can access only their own view
          $rule = new \backend\rbac\MyselfRule;
          $auth->add($rule);

          $transaction->commit();

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
