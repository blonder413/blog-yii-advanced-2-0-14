<?php
use app\models\Helper;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */


setlocale(LC_TIME, 'es_CO.UTF-8');

if (isset($_GET['page'])) {
    $this->title = "Categoría " . $category->category . " - Página " . $_GET['page'] . " | Blonder413";
} else {
    $this->title = "Categoría " . $category->category . " | Blonder413";
}

// parámetros para el sidebar
$this->params['categories'] = $categories;
$this->params['most_visited'] = $most_visited;
?>

    <!-- <i class="fa folder-open fa-lg"></i> -->
    <h2 class="text-center"><span class="glyphicon glyphicon-folder-close small"></span>&nbsp;<?= $category->category ?></h2>


    <?= Breadcrumbs::widget([
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?php foreach ($articles as $key => $value): ?>
    <article class="post clear-fix">
          <?= Html::a(
              Html::img(
                  '@web/web/img/categories/' . $value->category->slug . '.png',
                  [
                      // 'class' => 'img-circle',
                      'alt'   => $value->category->category,
                      'class' => 'img-thumbnail',
                  ]
              ),
              ['/categoria/' . Html::encode("{$value->category->slug}")],
              [
                'class' => 'thumb pull-left',
              ]
          );
          ?>

          <h3 class="post-title">
            <?= Html::a(
                Html::encode("{$value->title}"),
                ['/articulo/' . Html::encode("{$value->slug}")],
                [
                  'title' => Html::encode("{$value->title}"),
                ]
            ) ?>
          </h3>

          <p>
            <span class="post-date">
                <span class="glyphicon glyphicon-user">&nbsp;</span><span class="post-author"><?= ucWords(HTml::encode("{$value->createdBy->name}")) ?></span>
                &nbsp;|
                <span class="glyphicon glyphicon-calendar">&nbsp;</span><?= strftime("%c", strtotime($value->created_at)) ?>
            </span>
          </p>

          <p class="post-content">
            <?php
            if (empty($value->abstract)) {
                echo HtmlPurifier::process(Helper::myTruncate($value->detail, 300, " ", "..."));
            } else {
                echo $value->abstract;
            }
            ?>
          </p>

          <div class="container-buttons">
            <?= Html::a(
                'Ver Más &raquo;',
                ['/articulo/' . Html::encode("{$value->slug}")],
                [
                    'class' => 'btn btn-primary',
                    'title' => 'Ver artículo completo',
                ]
            ) ?>
            <?= Html::a(
                "Comentarios <span class='badge'>$value->commentsCount</span>",
                ['/articulo/' . Html::encode("{$value->slug}") . '#comments'],
                [
                    'class' => 'btn btn-success',
                    'title' => 'Ver Comentarios',
                ]
            ) ?>
          </div>
    </article>
    <?php endforeach; ?>

    <div class="row text-center"><?php echo LinkPager::widget(['pagination'=>$pagination]); ?></div>
