<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Parkir | Technical Test_Programmer_Osmond Giovanni Indyaputra</title>
        <style>
            .button {
                border-radius: 50%;
                border: none;
                color: white;
                padding: 32px 32px;
                margin: 4px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
            }
            .button:hover {
                background-color: gray;
            }
            .button1{                
                background-color: #4CAF50;
            }
            .button2{                
                background-color: #f44336;
            }
            .table{
                border: 0; 
                text-align: center;
            }
            .table td{
                padding-left: 50px;
            }
            .tiket{
                margin-top: 50px;
                padding-left: 10px;
                padding-right: 10px;
            }
            .grid{
                width: 90%;
                max-width: 900px;
                margin: 0 auto;
            }
            .col-33{
                width: 33.3%;
                float: left;
            }
        </style>
    </head>
    <body>
        <div class="grid col-33">
            <h2>User In View</h2>
            <form action="add.php">
                <table class="table">
                    <tr>
                        <td>Tombol Bantuan</td>
                        <td>Tombol Tiket</td>
                    </tr>
                    <tr>
                        <td><button class="button button2" type="button"></button></td>
                        <td><button class="button button1" type="submit"></button></td>
                    </tr>
                </table>  
            </form>
            <?php
            session_start();
            if (isset($_SESSION['id'])) {
                ?>
                <table class="tiket">
                    <tr>
                        <td style="font-size: 24px; text-align: center;" colspan="2">PARKING TICKET</td>
                    </tr>
                    <tr>
                        <td>ID Ticket: </td>
                        <td><?php echo $_SESSION['id'] ?></td>
                    </tr>
                    <tr>
                        <td>Time: </td>                    
                        <td><?php echo $_SESSION['jamMasuk'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><img src="download.png"></td>
                    </tr>
                </table>
                <?php
            }
            unset($_SESSION['id']);
            unset($_SESSION['jamMasuk']);
            ?>
            <a href="index.php">Refresh >></a>
        </div>
        <div class="grid col-33" style="background-color: #e9e8e8;">
            <h2>Admin View</h2>
            <form action="search.php" method="get">
                ID Ticket: <input type="text" name="idParkir" placeholder="Masukan ID Ticket">
                <input type="submit" value="Cari"> 
            </form>
            <br>

            <?php
            date_default_timezone_set('Asia/Jakarta');
            if (isset($_SESSION['idDataParkir'])) {
                ?>
            <form action="update.php">
                ID Ticket: <?php echo $_SESSION['idDataParkir'] ?>
                <input type="text" name="idDataParkir" value="<?php echo $_SESSION['idDataParkir'] ?>" hidden><br>
                Jam Masuk: <input name="jamMasukDataParkir" value="<?php echo $_SESSION['jamMasukDataParkir'] ?>"><br>   
                Jam Keluar: <input type="text" name="jamKeluarDataParkir" id="demo" value="<?php echo date('H:i:s'); ?>" placeholder="Masukan Jam Keluar"><br>
                Plat No: <input type="text" name="platNo" value="" placeholder="Masukan Plat No" required=""><br><br>            
                <input type="submit" value="Keluar Parkir">    
            <?php } 
            unset($_SESSION['idDataParkir']);?>
            </form>
            <table border="1" style="margin-top: 25px">
                <tr>
                    <th>ID Ticket</th>
                    <th>Plat No</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Biaya</th>
                </tr>    
                <?php
                $file = "database.json";
                $fileData = file_get_contents($file);
                $data = json_decode($fileData, true);
                foreach ($data as $d) :
                    ?>
                    <tr>
                        <td><?php echo $d['id']; ?></td>
                        <td><?php echo $d['platNo']; ?></td>
                        <td><?php echo $d['jamMasuk']; ?></td>
                        <td><?php echo $d['jamKeluar']; ?></td>
                        <td><?php echo $d['biaya']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="grid col-33">
            <h2>User Out View</h2>            
            <?php
            if (isset($_SESSION['price'])) {
            ?>
            <h1>Harga Parkir</h1>
            <h3>Plat No Kendaraan : <?php echo $_SESSION['plat']; ?></h3>
            <h3>Lama Parkir : <?php echo $_SESSION['time']; ?> jam</h3>
            <h2>Rp.<?php echo $_SESSION['price']; ?></h2>
            <?php
            }
            unset($_SESSION['price']);
            ?>
        </div>
    </body>
</html>