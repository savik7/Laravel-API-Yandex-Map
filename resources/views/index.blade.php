<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="Keywords" content="Наш сайт">
  <meta name="yandex-verification" content="Ваш ключ" />
  <link rel="icon" type="image/svg+xml" href="{{asset("favicon.svg")}}">
  <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(90387088, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/90387088" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

  <script type="text/javascript">
  ymaps.ready(init);
  var myMap;

  function init () {
    // Данные о местоположении, определённом по IP
    var geolocation = ymaps.geolocation,
    // координаты
    coords = [geolocation.latitude, geolocation.longitude],
    myMap = new ymaps.Map("map", {
      center: coords,
      zoom: 8,
      type: 'yandex#hybrid',
    }, {
      balloonMaxWidth: 200
    }, {
      searchControlProvider: 'yandex#search'
    });

    myMap.controls.add(new ymaps.control.MapTools());
    myMap.controls.add(new ymaps.control.ZoomControl());
    myMap.controls.add(new ymaps.control.ScaleLine());

    var myCollection = new ymaps.GeoObjectCollection();
    @foreach($points as $point)
    var myPlacemark = new ymaps.Placemark([
      {{$point->point}}
    ], {
      balloonContentHeader: "{{$point->title}}",
      balloonContentBody: "{{$point->content}}",
      balloonContentFooter: "{{$point->name}}",
      hintContent: "{{$point->title}}, {{$point->created_at}}"
    }, {
      preset: 'islands#icon',
      iconColor: '#ff0000'
    });
    myCollection.add(myPlacemark);
    @endforeach
    myMap.geoObjects.add(myCollection);

    myMap.geoObjects.add(
      new ymaps.Placemark(
        coords,
        {
          // В балуне: страна, город, регион.
          balloonContentHeader: geolocation.country,
          balloonContent: geolocation.city,
          balloonContentFooter: geolocation.region
        }
      )
    );

    myMap.events.add('click', function (e) {
      if (!myMap.balloon.isOpen()) {
        var coords = e.get('coordPosition');
        myMap.balloon.open(coords, {
          //contentHeader:'Событие!',
          contentBody://'<p>Кто-то щелкнул по карте.</p>' +
          '<p>Скопируйте координаты:<br><br> ' + [
            coords[0].toPrecision(6),
            coords[1].toPrecision(6)
          ].join(', ') + '</p>',
          contentFooter:'<sup></sup>'
        });
      }
      else {
        myMap.balloon.close();
      }
    });

    //myMap.events.add('contextmenu', function (e) {
    //myMap.hint.show(e.get('coordPosition'), 'Кто-то щелкнул правой кнопкой');
    //});
  }
  </script>
  <title>Ваш сайт</title>
</head>
<body>

    <div class="">
      <div id="map" class="bg-primary p-2" style="width: 100%; height: 500px;"></div>
    </div>

  </body>
  </html>
