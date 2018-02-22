<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="<?= Yii::$app->homeUrl ?>web/css/blue/style.css" rel="stylesheet" type="text/css">
    <link href="<?= Yii::$app->homeUrl ?>web/img/favicon.png" rel="icon" type="image/vnd.microsoft.icon"/>
    <!--<link rel="image_src" href="<?php //echo Yii::$app->homeUrl . 'web/img/' . $this->image_src . '.png' ?>">-->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>
<body>

<?php $this->beginBody() ?>
    <header>
        <?php
            NavBar::begin([
                // 'brandLabel' => 'Blonder413 - Aprendizaje Dinámico',
                // 'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-blue navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-brand'],
                'items' => [
                    Html::img('@web/web/img/logo.png', ['class'=>'img-responsive', 'width'=>'30px'])
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => Yii::$app->name, 'url' => Yii::$app->homeUrl],
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Inicio', 'url' => Yii::$app->homeUrl],
                    ['label' => 'Portafolio', 'url' => ['/site/portfolio']],
                    ['label' => 'Acerca', 'url' => ['/site/about']],
                    ['label' => 'En Vivo', 'url' => ['/site/streaming']],
                    ['label' => 'Contacto', 'url' => ['/site/contact']],
                    // ['label' => 'Signup', 'url' => ['/site/signup']],
                    [
                        'label' => 'Cursos',
                        'items' => [
                            ['label'     => 'MySQL', 'url' => ['curso/mysql']],
                            ['label'     => 'PHP 5', 'url' => ['curso/php-5']],
                            ['label'     => 'YiiFramework 2', 'url' => ['curso/yiiframework-2']],
                            ['label'     => 'Todos los cursos', 'url' => ['curso/index']],
                        ]
                    ],
                    Yii::$app->user->isGuest ?
                        '' :
                        [
                            'label' => 'Admin',
                            'items' => [
                                ['label' => 'Article', 'url' => ['/article/index']],
                                ['label' => 'Category', 'url' => ['/category/index']],
                                ['label' => 'Comment', 'url' => ['/comment/index']],
                                ['label' => 'Streaming', 'url' => ['/streaming/index']],
                                [
                                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post']
                                ],
                            ]
                        ],
                ],
            ]);
            NavBar::end();
        ?>
    </header>
<!--
    <section class="jumbotron">
        <div class="container">
            <h1 class="title-blog">
              <?= Html::img('@web/web/img/logo.png', ['width'=>'70']) ?>
              Blonder413
            </h1>
            <p>Aprendizaje dinámico</p>
        </div>
    </section>
-->
    <section class="main container">
        <?= $content ?>
    </section>

    <footer class="text-center">
            <hr>
            <a rel="license" href="http://creativecommons.org/licenses/by-sa/2.5/co/">
                <img alt="Licencia Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/2.5/co/88x31.png" />
            </a>
            <br>

            <!--
            <a href="http://www.w3.org/html/logo/">
                    <img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png" width="165" height="64" alt="HTML5 Powered with CSS3 / Styling, and Semantics" title="HTML5 Powered with CSS3 / Styling, and Semantics">
            </a>
            <br>
            -->

            <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title" class="negrita">Blonder413 - Aprendizaje dinámico</span> por <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.blonder413.com" property="cc:attributionName" rel="cc:attributionURL">Jonathan Morales Salazar</a> <br>se encuentra bajo una Licencia <a rel="license" href="http://creativecommons.org/licenses/by-sa/2.5/co/">Creative Commons Atribución-CompartirIgual 2.5 Colombia</a>.
            <br>2011 - <?php echo date("Y"); ?>
        </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
