# Sonsuz Kaydırma
Php ve jQuery kullanarak nasıl sonsuz kaydırma yapılır.
  jQuery'de değişkenlerin kullanımı, ajax methodu ve fonksiyon kullanımı anlatıldı.
```js
 $(document).ready(function() {

      var durum = "aktif";
      var baslangic = 0;
      var son = 4;

      function snszkydr(son, baslangic) {
        $.ajax({
          url: "http://localhost/",
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
```
