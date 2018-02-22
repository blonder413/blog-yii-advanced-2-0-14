<?php
use kartik\alert\AlertBlock;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

setlocale(LC_TIME, 'es_CO.UTF-8');

if (isset($_GET['page'])) {
    $this->title = "Blonder413 - Página " . $_GET['page'];
} else {
    $this->title = "Blonder413";
}

// parámetros para el sidebar
$this->params['categories'] = $categories;
$this->params['most_visited'] = $most_visited;

?>

<?php // echo Html::a("mi web", "@blonder413"); ?>

<!-- <section class="posts col-md-9"> -->

    <?= Breadcrumbs::widget([
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?= AlertBlock::widget([
        'type' => AlertBlock::TYPE_ALERT,
        'useSessionFlash' => true,
        'delay' => 20000,
    ]) ?>

    <?php foreach ($articles as $key => $value): ?>
    <article class="post clear-fix">
          <?= Html::a(
              Html::img(
                  '@backend/img/categories/' . $value->category->slug . '.png',
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

            <div class="post-date">
                <span class="glyphicon glyphicon-user">&nbsp;</span><span class="post-author"><?= ucWords(HTml::encode("{$value->createdBy->name}")) ?></span>
                &nbsp;|
                <span class="glyphicon glyphicon-calendar">&nbsp;</span><?= strftime("%c", strtotime($value->created_at)) ?>
            </div>

          <p class="post-content">
            <?= $value->abstract ?>
          </p>

          <div class="container-buttons">
            <?= Html::a(
                'Ver Más &raquo;',
                ['/articulo/' . Html::encode("{$value->slug}")],
                [
                    'class' => 'btn btn-primary btn-sm',
                    'title' => 'Ver artículo completo',
                ]
            ) ?>
            <?= Html::a(
                "Comentarios <span class='badge'>$value->commentsCount</span>",
                ['/articulo/' . Html::encode("{$value->slug}") . '#comments'],
                [
                    'class' => 'btn btn-success btn-sm',
                    'title' => 'Ver Comentarios',
                ]
            ) ?>
          </div>
    </article>
    <?php endforeach; ?>

    <div class="row text-center"><?php echo LinkPager::widget(['pagination'=>$pagination]); ?></div>

<!--</section>-->
<!--
<aside class="hidden-xs hidden-sm col-md-3">
    <?php /* echo $this->render(
        '/site/_sidebar',
        [
            'categories'    => $categories,
            'most_visited'  => $most_visited,
        ]
    ) */ ?>
</aside>
-->
