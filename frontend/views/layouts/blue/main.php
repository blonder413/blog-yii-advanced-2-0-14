<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">

    <meta name='author' content='Jonathan Morales Salazar'>
    <meta name='copyright' content='www.blonder413.com'>
    <meta name='designer' content='www.blonder413.com'>
    <meta name='publisher' content='www.blonder413.com'>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (isset($this->params['description'])): ?>
    <meta name="description" content="<?= $this->params['description']; ?>">
    <?php endif; ?>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="img/favicon.png" rel="icon" type="image/vnd.microsoft.icon"/>
    <!--<link rel="image_src" href="<?php //echo Yii::$app->homeUrl . 'web/img/' . $this->image_src . '.png' ?>">-->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="alternate" type="application/rss+xml" title="RSS feed" href="/rss.xml" />

    <link rel="canonical" href="/web/tweet-button">
    <link rel="me" href="https://twitter.com/blonder413">

    <!-- Registro en Google -->
    <!-- Put the following javascript before the closing </head> tag. -->
    <script>
        (function() {
            var cx = '009014689535229426168:oaz4ieig01w';
            var gcse = document.createElement('script');
            gcse.type = 'text/javascript';
            gcse.async = true;
            gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                    '//www.google.es/cse/cse.js?cx=' + cx;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gcse, s);
        })();
    </script>
    <!-- /Registro en Google -->

</head>
<body>

<?php $this->beginBody() ?>

    <!--Facebook page plugin-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!--/Facebook page plugin-->

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
                    Html::img('@web/img/logo.png', ['class'=>'img-responsive', 'width'=>'30px'])
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
                            ['label'     => 'CodeIgniter 3', 'url' => ['curso/codeigniter-3']],
                            ['label'     => 'Laravel 5.4', 'url' => ['curso/laravel-54']],
                            ['label'     => 'Linux Mint 18', 'url' => ['curso/linux-mint-18']],
                            ['label'     => 'MySQL', 'url' => ['curso/mysql']],
                            ['label'     => 'PHP 7', 'url' => ['curso/php-7']],
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
              <?= Html::img('@web/img/logo.png', ['width'=>'70']) ?>
              Blonder413
            </h1>
            <p>Aprendizaje dinámico</p>
        </div>
    </section>
-->
    <section class="main container">
      <div class="row">

            <!-- Google Adsense -->
            <div class="col-sm-12 col-md-12">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- bannerresponsive -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-2208995637216263"
                     data-ad-slot="1780166723"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <br>
            </div>
            <!-- End Google Adsense -->
<!--
            <div class="col-sm-12 col-md-12">
                <?php
                $numDia = date('N');

                switch ($numDia) {
                    case 1: // lunes
                        $img = 'web/img/banner/lunes.png';
                        $alt = 'PHP';
                        break;
                    case 2: // martes
                        $img = 'web/img/banner/martes.png';
                        $alt = 'PHP';
                        break;
                    case 3: // miércoles
                        $img = 'web/img/banner/miercoles.png';
                        $alt = 'YiiFramework 2';
                        break;
                    case 4: // jueves
                        $img = 'web/img/banner/jueves.png';
                        $alt = 'Java';
                        break;
                    case 5: // viernes
                        $img = 'web/img/banner/viernes.png';
                        $alt = 'PHP';
                        break;
                    default:
                        $img = 'web/img/banner/viernes.png';
                        $alt = 'PHP';
                }
                ?>
                <p class="text-center">
                    <a href="http://www.manosenelcodigo.com/en-vivo" target="_blank" title="Ver la clase en vivo"><img src="<?= Yii::$app->homeUrl . $img; ?>"></a>
                </p>
            </div>
-->
          <!-- Buscador de Google -->
          <div class="col-sm-12">
                <script>
                (function() {
                  var cx = '009014689535229426168:oaz4ieig01w';
                  var gcse = document.createElement('script');
                  gcse.type = 'text/javascript';
                  gcse.async = true;
                  gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                      '//cse.google.com/cse.js?cx=' + cx;
                  var s = document.getElementsByTagName('script')[0];
                  s.parentNode.insertBefore(gcse, s);
                })();
              </script>
              <gcse:search></gcse:search>
            </div>
          <!-- /Buscador de Google -->

        <section class="posts col-md-9">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </section>

        <!--Sidebar-->
        <aside class="hidden-xs hidden-sm col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Mis Redes Sociales</div>
                <div class="panel-body">
                    <?= Html::a(
                        Html::img("@web/web/img/google-plus-c.png", ['class'=>'img-thumbnail','width' => '50', 'alt' => 'Mi perfil en Google+']),
                        '@google+',
                        ['target' => '_blank', 'title'  => 'Mi perfil en Google+']
                    ) ?>

                    <?= Html::a(
                        Html::img("@web/web/img/twitter-c.png", ['class'=>'img-thumbnail','width' => '50', 'alt' => 'Mi perfil en Twitter']),
                        '@twitter',
                        ['target' => '_blank', 'title'  => 'Mi perfil en Twitter']
                    ) ?>

                    <?php /* echo Html::a(
                        Html::img("@web/web/img/facebook-c.png", ['class'=>'img-thumbnail','width' => '50', 'alt' => 'Mi biografía en Facebook']),
                        '@facebook',
                        ['target' => '_blank', 'title'  => 'Mi perfil en Facebook']
                    ) */ ?>

                    <?= Html::a(
                        Html::img("@web/web/img/youtube-c.png", ['class'=>'img-thumbnail','width' => '50', 'alt' => 'Mi repositorio en Github']),
                        '@youtube',
                        ['target' => '_blank', 'title'  => 'Mi canal de youtube']
                    ) ?>

                    <?= Html::a(
                        Html::img("@web/web/img/github-c.png", ['class'=>'img-thumbnail','width' => '50', 'alt' => 'Mi repositorio en Github']),
                        '@github',
                        ['target' => '_blank', 'title'  => 'Mi repositorio en Github']
                    ) ?>

                    <?php /*echo Html::a(
                        Html::img("@web/web/img/linked-in-c.png", ['class'=>'img-thumbnail','width' => '50', 'alt' => 'Mi perfil en LinkedIn']),
                        '@linkedin',
                        ['target' => '_blank', 'title'  => 'Mi perfil en LinkedIn']
                    )*/ ?>

                    <?php /*echo Html::a(
                        Html::img("@web/web/img/delicious-c.png", ['class'=>'img-thumbnail','width' => '50', 'alt' => 'Mi enlaces en Delicious']),
                        '@delicious',
                        ['target' => '_blank', 'title'  => 'Mi enlaces en Delicious']
                    )*/ ?>

                    <?= Html::a(
                        Html::img("@web/web/img/rss-c.png", ['class'=>'img-thumbnail','width' => '50', 'alt' => 'Mis Feeds RSS']),
                        ['/rss.xml'],
                        ['target' => '_blank', 'title'  => 'Mis Feeds RSS']
                    ) ?>
                </div>
            </div>
            <!-------------------------------------------------------------------------------------------------------->
            <?php if( isset($this->params['categories']) ): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">Categorías</div>
                <div class="list-group">
                    <nav>
                        <?php foreach( $this->params['categories'] as $key => $value ): ?>
                          <?= Html::a(
                              Html::img("@web/web/img/categories/$value->slug.png", ['alt' => $value->category, 'width' => '40']) . " " . $value->category,
                              ['/categoria/' . $value->slug],
                              [
                                  'class' => 'list-group-item',
                                  'title' => $value->category,
                              ]
                          ) ?>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </div>
            <?php endif; ?>
            <!-------------------------------------------------------------------------------------------------------->
            <!--
            <?php if( isset($this->params['most_visited']) ): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">Artículos Populares</div>
                <div class="list-group">
                    <?php foreach ($this->params['most_visited'] as $key => $value): ?>
                        <a href="<?= Yii::$app->homeUrl ?>articulo/<?= $value->slug ?>" class="list-group-item">
                            <h4 class="list-group-item-heading"><?php echo $value->title; ?></h4>
                            <p class="list-group-item-text">
                                <?php echo $value->abstract; ?>
                            </p>
                            <p>
                                <small><span class="glyphicon glyphicon-eye-open">&nbsp;</span><?= $value->visit_counter ?> visitas</small>
                            </p>
                        </a>
                  <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            -->
            <!-------------------------------------------------------------------------------------------------------->
            <div class="panel panel-primary">
                <div class="panel-heading">Webs Amigas</div>
                <div class="list-group">
                    <div class="list-group">

                        <?= Html::a(
                            Html::img("@web/web/img/webs/blonder413-blogspot.png", ['width' => '35']) . " Blonder413 - Blogger",
                            'http://blonder413.blogspot.com/',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        ) ?>

                        <?= Html::a(
                            Html::img("@web/web/img/webs/blonder413-wordpress.png", ['width' => '35']) . " Blonder413 - Wordpress",
                            'http://blonder413.wordpress.com/',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        ) ?>

                        <?= Html::a(
                            Html::img("@web/web/img/webs/cesarcancino.png", ['width' => '35']) . " WebMaster César Cancino",
                            'http://www.cesarcancino.com/',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        ) ?>

                        <?= Html::a(
                            Html::img("@web/web/img/webs/oscar-gomez.png", ['width' => '35']) . " Oscar Gómez",
                            'http://www.oscar-gomez.net',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        ) ?>

                        <?= Html::a(
                            Html::img("@web/web/img/webs/keyphercom.png", ['width' => '35']) . " Keyphercom",
                            'http://www.keyphercom.com/',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        ) ?>

                        <?= Html::a(
                            Html::img("@web/web/img/webs/tecnodidactas.png", ['width' => '35']) . " Tecnodidactas",
                            'http://www.tecnodidactas.com/',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        ) ?>

                        <?php /* echo Html::a(
                            Html::img("@web/web/img/webs/midas-ingenieria.png", ['width' => '35']) . " Midas Ingeniería",
                            'http://midasingenieria.com/',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        )*/ ?>

                        <?php /* echo Html::a(
                            Html::img("@web/web/img/webs/directorio-ladorada.png", ['width' => '35']) . " Directorio La Dorada",
                            'http://www.directorioladorada.com/',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        )*/ ?>

                        <?= Html::a(
                            Html::img("@web/web/img/webs/manos-en-el-codigo.png", ['width' => '35']) . " Manos en el código",
                            'http://www.manosenelcodigo.com/',
                            [
                                'class'     => 'list-group-item',
                                'target'    => '_blank',
                            ]
                        ) ?>

                    </div>
                </div>
            </div>
            <!-------------------------------------------------------------------------------------------------------->
            <div class="panel panel-primary">
                <div class="panel-heading">Twitter @blonder413</div>
                <div class="list-group">
                    <div class="list-group">
                        <a class="twitter-timeline"  href="https://twitter.com/blonder413" data-widget-id="245510889955008512">Tweets por el @blonder413.</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </div>
            </div>
            <!-------------------------------------------------------------------------------------------------------->
        </aside>
        <!--/Sidebar-->

      </div>
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

    <!-- Diseño del reproductor de videos -->
    <script data-cfasync="false">
      (function(r,e,E,m,b){E[r]=E[r]||{};E[r][b]=E[r][b]||function(){
      (E[r].q=E[r].q||[]).push(arguments)};b=m.getElementsByTagName(e)[0];m=m.createElement(e);
      m.async=1;m.src=("file:"==location.protocol?"https:":"")+"//s.reembed.com/G-1BYYQn.js";
      b.parentNode.insertBefore(m,b)})("reEmbed","script",window,document,"api");
    </script>
    <!-- /Diseño del reproductor de videos -->

    <!-- Smartsupp Live Chat script -->
<!--
    <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '1388fee2a7b9efb38a5ff5a6421028fdaa9c370f';
    window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='//www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
    </script>
-->
    <!-- End Smartsupp Live Chat script -->
</body>
</html>
<?php $this->endPage() ?>
