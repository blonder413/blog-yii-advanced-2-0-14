<?php
use app\models\Helper;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

setlocale(LC_TIME, 'es_CO.UTF-8');
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (isset($_GET['page'])) {
    $this->title = "Curso " . Html::encode("{$course->course}") . " - Página " . $_GET['page'] . " | Blonder413";
} else {
    $this->title = "Curso " . Html::encode("{$course->course}") . " | Blonder413";
}

$this->params['description'] = $course->description;

// parámetros para el sidebar
$this->params['categories'] = $categories;
$this->params['most_visited'] = $most_visited;

?>

<?= Breadcrumbs::widget([
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

    <div class="row">
        <br>
        <div class="col-sm-12 col-md-3">
            <?= Html::img(
                "/web/img/courses/$course->image",
                [
                    "alt"   => $course->course,
                    "class" => "img-responsive thumbnail"
                ]
            ) ?>
        </div>
        
        <div class="col-sm-12 col-md-9">
            <h2>Curso: <?= Html::encode("{$course->course}") ?></h2>
            <p>
                <?= $course->description ?>
            </p>
        </div>
    </div>
    
    <div class="row">
        
        <?php foreach ($articles as $key => $value): ?>
        <article class="clear-fix">
            <div>
                <?= Html::a(
                    Html::encode("{$value->number}") . " - " . Html::encode("{$value->topic}"),
                    [
                        "/articulo/" . Html::encode("{$value->slug}")
                    ],
                    [
                        "class" => "course-title",
                        'title' => Html::encode("{$value->topic}"),
                    ]
                ) ?>

            </div>
        </article>
        <?php endforeach; ?>
    </div>
    
    <div class="row text-center"><?php echo LinkPager::widget(['pagination'=>$pagination]); ?></div>
    
    <?php
    if ($pagination->totalCount < 15) {
        $marginTop = "1em";
    } else {
        $marginTop = 0;
    }
    ?>

    <div class="row" style="margin-top: <?= $marginTop; ?>">
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
            <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $course->course; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $course->course; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
            <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $course->course; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $course->course; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
            <a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $course->slug; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $course->course; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>
            <a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $course->course; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $course->course; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/linkedin.png" border="0" alt="LinkedIn"/></a>
            <a href="https://api.addthis.com/oexchange/0.8/forward/delicious/offer?url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $course->course; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $course->course; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/delicious.png" border="0" alt="Delicious"/></a>
            <a href="https://www.addthis.com/bookmark.php?source=tbx32nj-1.0&v=300&url=http%3A%2F%2Fwww.blonder413.com%2Farticulo%2F<?= $course->course; ?>&pubid=ra-55d90fcb1d66e601&title=<?= $course->course; ?>&nbsp;|&nbsp;Blonder413" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/addthis.png" border="0" alt="Addthis"/></a>
    -->

        <?= \imanilchaudhari\rrssb\ShareBar::widget([
          'title' => "Curso: " . $course->course . " | Blonder413", // i.e. $model->title
          'media' => '@web/web/img/' . $course->image, // Media Content
          'networks' => [
              'Facebook',
              'Twitter',
              'GooglePlus',
              'Email',
              'LinkedIn',
              'Pinterest',
              'Pocket',
              'Tumblr',
              'Github',
              'Reddit',
              //'Hackernews',
              //'Vk',
              //'Youtube'
          ]
        ]); ?>

        </div>
    </div>
    
    <div class="row">
        <hr>
        <h3>Otros cursos que podría interesarle</h3>
        <?php foreach($courses as $key => $value): ?>
            <div class="col-sm-12 col-md-12">
                <div class="col-sm-12 col-md-4">
                    <?= Html::a(
                        Html::img(
                            "@web/web/img/courses/$value->image",
                            [
                                // 'class' => 'img-circle',
                                'alt'   => $value->course,
                                'class' => 'img-thumbnail',
                            ]
                        ),
                        "@web/curso/$value->slug",
                        [
    //                        'target'    => '_blank',
    //                        'rel'       => 'nofollow',
                            'title' => $value->description,
                        ]
                    ) ?>
                </div>
                <div class="col-sm-12 col-md-8">
                    <h3><?= $value->course ?></h3>
                    <p><?= $value->description ?></p>
                    <p>
                        <?= Html::a(
                                'Ver Curso', 
                                ["/curso/$value->slug"], 
                                ['title' => 'Ver todos los capítulos del curso', 'class' => 'btn btn-primary']
                        ); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div>
        <br><br>
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
    
    <div class="clear-fix"></div>
    <div class="row">
        <div class="col-sx-12 col-sm-12 col-md-12">
            <div>
                <!-- Facebook Comments -->
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
                            <div class="fb-comments" data-href="<?php echo $url; ?>" data-width="100%"></div>
                        </div>
                        
                    </div>
                </div>
                <!-- End Facebook Comments -->
            </div>
        </div>
    </div>