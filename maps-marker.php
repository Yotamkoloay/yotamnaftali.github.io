<!DOCTYPE html>
<html>

<head>
    <title>Google Maps API: Cara Menampilkan Lokasi dengan PHP dan MySQL</title>
    <script src="assets/js/jquery-1.10.1.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5XaBlZT1FmnO2BrQPFbySxZg32uA_XOw&callback=initialize" async defer></script>
    <script type="text/javascript"> </script>
    <script>
        var marker;

        function initialize() {
            // Variabel untuk menyimpan informasi lokasi
            var infoWindow = new google.maps.InfoWindow;
            //  Variabel berisi properti tipe map
            var mapOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            // Pembuatan map
            var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
            // Variabel untuk menyimpan batas kordinat
            var bounds = new google.maps.LatLngBounds();
            // Pengambilan data dari database MySQL
            <?php
            // Sesuaikan dengan konfigurasi koneksi Anda
            $host       = "localhost";
            $username = "root";
            $password = "";
            $Dbname   = "moba";
            $db       = new mysqli($host, $username, $password, $Dbname);

            $query = $db->query("SELECT a.id_bagan,a.latitude,a.id_user,a.longitude,a.lokasi,a.nama_bagan,b.id_jenis_bagan,b.jenis_bagan,c.id_user,c.id_tangkapan,c.nama_user,d.id_tangkapan,d.nama_tangkapan FROM bagan as a INNER JOIN jenis_bagan as b INNER JOIN users as c INNER JOIN tangkapan as d ON  b.id_jenis_bagan=a.id_jenis_bagan AND a.id_user=c.id_user AND c.id_tangkapan=d.id_tangkapan ORDER BY a.id_bagan ASC");
            while ($row = $query->fetch_assoc()) {
                $penjaga = $row["nama_user"];
                $lokasi = $row["lokasi"];
                $bagann = $row["nama_bagan"];
                $lat  = $row["latitude"];
                $long = $row["longitude"];
                $bagan = $row["jenis_bagan"];
                $tangkap = $row["nama_tangkapan"];
                echo "addMarker( $lat, $long, '<b> Nama : $bagann <br> Jenis : $bagan <br> Penjaga : $penjaga  <br> Tangkapan : $tangkap <br> Koordinat : <a href=https://www.google.com/maps/place/$lat,$long>$lat, $long </a> </b>' );\n";
            }
            ?>
            // Proses membuat marker 
            function addMarker(lat, lng, info) {
                var lokasi = new google.maps.LatLng(lat, lng);
                bounds.extend(lokasi);
                var marker = new google.maps.Marker({
                    map: map,
                    position: lokasi
                });
                // Add circle overlay and bind to marker
                var circle = new google.maps.Circle({
                    map: map,
                    // radius: 57.375, // 0.19125 miles in metres 307.78704
                    fillColor: '#F08080'
                });
                circle.bindTo('center', marker, 'position');
                map.fitBounds(bounds);
                bindInfoWindow(marker, map, infoWindow, info);
            }
            // Menampilkan informasi pada masing-masing marker yang diklik
            function bindInfoWindow(marker, map, infoWindow, html) {
                google.maps.event.addListener(marker, 'click', function() {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
            }
            // Pengambilan data dari database MySQL

            <?php
            // $query = $db->query("SELECT a.id_bagan,a.latitude,a.id_user,a.longitude,a.lokasi,a.nama_bagan,b.id_jenis_bagan,b.jenis_bagan,c.id_user,c.nama_user FROM bagan as a INNER JOIN jenis_bagan as b INNER JOIN users as c  ON  b.id_jenis_bagan=a.id_jenis_bagan AND a.id_user=c.id_user WHERE b.jenis_bagan='Bagan Tancap' ORDER BY a.id_bagan ASC");

            // while ($row = $query->fetch_assoc()) {
            //     $penjaga = $row["nama_user"];
            //     $lokasi = $row["lokasi"];
            //     $bagann = $row["nama_bagan"];
            //     $lat  = $row["latitude"];
            //     $long = $row["longitude"];
            //     $bagan = $row["jenis_bagan"];
            //     echo "addMarker( $lat, $long, '<b> Nama : $bagann <br> Jenis : $bagan <br> Penjaga : $penjaga  <br> Koordinat : <a href=https://www.google.com/maps/place/$lat,$long>$lat, $long</a> </b>');\n";
            // }

            ?>
            // Proses membuat marker 

        }
    </script>
</head>

<body>

    <div id="googleMap" style="width:100%;height:500px;"></div>

</body>

</html>