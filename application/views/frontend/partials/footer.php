</div>
<script src="<?php echo base_url( 'assets/frontend/js/jquery-3.3.1.min.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/jquery-migrate-3.0.1.min.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/jquery-ui.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/popper.min.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/bootstrap.min.js' ); ?>"></script>

<script src="<?php echo base_url( 'assets/frontend/js/owl.carousel.min.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/jquery.stellar.min.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/jquery.countdown.min.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/jquery.magnific-popup.min.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/bootstrap-datepicker.min.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/aos.js' ); ?>"></script>
<script src="<?php echo base_url( 'assets/frontend/js/rangeslider.min.js' ); ?>"></script>

<script src="<?php echo base_url( 'assets/frontend/js/main.js' ); ?>"></script>
<!-- openstreetmap leaflet js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="<?php echo base_url( 'assets/frontend/js/star.js' ); ?>"></script>
<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet"></script>

<!-- Esri Leaflet Geocoder -->
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css">
<script src="https://unpkg.com/esri-leaflet-geocoder"></script>
<script>
    <?php
        if (isset($item)) {
            $lat = $item->lat;
            $lng = $item->lng;
    ?>
            var itm_map = L.map('itm_location').setView([<?php echo $lat;?>, <?php echo $lng;?>], 5);
    <?php
        } else {
    ?>
            var itm_map = L.map('itm_location').setView([0, 0], 5);
    <?php
        }
    ?>

    const itm_attribution =
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
    const itm_tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    const itm_tiles = L.tileLayer(itm_tileUrl, { itm_attribution });
    itm_tiles.addTo(itm_map);
    <?php if(isset($item)) {?>
        var itm_marker = new L.Marker(new L.LatLng(<?php echo $lat;?>, <?php echo $lng;?>));
        itm_map.addLayer(itm_marker);
        // results = L.marker([<?php echo $lat;?>, <?php echo $lng;?>]).addTo(mymap);

    <?php } else { ?>
        var itm_marker = new L.Marker(new L.LatLng(0, 0));
        //mymap.addLayer(marker2);
    <?php } ?>
    var itm_searchControl = L.esri.Geocoding.geosearch().addTo(itm_map);
    var results = L.layerGroup().addTo(itm_map);

    itm_searchControl.on('results',function(data){
        results.clearLayers();

        for(var i= data.results.length -1; i>=0; i--) {
            itm_map.removeLayer(itm_marker);
            results.addLayer(L.marker(data.results[i].latlng));
            var itm_search_str = data.results[i].latlng.toString();
            var itm_search_res = itm_search_str.substring(itm_search_str.indexOf("(") + 1, itm_search_str.indexOf(")"));
            var itm_searchArr = new Array();
            itm_searchArr = itm_search_res.split(",");

            document.getElementById("lat").value = itm_searchArr[0].toString();
            document.getElementById("lng").value = itm_searchArr[1].toString(); 
           
        }
    })
    var popup = L.popup();

    function onMapClick(e) {

        var itm = e.latlng.toString();
        var itm_res = itm.substring(itm.indexOf("(") + 1, itm.indexOf(")"));
        itm_map.removeLayer(itm_marker);
        results.clearLayers();
        results.addLayer(L.marker(e.latlng));   

        var itm_tmpArr = new Array();
        itm_tmpArr = itm_res.split(",");

        document.getElementById("lat").value = itm_tmpArr[0].toString(); 
        document.getElementById("lng").value = itm_tmpArr[1].toString();
    }

    itm_map.on('click', onMapClick);
</script>
    
  </body>
</html>