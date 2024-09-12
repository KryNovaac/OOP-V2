<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ini Wm</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="index1.css">
    <style>
        .print-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-btn:hover {
            background-color: #0056b3;
        }

        
        @media print {
            body {
                color: #000;
                background-color: #fff;
                font-family: Arial, sans-serif;
            }
            header, nav, .print-btn, .h1{
                display: none; /* Hide header, nav, and print button */
            }
            .m1 {
                margin: 0;
                padding: 0;
            }
            h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }
            .m2 p {
                margin: 0;
                font-size: 16px;
            }
            form {
                display :none;
            }
            .m2 h2 {
                padding:auto;
                font-size: 20px;
            }}
    </style>
</head>
<body>
<header>
    <nav class="active" id="nav">
        <ul>
            <li><a class="actived" href="http://reyhunt.liveblog365.com/dataSiswaKry/">Data Siswa</a></li>
            <li><a class="van non" href="http://reyhunt.liveblog365.com/kasir/">Kasir</a></li>
            <li><a class="van non" href="http://reyhunt.liveblog365.com/FuelKry/">Fuel</a></li>
            <li><a class="van non" href="http://reyhunt.liveblog365.com/rentalMotor/">Rental</a></li>
        </ul>
        <button class="icon" id="toggle">
            <img class="line line1" src="kry.png" height="60px">
            <div class="line line2"></div>
        </button>
    </nav>
</header>
<div class="m1">
    <h1 class="h1">Oil Market</h1>
    <form action="index.php" method="post">
        <label for="jumlah_liter">Liter :</label>
        <input type="number" id="jumlah_liter" name="jumlah_liter" min="1" required>
        <br>
        <label for="tipe_bahan_bakar">Fuel :</label>
        <select id="tipe_bahan_bakar" name="tipe_bahan_bakar" required>
            <option value="shell_super">Shell Super</option>
            <option value="shell_v_power">Shell V-Power</option>
            <option value="shell_v_power_diesel">Shell V-Power Diesel</option>
            <option value="shell_v_power_nitro">Shell V-Power Nitro</option>
        </select>
        <br><br>
        <button class="a satu" type="submit">Beli</button>
    </form>
    <div class="m2">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jumlah_liter']) && isset($_POST['tipe_bahan_bakar'])) {
            $jumlah_liter = $_POST['jumlah_liter'];
            $tipe_bahan_bakar = $_POST['tipe_bahan_bakar'];

            class BahanBakar {
                protected $harga;
                protected $jumlah_liter;

                public function __construct($jumlah_liter) {
                    $this->jumlah_liter = $jumlah_liter;
                }

                public function hitungTotal() {
                    $total = $this->jumlah_liter * $this->harga;
                    $ppn = 0.10 * $total;

                    echo "<p>Total yang harus anda bayar Rp. <strong>" . number_format($total, 0, ',', '.') . "</strong></p>";
                    echo "<p>PPN 10%: Rp. " . number_format($ppn, 0, ',', '.') . "</p>";
                }
            }

            class ShellSuper extends BahanBakar {
                protected $harga = 15420;
            }

            class ShellVPower extends BahanBakar {
                protected $harga = 16130;
            }

            class ShellVPowerDiesel extends BahanBakar {
                protected $harga = 18310;
            }

            class ShellVPowerNitro extends BahanBakar {
                protected $harga = 16510;
            }

            $transaksi = null;

            switch ($tipe_bahan_bakar) {
                case 'shell_super':
                    $transaksi = new ShellSuper($jumlah_liter);
                    break;
                case 'shell_v_power':
                    $transaksi = new ShellVPower($jumlah_liter);
                    break;
                case 'shell_v_power_diesel':
                    $transaksi = new ShellVPowerDiesel($jumlah_liter);
                    break;
                case 'shell_v_power_nitro':
                    $transaksi = new ShellVPowerNitro($jumlah_liter);
                    break;
                default:
                    echo "<p>Jenis bahan bakar tidak dikenal.</p>";
                    break;
            }

            if ($transaksi) {
                echo "<center>";
                echo "<h2>Bukti Transaksi</h2>";
                echo "<p>Anda membeli bahan bakar minyak tipe <strong>" . ucwords(str_replace('_', ' ', $tipe_bahan_bakar)) . "</strong></p>";
                echo "<p>Dengan jumlah: <strong>" . $jumlah_liter . " Liter</strong></p>";
                $transaksi->hitungTotal();
                echo '
                <button class="print-btn" onclick="window.print()">Cetak Bukti Transaksi</button>';
                echo "</center>";
            }
        }
        ?>
    </div>
</div>
<script src="js.js"></script>
</body>
</html>
