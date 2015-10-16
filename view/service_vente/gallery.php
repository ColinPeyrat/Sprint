<h1>Service vente</h1>
<div class="row">
  <div class="col-md-3">
  	<ul class="nav nav-pills nav-stacked">
	  <li role="presentation"><a href="./?r=srv/addphoto">Ajouter une photo</a></li>
	  <li role="presentation"><a href="./?r=srv/addvideo">Ajouter une video</a></li>
      <li role="presentation"><a href="./?r=srv/gallery">Voir la galerie</a></li>
	</ul>
  </div>
  <div class="col-md-9">
      <?php foreach($data as $k => $v): ?>
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title"><?php echo $v['nom'] ?></h3>
              </div>
              <div class="panel-body">
                  <h4>Photo</h4>
                  <?php
                  if(array_key_exists('pho_url',$v)): ?>
                  <div class="row">
                     <?php foreach($v['pho_url'] as $y => $z): ?>
                          <div class="col-xs-6 col-md-3">
                              <a href="#" class="thumbnail">
                                  <img src="<?php echo $z; ?>" alt="<?php echo $v['nom']; ?>">
                              </a>
                          </div>
                  <?php endforeach; ?>
                  </div>
                  <?php else:
                      echo "Pas de photo pour ce jeu";
                  endif; ?>
                  <h4>Video</h4>
                  <?php
                  if(array_key_exists('vid_url',$v)): ?>
                      <div class="row">
                          <?php foreach($v['vid_url'] as $y => $z): ?>
                              <div class="col-xs-6 col-md-4">
                                  <div class="embed-responsive embed-responsive-16by9">
                                      <iframe width="560" height="315" src="<?php echo $z; ?>" frameborder="0" allowfullscreen></iframe>
                                  </div>
                              </div>
                          <?php endforeach; ?>
                      </div>
                  <?php else:
                      echo "Pas de vidéo pour ce jeu";
                  endif; ?>
              </div>
          </div>
      <?php endforeach; ?>
  </div>
</div>