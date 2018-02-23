<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use branchonline\lightbox\Lightbox;

/* @var $this yii\web\View */
$this->title = 'Acerca';
$this->params['breadcrumbs'][] = $this->title;

// parámetros para el sidebar
$this->params['categories'] = $categories;
$this->params['most_visited'] = $most_visited;
?>

<?php
$script = <<< JS

JS;
$this->registerJs($script);
?>


    <div class="row text-center">
        <h1><?= Html::encode($this->title) ?></h1>

    <figure>
        <p class="text-center">

            <?php
            echo Lightbox::widget([
                'files' => [
                    [
                        'thumb' => 'img/foto_thumbnail.jpeg',
                        'original' => 'img/foto.jpeg',
                        'title' => 'Jonathan Morales Salazar',
                    ],
                ]
            ]);

            /*
            Modal::begin([
                'header' => Html::img(
                    '@web/web/img/photo.jpg',
                        [
                            'alt'           => 'Jonathan Morales Salazar',
                            'title'         => 'Jonathan Morales Salazar',
                        ]
                    ),
                'toggleButton' =>   ['label' =>
                                        Html::img(
                                            '@web/web/img/photo.jpg',
                                            [
                                                'alt'           => 'Jonathan Morales Salazar',
                                                'title'         => 'Jonathan Morales Salazar',
                                                'width'         => '300',
                                            ]
                                        ),
                                    ],
            ]);

            echo '<p>Jonathan Morales Salazar</p>';
            echo '<p>Ingeniero de Sistemas</p>';

            Modal::end();
            */
            ?>
        </p>
        <figcaption>
            <p>
            <div class="vcard">
                <div class="fn n">
                    <span class="given-name">Jonathan</span> <span class="family-name">Morales Salazar</span><br />
                    <!-- <span class="org">El Ejemplo S. A.</span> -->
                </div>
                <div>
                    <span class="nickname">Blonder413</span>
                </div>
                <div class="adr">
                <!-- <span class="street-address">Calle falsa 1</span><br /> -->
                    <span class="locality" title="La Dorada">La Dorada</span>,
                    <abbr class="region" title="Caldas">Caldas</abbr>,
                    <!-- <span class="postal-code">94301</span>, -->
                    <abbr class="country-name" title="Colombia">Colombia</abbr>
                </div>
                <!-- <li class="tel"><strong class="type" title="Teléfono del trabajo">Work</strong>: <span class="value">604-555-1234</span></li> -->
                    <!-- <li class="url"><strong class="type" title="Sitio web oficial del trabajo">Work</strong>: <a href="http://ejemplo.com/" title="Ejemplo.com" class="value">http://ejemplo.com/</a></li> -->
            </div>
            <span class="negrita">Edad</span>: 32 años
            <br />
            <span class="negrita">Ocupación</span>: Ingeniero de Sistemas
            </p>
        </figcaption>
    </figure>
    <h3>Otros títulos</h3>
    <ul class="list-style-none">
        <li>
            Emprendimiento Empresarial
        </li>
        <li>
            Programación de páginas Web con HTML y Javascript
        </li>
        <li>
            Linux: Sistema Operativo, comandos y utilidad
        </li>
    </ul>

    <h3>Software utilizado para el desarrollo</h3>
    <ul class="list-style-none">
        <li>
            <a href="http://www.activestate.com/komodo-ide" title="Komodo IDE" target="_blank">
                Komodo Edit
            </a>
        </li>
        <li>
            <a href="http://www.mozilla.org/es-ES/firefox/fx/" title="AMozilla Firefox" target="_blank">
                Mozilla Firefox
            </a>
        </li>
        <li>
            <a href="http://filezilla-project.org/" title="Filezilla" target="_blank">
                Filezilla
            </a>
        </li>
        <li>
            <a href="http://www.lamphowto.com/" title="LAMP" target="_blank">
                LAMPP
            </a>
        </li>
        <li>
            <a href="http://www.gimp.org/" title="GIMP" target="_blank">
                Gimp
            </a>
        </li>
        <li>
            <a href="http://inkscape.org/" title="Inkscape" target="_blank">
                inkscape
            </a>
        </li>
    </ul>

    <hr>
    <div class="row">
        <div class="col col-xs-12 col-md-6">
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer>
              {lang: 'es-419'}
            </script>

            <!-- Place this tag where you want the widget to render. -->
            <div class="g-page" data-href="//plus.google.com/u/0/114140664117985392477" data-rel="publisher"></div>
        </div>
        <div class="col col-xs-12 col-md-6">
            <!-- Place this tag where you want the widget to render. -->
            <div class="g-community" data-href="https://plus.google.com/communities/104747714155968688815"></div>

            <!-- Place this tag after the last widget tag. -->
            <script type="text/javascript">
              window.___gcfg = {lang: 'es-419'};

              (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/platform.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
              })();
            </script>
        </div>
    </div>
    <hr>

    <iframe width="700" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?ie=UTF8&amp;t=h&amp;ll=5.459905,-74.660339&amp;spn=0.041012,0.054932&amp;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/?ie=UTF8&amp;t=h&amp;ll=5.459905,-74.660339&amp;spn=0.041012,0.054932&amp;z=14&amp;source=embed" style="color:#0000FF;text-align:left" target='_blank'>Ver mapa más grande</a></small>

    </div>
