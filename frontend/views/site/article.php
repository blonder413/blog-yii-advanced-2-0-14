<?php
use yii\helpers\Html;
use kartik\alert\AlertBlock;
use kartik\growl\Growl;

$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$this->title = $article->title . " | Blonder413";

//setlocale(LC_ALL, 'spa_ES');
//setlocale(LC_TIME, 'spa_ES');
//setlocale(LC_TIME, 'spl_ES');
//setlocale(LC_TIME, 'Spanish_Colombia');
setlocale(LC_TIME, 'es_CO.UTF-8');

// $date = date("l, M j \d\e Y G:i", strtotime($article->created_at))
// http://php.net/manual/es/function.strftime.php
$date = strftime("%c", strtotime($article->created_at));
//$date = strftime("%A %e %B de %Y %R", mktime(strtotime($article->created_at)));

// $dateTime = new DateTime();
// $dateTime->setTimeZone(new DateTimeZone('America/Bogota'));
// $date = $dateTime->format('l, M j \d\e Y G:i');

$this->registerMetaTag(['name' => 'keywords', 'content' => $article->tags]);
$this->registerMetaTag(['name' => 'description', 'content' => $article->abstract]);

$this->params['description'] = $article->abstract;

// parámetros para el sidebar
$this->params['categories'] = $categories;
$this->params['most_visited'] = $most_visited;

$this->params['breadcrumbs'][] = ['label' => $article->category->category, 'url' => ['categoria/' . $article->category->slug]];
$this->params['breadcrumbs'][] = $article->title;
?>

    <h1><?= $article->title; ?></h1>
    <p><small>
        <span class="glyphicon glyphicon-user">&nbsp;</span>
        <?= Html::a(ucwords($article->createdBy->name), 'https://plus.google.com/u/0/+JonathanMoralesSalazar', ['target' => '_blank', 'rel'=>'author']) ; ?>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <span class="glyphicon glyphicon-calendar">&nbsp;</span><?= $date ?>&nbsp;&nbsp;|&nbsp;&nbsp;
        <span class="glyphicon glyphicon-folder-close">&nbsp;</span> <?php echo Html::a($article->category->category, Yii::$app->homeUrl . "categoria/" . $article->category->slug) ; ?>&nbsp;&nbsp;
        |&nbsp;&nbsp;<span class="glyphicon glyphicon-eye-open">&nbsp;</span><?= $article->visit_counter ?> visitas
        
      <?php if (\Yii::$app->user->can("update-article")): ?>
        
        |&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil">&nbsp;</span>

        <?= Html::a('Update', ['article/update', 'id' => $article->id], []) ?>

      <?php endif; ?>
    </small></p>

    <?php
    $updated_at = strftime(date("Y-m-d H:i:s"), strtotime($article->updated_at));

    $diference = date_diff(
                    date_create(date("Y-m-d H:i:s")) ,
                    date_create($updated_at)
                );

    if ($diference->y >= 2):
    ?>
    <p class="alert alert-danger">
      <span class="glyphicon glyphicon-warning-sign"></span>
      Este artículo fue actualizado hace <?= $diference->y ?> años o más. Es probable que el contenido sea obsoleto
      o que la implementación sea diferente.
    </p>
    <?php endif; ?>

    <?= $article->detail; ?>

    <?php if (!empty($article->video)): ?>
    <div class="video-responsive">
        <?= $article->video; ?>
    </div>
    <?php endif; ?>

    <div class="col-sm-12">
        <div class="col-xs-4 text-center">
            <p>
                <?php if ($prevArticle): ?>
                    <?= Html::a(
                        "<span class='glyphicon glyphicon-fast-backward'>&nbsp;</span><span class='hidden-xs'>Capítulo Anterior</span>",
                        ["/articulo/$prevArticle->slug"],
                        [
                            'title' => $prevArticle->topic,
                        ]
                    ); ?>
                <?php endif; ?>
            </p>
        </div>

        <div class="col-xs-4 text-center">
            <p>
                <?php if ($course): ?>
                    <?= Html::a(
                        "<span class='glyphicon glyphicon-list'>&nbsp;</span><span class='hidden-xs'>Todos los capítulos</span>",
                        ["/curso/$course->slug"],
                        [
                            'title' => $course->course,
                        ]
                    ); ?>
                <?php endif; ?>
            </p>
        </div>

        <div class="col-xs-4 text-center">
            <p>
                <?php if ($nextArticle): ?>
                    <?= Html::a(
                        "<span class='hidden-xs'>Capítulo Siguiente&nbsp;</span><span class='glyphicon glyphicon-fast-forward'></span>",
                        ["/articulo/$nextArticle->slug"],
                        [
                            'title' => $nextArticle->topic,
                        ]
                    ); ?>
                <?php endif; ?>
            </p>
        </div>
    </div>

    <div class="col-sm-12">
        <p>
            <span class="glyphicon glyphicon-tags">&nbsp;Etiquetas:&nbsp;</span>
            <?php foreach ($tags as $key => $value): ?>
            <span class="badge">
                <?= Html::a($value, ["etiqueta/$value"]) ?>
            </span>
            <?php endforeach; ?>
        </p>
    </div>

    <div class="col-md-12">
        <div class="col-md-3">
            <?php if (!empty($article->download)): ?>
        
            <?= Html::a(
                "<span class='glyphicon glyphicon-floppy-save'></span> Descargar",
                // $article->download,
                'descarga/' . $article->slug,
                [
                    "class"     => "btn btn-primary btn",
                    // 'target'    => '_blank',
                    'title'     => 'Descargar',
                ]
            ) ?>
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <?= Html::a(
                "<i class='fa fa-file-o' aria-hidden='true'></i>&nbsp;Exportar",
                ['/pdf/' . $article->slug],
                [
                    'class'     => 'btn btn-primary btn',
                    'target'    => '_blank',
                    'title'     => 'Exportar a PDF',
                ]
            ) ?>
        </div>
        <div class="col-md-6">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_donations">
                <input type="hidden" name="business" value="blonder413@gmail.com">
                <input type="hidden" name="lc" value="ES">
                <input type="hidden" name="item_name" value="blonder413">
                <input type="hidden" name="no_note" value="0">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
                <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_donateCC_LG.gif" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
                <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <!--
        <a class="twitter-share-button"
                data-counturl="https://dev.twitter.com/web/tweet-button" data-count="horizontal">
              Tweet
            </a>
        <div class="fb-like"></div>
        -->
        <?php /*echo \ijackua\sharelinks\ShareLinks::widget(
            [
                'viewName' => '/site/shareLinks.php'   //custom view file for you links appearance
            ]
        );*/ ?>

        Compartir:
        <!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
<!--
        <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $article->slug; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $article->title; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
        <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $article->slug; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $article->title; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
        <a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $article->slug; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $article->title; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>
        <a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $article->slug; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $article->title; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/linkedin.png" border="0" alt="LinkedIn"/></a>
        <a href="https://api.addthis.com/oexchange/0.8/forward/delicious/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $article->slug; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $article->title; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/delicious.png" border="0" alt="Delicious"/></a>
        <a href="https://www.addthis.com/bookmark.php?source=tbx32nj-1.0&v=300&url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $article->slug; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $article->title; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/addthis.png" border="0" alt="Addthis"/></a>
-->

    </div>

    <div class="row">
        <div class="col-xs-12">
            <p></p>
            <!-- Google Adsense -->
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
            <!-- Google Adsense -->
        </div>
    </div>

    <div class="comment-post">
        <?php
        /*
        echo AlertBlock::widget([
            'type' => AlertBlock::TYPE_ALERT,
            'useSessionFlash' => true,
            'delay'     => 20000,
        ]);
        */

        if (Yii::$app->session->getFlash('success')) {
            echo Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'title' => 'Comentario registrado!',
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('success'),
                'showSeparator' => true,
                'delay' => 0,           // time before display
                'pluginOptions' => [
                    'placement' => [
                        'from' => 'top',
                        'align' => 'center',
                    ],
                    'showProgressbar' => false,
                    'timer' => 3000,    // screen time
                    
                ]
            ]);
        } elseif (Yii::$app->session->getFlash('error')) {
            echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'title' => 'Error al registrar el comentario!',
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('error'),
                'showSeparator' => true,
                'delay' => 0,           // time before display
                'pluginOptions' => [
                    'placement' => [
                        'from' => 'top',
                        'align' => 'center',
                    ],
                    'showProgressbar' => false,
                    'timer' => 3000,    // screen time
                ]
            ]);
        } elseif (Yii::$app->session->getFlash('download_error')) {
            echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'title' => 'Error de descarga!',
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => Yii::$app->session->getFlash('download_error'),
                'showSeparator' => true,
                'delay' => 0,           // time before display
                'pluginOptions' => [
                    'placement' => [
                        'from' => 'top',
                        'align' => 'center',
                    ],
                    'showProgressbar' => false,
                    'timer' => 3000,    // screen time
                ]
            ]);
        }

        ?>

        <h2>Comentar</h2>

        <?php echo $this->render('/comment/_form', [
                'model' => $comment,
        ]) ?>

        <a name="comments"></a>
        
        <h2>Comentarios</h2>

        <!-- listado de comentarios -->
        <ul class="item-comment">
        <?php foreach ($article->comments as $key => $value): ?>
            <?php if($value->status == 1): ?>
            <li>
                <span class="item-comment-name">
                    <span class="glyphicon glyphicon-user">&nbsp;</span>&nbsp;
                    <?php
                    if (empty($value->web)) {
                        echo Html::encode("{$value->name}");
                    } else {
                        echo Html::a(
                            Html::encode("{$value->name}"),
                            Html::encode("{$value->web}"),
                            [
                                'target'    => '_blank',
                                'rel'       => $value->rel,
                                'title'     => Html::encode("{$value->web}"),
                            ]
                        );
                    }
                    ?>
                </span>
                &nbsp;
                <span class="glyphicon glyphicon-calendar">&nbsp;</span><?php echo strftime("%c", strtotime($value->date)); ?>
                <p><?php echo Html::encode("{$value->comment}"); ?></p>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
        <!-- fin listado de comentarios -->
        
        <!-- comentarios de facebook -->
        <!-- BORRAR ESTA LÍNEA
        <div class="row">
            <div class="col-sx-12 col-sm-12 col-md-12">
                <div>
                    <div class="row box style1 ">
                        <div class='12u'>
                            <div id="fb-root"></div>
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id))
                                        return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class='facebookComments'>
                                <div class="fb-comments" data-href="http://www.blonder413.com/articulo/<?= $article->slug?>" data-width="100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /comentarios de facebook -->
        
        <!-- Disqus comments -->
<!--  ----------------------------------------------- BORRAR ESTA LÍNEA -------------------------------------
        <div id="disqus_thread"></div>
        <script>
                
        /**
            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */
        /*
        var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = '//blonder413-com.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

    </div>

<script id="dsq-count-scr" src="//blonder413-com.disqus.com/count.js" async></script>
        <!-- /Disqus comments --> 
