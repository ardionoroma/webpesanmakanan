<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMTI-08 RESTO</title>

    <!-- Bootstrap Core CSS, panggil bootstrap di assets -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts, panggil font-awesome di assets -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS, panggil css tema di assets -->
    <link href="<?php echo base_url(); ?>assets/css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">

                <!--Icon di menubar kiri bakal kembali ke home-->
                <a class="navbar-brand page-scroll" href="#">SMTI-08 RESTO</a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">DAFTAR PESANAN</h2>
                    <div class="row text-center">
                        <table style='width:80%'class='table table-bordered'>
                            <div>
                                <tr class='danger'>
                                    <th>No.</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                                <?php
                                if (!defined('BASEPATH')) {
                                    exit('No direct script access allowed');
                                }
                                $a = $this->db->query("SELECT * FROM pembeli WHERE status=5");
                                $no_urut = 1;
                                $total = 0;
                                foreach($a->result_array() as $b){
                                    $subtotal = 0;
                                ?>
                                <tr>
                                    <td><?php echo $no_urut ?>.</td>
                                    <?php
                                    if (!defined('BASEPATH')) {
                                        exit('No direct script access allowed');
                                    }
                                    $teks = "SELECT * FROM menu WHERE id_menu='".$b['id_menu']."'";
                                    $anu = $this->db->query($teks);
                                    foreach($anu->result_array() as $c){?>
                                        <td><?php echo $c['nama_menu']?></td>
                                        <td>Rp <?php echo $c['harga']?>,-</td>
                                    <?php } ?>
                                    <td><?php echo $b['jumlah']?></td>
                                    <?php $subtotal = $b['jumlah'] * $c['harga'];
                                    $total = $total + $subtotal; ?>
                                    <td>Rp <?php echo $subtotal ?>,-</td>
                                </tr>
                                <?php $no_urut+=1;
                            } ?>
                                <tr>
                                    <td colspan="4" style="text-align: right">Total Pemesanan</td>
                                    <td style="font-weight: bold">Rp <?php echo $total ?>,-</td>
                                </tr>
                            </div>
                        </table>
                        <?php echo form_open('Kasir/hapus', array('name' => 'hapus'))?>
                            <input type="submit" class="page-scroll btn btn-xl" name="submit" value="Pembayaran Selesai"/>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <?php include 'footer.html';?>
    </footer>

    

    <!-- jQuery, panggil jQuery di assets -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript, panggil javascript bootstrap di assets -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript, panggil javascript yang dibutuhkan di assets -->
    <script src="<?php echo base_url(); ?>assets/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/contact_me.js"></script>

    <!-- Theme JavaScript, panggil javascript tema di assets -->
    <script src="<?php echo base_url(); ?>assets/js/agency.min.js"></script>

    <!-- JavaScript Tombol Increment & Decrement di /assets/incrementing.js -->
    <script src="<?php echo base_url(); ?>assets/js/incrementing.js"></script>

</body>

</html>
