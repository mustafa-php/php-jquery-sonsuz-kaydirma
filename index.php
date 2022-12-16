<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sonsuz Kaydırma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  <style>
    ::-webkit-scrollbar-track {
      background-color: transparent;
    }

    ::-webkit-scrollbar {
      width: 5px;
      background-color: #231412;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #feba3a;
      filter: blur(2px);
    }

    body {
      background: #231412;
      color: #ffffff;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .card {
      flex: 0 0 auto;
      margin: 1rem 0;
      background: #352320;
    }

    .img-fluid {
      height: 100%;
      width: 100%;
      object-fit: cover;
    }
  </style>
  <div class="gvd">
    <?php
    try {

      $_deneme = new PDO("mysql:host=localhost;dbname=deney", "root", "");
    } catch (PDOException $e) {
      print $e->getMessage();
    }

    if (isset($_POST["bslng"], $_POST["son"])) {
      $bslng = $_POST["bslng"];
      $son = $_POST["son"];

      $iller = $_deneme->prepare("SELECT * FROM İller limit $bslng, $son ");
      $iller->execute();

      $illercekiliyor = $iller->fetchAll(PDO::FETCH_OBJ);
      if ($iller->rowCount() > 0) {
        foreach ($illercekiliyor as $il) {
    ?>
          <div class="card mb-3" style="max-width: 600px">
            <div class="row g-0">
              <div class="col-md-6">
                <img src="/ornek/img/snszkydrm/<?php echo $il->isim; ?>.jpg" class="img-fluid rounded-start" alt="..." />
              </div>
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $il->isim; ?></h5>
                  <p class="card-text">
                    <?php echo $il->acklm; ?>
                  </p>
                  <p class="card-text">
                    <small class="text-muted">Türkiye/<?php echo $il->isim; ?></small>
                  </p>
                </div>
              </div>
            </div>
          </div>
        <?php }
      } else {
        ?>
        <div class="text-center m-5">
          <h3>Daha Fazla yok</h3>
        </div>

    <?php
      }
    }
    ?>
  </div>

  <script>
    $(document).ready(function() {

      var durum = "aktif";
      var baslangic = 0;
      var son = 4;

      function snszkydr(son, baslangic) {
        $.ajax({
          url: "https://mustafa/",
          type: "POST",
          data: {
            bslng: baslangic,
            son: son,
          },
          cache: false,
          success: function(veri) {
            setTimeout(function() {
              var card = $(veri).find(".card");
              var cardsayi = $(veri).find(".card").length;
              $("body").append(card);
              if (cardsayi == 0) {
                durum = 'aktfdgl';
                $("body").append('<div class="text-center m-5"><h3>Daha Fazla yok</h3></div>');

              } else {
                durum = "aktif";
              }
            }, 1000);

          },
        });
      }

      if (durum == "aktif") {
        durum = "aktfdgl";
        snszkydr(son, baslangic);
      }

      $(window).scroll(function() {
        if (
          $(window).scrollTop() + $(window).height() + 500 >
          $("body").height() &&
          durum == "aktif"
        ) {
          durum = "aktfdgl";
          baslangic = baslangic + son;
          setTimeout(function() {
            snszkydr(son, baslangic);
          }, 100);
        }
      });
    });
  </script>
</body>

</html>
