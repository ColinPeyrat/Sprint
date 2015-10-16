<?php  
$game = $data[0];
$photos = null;
$movie =null;
$advices = null;
$nbAdvice = 0;
$adviceGlobal = 0;
if(!(empty($data[1]))){
    $photos = $data[1];
}
if(!(empty($data[2]))){
    $movie = $data[2][0]; 
}
if(!(empty($data[3]))){

    $advices = $data[3];
    $adviceTotal = 0;
    $nbAdvice = count($advices);
    $adviceGlobal = 0.0;
    foreach ($advices as $key => $advice) {
        $adviceTotal += $advice->avi_note;
    }
    $adviceGlobal = $adviceTotal/$nbAdvice;


}
?>
        <div class="thumbnail">
            <div class="row">
              <div class="col-md-5">
            <?php if(!empty($photos)){ ?>
        
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                  </ol>

                <div class="carousel-inner" role="listbox">
                <?php foreach ($photos as $key => $photo) { ?>

                    <?php if ($key == 0) { ?>

                        <div class="item active">
                          <img src="<?= $photo->pho_url ?>" class="tales img-responsive" alt="<?= $game->jeu_nom ?>">
                        </div>

                    <?php } else { ?>

                        <div class="item">
                          <img src="<?= $photo->pho_url ?>" class="tales img-responsive" alt="<?= $game->jeu_nom ?>">
                        </div>

                    <?php } ?>
                <?php } ?>
                </div>
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Précedente</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Suivante</span>
              </a>
            </div>
            <?php } ?>
        </div>
    <div class="col-md-7">
            <div class="caption-full">
                <h4 class="pull-right"><?= $game->jeu_prixttc ?> €</h4>
                <h4><?= $game->jeu_nom ?>
                </h4>
                <p><?php if(!empty($game->jeu_description)){echo $game->jeu_description;} else {echo "<h5>Pas de description pour ce jeu</h5>";} ?></p>
            </div>
        </div>
    </div>
            <?php if(!empty($movie)){ ?>
            <hr>
            <div class="row">
             <div class="col-md-8 col-md-offset-2">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?= $movie->vid_url ?>"></iframe>
                </div>
            </div>
            </div>
            <hr>
            <?php } ?>
            <div class="ratings">
                <p class="pull-right"><?= $nbAdvice ?> avi(s)</p>
                <p>
                    Note moyenne : 
                    <?= round($adviceGlobal,1) ?> /5
                </p>
            </div>
        </div>

        <div class="well">

            <div class="text-right">
                <a class="btn btn-success">Deposer un avis</a>
            </div>

            <hr>
            <?php if(!empty($advices)) { ?>
                <?php foreach ($advices as $key => $advice){ ?>
                <?php
                $star = null;
                for ($i = 0; $i <= 5; $i++) {
                        $stars[$i] = "<span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span>";
                    }
                    //remplis les étoiles vides selon la note
                for ($i = 0; $i < $advice->avi_note; $i++) {
                        $stars[$i] = "<span class='glyphicon glyphicon glyphicon-star' aria-hidden='true'></span>";
                    }
                for ($i = 0; $i < 5; $i++) {
                        $star .= $stars[$i];
                    }
                ?>
                    <div class="row">
                    <div class="col-md-12">
                        <?php echo $star."  ".$advice->T_E_CLIENT_CLI->cli_pseudo ?>
                        
                        <span class="pull-right"><?= date("d/m/Y", strtotime($advice->avi_date)) ?></span>
                        <p><?= $advice->avi_detail ?></p>
                    </div>
                </div>
                <hr>
                <?php } ?>
            <?php } ?>

        </div>  
