@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" />
    <title>Responsive Profile Page</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <!-- CSS -->
    <link rel="stylesheet" href="/css/DetailAgent/detailagent.css">
    <script src="/js/DetailAgent/detailagent.js" defer></script>
  </head>
  <body>
    <div class="header__wrapper2">
      <div class="img_detailagent"></div>
      <div class="cols__container">
        <div class="left__col">
          <div class="img__container">
            <img src="/assets/detail/home.jpg" alt="Bambang" />
            <span></span>
          </div>
          <h2>Fatih WIjaya</h2>
          <p style="color: #000">PT Taruna Wijaya</p>
          <p>bambangjono95@gmail.com</p>

          <ul class="about" style="">
            <li><span>3</span>Aktif</li>
            <li><span>3</span>Dijual</li>
            <li><span>3</span>Disewa</li>
          </ul>

          <div class="content">
            <p>Pengembangan proyek perumahan, ruko, apartemen, dan villa</p>

            <ul>
              <li><i class="fab fa-twitter"></i></li>
              <i class="fab fa-instagram"></i>
              <i class="fab fa-facebook"></i>
              <i class="fab fa-whatsapp"></i>
            </ul>
          </div>
        </div>
        <div class="right__col">
            <!-- Images Filter Buttons Section -->
            <div class=" row mt-5" >
              <div class="col-12" id="filter-buttons">
                <button class="btn mb-2 me-1 active" data-filter="all">Semua</button>
                <button class="btn mb-2 mx-1" data-filter="aktif">Aktif</button>
                <button class="btn mb-2 mx-1" data-filter="dijual">Dijual</button>
                <button class="btn mb-2 mx-1" data-filter="disewa">DIsewa</button>
              </div>
            </div>


            <!-- <button class="btn-ajukan mb-2 float-end" id="ajukan-button" style="margin-top: -43px; background-color: #0C40E8; color: #fff; cursor: auto;">Ajukan</button> -->

            
      
            <!-- Filterable Images / Cards Section -->
            <div class="card-detailagent row px-2 mt-4 gap-3" style="width: 770px; margin-bottom: 60px;" id="filterable-cards">
              <div class="card p-0" data-name="aktif">
                <img src="/assets/logo.svg" alt="img" />
                <div class="card-body">
                  <h6 class="card-title">Rumah</h6>
                  <!-- <p class="card-text"></p> -->
                </div>
                <span class="label sold">Tersewa</span>
              </div>
              
              
              <div class="card p-0" data-name="aktif">
                <img src="/assets/logo.svg" alt="img" />
                <div class="card-body">
                  <h6 class="card-title">Apartemen</h6>
                  <!-- <p class="card-text"></p> -->
                </div>
                <span class="label sold">Aktif</span>
              </div>
              <div class="card p-0" data-name="aktif">
                <img src="/assets/logo.svg" alt="img" />
                <div class="card-body">
                  <h6 class="card-title">Apartemen</h6>
                  <!-- <p class="card-text"></p> -->
                </div>
                <span class="label sold">Aktif</span>
              </div>
              <div class="card p-0" data-name="dijual">
                <img src="/assets/logo.svg" alt="img" />
                <div class="card-body">
                  <h6 class="card-title">Rumah</h6>
                  <!-- <p class="card-text"></p> -->
                </div>
                <span class="label sold">Terjual</span>
              </div>
              <div class="card p-0" data-name="dijual">
                <img src="/assets/logo.svg" alt="img" />
                <div class="card-body">
                  <h6 class="card-title">Apartemen</h6>
                  <!-- <p class="card-text"></p> -->
                </div>
                <span class="label sold">Tersewa</span>
              </div>
              <div class="card p-0" data-name="disewa">
                <img src="/assets/logo.svg" alt="img" />
                <div class="card-body">
                  <h6 class="card-title">Ruko</h6>
                  <!-- <p class="card-text"></p> -->
                </div>
                <span class="label sold">Terjual</span>
              </div>
              <div class="card p-0" data-name="disewa">
                <img src="/assets/logo.svg" alt="img" />
                <div class="card-body">
                  <h6 class="card-title">Villa</h6>
                  <!-- <p class="card-text"></p> -->
                </div>
                <span class="label sold">Tersewa</span>
              </div>
              <div class="card p-0" data-name="disewa">
                <img src="/assets/logo.svg" alt="img" />
                <div class="card-body">
                  <h6 class="card-title">Ruko</h6>
                  <!-- <p class="card-text"></p> -->
                </div>
                <span class="label sold">Terjual</span>
              </div>
            </div>
          </div>
        
        </div>
        
        
      </div>
  </body>
</html>


@endsection