<?php
use yii\helpers\Html;
$this->title = 'Página no encontrada';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clearfix"><p></p></div>

<div class="row">
    <div class="alert alert-danger text-center">
        <?= Html::img(
            '@web/web/img/monker.png',
            [
                'alt'   => 'Página No Encontrada'
            ]
        ) ?>
        <h2><?= nl2br(Html::encode($message)) ?></h2>
        <p>
            Ha encontrado a <strong>Monker</strong>, lo que significa que al igual que él usted se encuentra perdido.
            <br>
            Si ha accedido desde un enlace de este sitio, por favor envíeme un correo indicando el enlace erróneo para corregirlo.
            <br>
            Si ha accedido desde un enlace externo, probablemente se deba al cambio de direcciones,
            por favor use el buscador para encontrar lo que desea o navegue a través del menú superior.
        </p>
    </div>
</div>
