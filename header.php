<header>
  <?php 
  if(isset($_GET['video'])){
    ?>
    <div style="position:relative;height:0;padding-bottom:56.25%"><iframe src="https://www.youtube.com/embed/nhkrSE4FSHM?ecver=2" style="position:absolute;width:100%;height:100%;left:0" width="640" height="360" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
    <?php
  }
  else {
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active">
          <img src="presentasi/Slide30.JPG" style="width: 100%; height: 101%">
          <div class="carousel-caption d-none d-md-block d-sm-block" align="right" style="text-align: right">
               <a href="?video"><button class="btn btn-info btn-sm alert-warning" role="alert"">Watch Video</button></a>
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item">
          <img src="presentasi/IBLA_win.jpg" style="width: 100%; height: 101%">
          <div class="carousel-caption d-none d-md-block d-sm-block" align="right" style="text-align: right">
               <a href="?video"><button class="btn btn-info btn-sm alert-warning" role="alert"">Watch Video</button></a>
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item">
          <img src="presentasi/Slide7.JPG" style="width: 100%; height: 101%">
          <div class="carousel-caption d-none d-md-block d-sm-block" align="right" style="text-align: right">
               <a href="?video"><button class="btn btn-info btn-sm alert-warning" role="alert"">Watch Video</button></a>
          </div>
        </div>         
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <?php
  }

  ?>
 
  
</header>