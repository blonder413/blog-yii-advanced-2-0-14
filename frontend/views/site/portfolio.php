<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Portafolio';
$this->params['breadcrumbs'][] = $this->title;

// parámetros para el sidebar
$this->params['categories'] = $categories;
$this->params['most_visited'] = $most_visited;
?>

    <div class="col-md-12">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <p>Estos son los desarrollos que he realizado.</p>
        
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <?= Html::a(
                    Html::img(
                        '@web/web/img/logo.png',
                        [
                            // 'class' => 'img-circle',
                            'alt'   => 'Cilgas',
                            'class' => 'img-thumbnail',
                        ]
                    ),
                    'https://www.facebook.com/ce.ltda',
                    [
                        'target'    => '_blank',
                        'rel'       => 'nofollow',
                    ]
                ) ?>
                <h3>Ce Ase Ingeniería</h3>
                <p>Sistema de Control de entrega de elementos de protección personal para la empresa Cilgas.</p>
            </div>
            
            <div class="col-sm-12 col-md-4">
                <?= Html::a(
                    Html::img(
                        '@web/web/img/logo.png',
                        [
                            // 'class' => 'img-circle',
                            'alt'   => 'Diócesis La Dorada - Guaduas',
                            'class' => 'img-thumbnail',
                        ]
                    ),
                    'http://www.diocesisdeladoradaguaduas.org/',
                    [
                        'target'    => '_blank',
                        'rel'       => 'nofollow',
                    ]
                ) ?>
                <h3>Diócesis La Dorada - Guaduas</h3>
                <p>Implementación del sistema dinámico para la publicación de noticias.</p>
            </div>
            
            <div class="col-sm-12 col-md-4">
                <?= Html::a(
                    Html::img(
                        '@web/web/img/logo.png',
                        [
                            // 'class' => 'img-circle',
                            'alt'   => 'Alcaldía La Dorada',
                            'class' => 'img-thumbnail',
                        ]
                    ),
                    'http://ladorada-caldas.gov.co/',
                    [
                        'target'    => '_blank',
                        'rel'       => 'nofollow',
                    ]
                ) ?>
                <h3>Alcaldía La Dorada</h3>
                <p>Desarrollo del Sistema de Información de contratación pública para la Alcaldía de La Dorada.</p>
            </div>
        </div>
        <div class="row">
            
            <div class="col-sm-12 col-md-4">
                <?= Html::a(
                    Html::img(
                        '@web/web/img/logo.png',
                        [
                            // 'class' => 'img-circle',
                            'alt'   => 'Midas Ingeniería',
                            'class' => 'img-thumbnail',
                        ]
                    ),
                    'http://midasingenieria.com/',
                    [
                        'target'    => '_blank',
                        'rel'       => 'nofollow',
                    ]
                ) ?>
                <h3>Midas Ingeniería</h3>
                <p>Desarrollo del Sitio web oficial de la empresa Midas Ingeniería.</p>
            </div>
            
            <div class="col-sm-12 col-md-4">
                <?= Html::a(
                    Html::img(
                        '@web/web/img/logo.png',
                        [
                            // 'class' => 'img-circle',
                            'alt'   => 'Directorio La Dorada Caldas',
                            'class' => 'img-thumbnail',
                        ]
                    ),
                    'http://www.directorioladorada.com/',
                    [
                        'target'    => '_blank',
                        'rel'       => 'nofollow',
                    ]
                ) ?>
                <h3>Directorio La Dorada Caldas</h3>
                <p>Desarrollo del sitio web que funciona como directorio de empresas locales de La Dorada Caldas.</p>
            </div>
            
            <div class="col-sm-12 col-md-4">
                <?= Html::a(
                    Html::img(
                        '@web/web/img/logo.png',
                        [
                            // 'class' => 'img-circle',
                            'alt'   => 'Blog Blonder413',
                            'class' => 'img-thumbnail',
                        ]
                    ),
                    'http://www.blonder413.com/',
                    [
                        'target'    => '_blank',
                        'rel'       => 'nofollow',
                    ]
                ) ?>
                <h3>Blog Blonder413</h3>
                <p>Desarrollo de mi blog personal.</p>
            </div>
            
        </div>
    </div>