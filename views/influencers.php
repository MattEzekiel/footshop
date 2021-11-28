<?php
/**
 * @var App\Models\Influencer[] $influencers
 */

use App\Router;

?>
<main class="container py-3">
    <h2 class="text-uppercase">Influencers</h2>
    <p class="text-white">Ellos confían en nosotros</p>
    <div class="row d-flex flex-wrap justify-content-around">
        <?php
            foreach ($influencers as $influencer):
        ?>
        <div class="my-3 cartas <?= $influencer->getImgAlt() ;?>">
            <img class="img-fluid" src="<?= Router::urlTo('/imgs/influencers/') . $influencer->getImg() ;?>" alt="<?= $influencer->getImgAlt() ;?>">
            <div class="content">
                <h3 class="text-uppercase"><?= $influencer->getNombre() ;?></h3>
                <p class="text-white mt-4 px-3"><?= $influencer->getOficio() ;?></p>
            </div>
        </div>
        <?php
            endforeach;
        ?>
    </div>
</main>
