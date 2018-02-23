<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'En Vivo';
$this->params['breadcrumbs'][] = $this->title;

$this->params['description'] = "Clases en vivo y charlas sobre temas referentes a la informática";

// parámetros para el sidebar
$this->params['categories'] = $categories;
$this->params['most_visited'] = $most_visited;
?>

    <div class="row text-center">
        <h1><?= Html::encode($this->title) ?></h1>
        
        <?php if ($streaming): ?>
            <h2><?= Html::encode($streaming->title); ?></h2>
            <div class="video-responsive">
                <?= $streaming->embed ?>
            </div>
            
            <p><?= $streaming->description ?></p>
        <?php else: ?>

            <?php if ($next_streaming): ?>
                <h2>Próxima transmisión</h2>
                <p><small><?= $next_streaming->start ?></small></p>
                <p>
                    <strong><?= $next_streaming->title ?></strong>: <?= $next_streaming->description ?>
                </p>

                <?php if (!empty($next_streaming->embed)): ?>
                    <div class="video-responsive">
                        <?= $next_streaming->embed; ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
            
                <p>En estos momentos no estamos transmitiendo, pero puede disfrutar de alguna de nuestras transmisiones anteriores.</p>

                <?php if (!empty($articles[0]->video)): ?>
                    <div class="video-responsive">
                        <?= $articles[0]->video; ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

            <p>A continuación otras transmisiones que podrían interesarle.</p>

            <ul>
                <?php foreach ($articles as $key => $value): ?>
                    <li class="list-style-none">
                        <?=
                        Html::a(
                                $value->title, [
                            '/articulo/' . $value->slug
                                ], [
                            'title' => $value->title,
                                ]
                        )
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        
        <?php endif; ?>
    </div>
    <div class="clear-fix"></div>
    <div class="row">
        <div class="col-sx-12 col-sm-12 col-md-12">
            <div>
                <!-- Facebook Comments -->
                <!--
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
                            <div class="fb-comments" data-href="http://www.blonder413.com/en-vivo" data-width="100%"></div>
                        </div>
                    </div>
                </div>
                -->
                <!-- End Facebook Comments -->
                
                <!-- Disqus comments -->
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
                <!-- /Disqus comments -->                                    
            </div>
        </div>
    </div>

<script id="dsq-count-scr" src="//blonder413-com.disqus.com/count.js" async></script>