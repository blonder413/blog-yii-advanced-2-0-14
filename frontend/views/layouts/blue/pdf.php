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
<html lang='es'>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link href="<?= Yii::$app->homeUrl ?>web/css/blue/pdf.css" rel="stylesheet" type="text/css">
    <link href="<?= Yii::$app->homeUrl ?>web/img/favicon.png" rel="icon" type="image/vnd.microsoft.icon"/>
    <!--<link rel="image_src" href="<?php //echo Yii::$app->homeUrl . 'web/img/' . $this->image_src . '.png' ?>">-->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>

<body>

	<section class="jumbotron">
        <div class="container">
            <h1 class="title-blog">
              <?= Html::img('@web/web/img/logo.png', ['width'=>'20']) ?>
              Blonder413
            </h1>
            Aprendizaje dinámico
        </div>
    </section>

	<div class="content">
		<?= $content ?>
	</div>
    
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

</body>
</html>
<?php $this->endPage() ?>