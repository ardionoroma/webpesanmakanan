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
                <a class="navbar-brand page-scroll" href="<?php echo base_url(); ?>koki">SMTI-08 RESTO</a>
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
                    <h2 class="section-heading">DAFTAR MENU YANG DIPESAN</h2>
                    <div class="row text-center">
                        <table style='width:80%'class='table table-bordered'>
                            <div>
                                <tr class='danger'>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Gambar</th>
                                    <th>Jumlah</th>
                                    <th>Status Pesanan</th>
                                    <th>Tindakan</th>
                                </tr>
                                <?php
                                if (!defined('BASEPATH')) {
                                    exit('No direct script access allowed');
                                }
                                $a = $this->db->query("SELECT * FROM pembeli WHERE status=0 OR status=1 OR status=2");
                                $no_urut = 1;
                                foreach($a->result_array() as $b){
                                ?>
                                    <tr>
                                        <td><?php echo $no_urut ?></td>
                                        <?php
                                        if (!defined('BASEPATH')) {
                                            exit('No direct script access allowed');
                                        }
                                        $teks = "SELECT * FROM menu WHERE id_menu='".$b['id_menu']."'";
                                        $anu = $this->db->query($teks);
                                        foreach($anu->result_array() as $c){?>
                                            <td><?php echo $c['nama_menu']?></td>
                                            <td><img src ="<?php echo base_url(); ?>assets/gambar/tabel/<?php echo $c['gambar'] ?>"/></td>
                                        <?php } ?>
                                        <td><?php echo $b['jumlah']?></td>
                                        <?php if ($b['status'] == 0) { ?>
                                            <td>Belum dimasak</td>
                                        <?php } elseif ($b['status'] == 1) { ?>
                                            <td>Siap dimasak</td>
                                        <?php } elseif ($b['status'] == 2) { ?>
                                            <td>Sedang dimasak</td>
                                        <?php } elseif ($b['status'] == 3) { ?>
                                            <td>Siap diantar</td>
                                        <?php } elseif ($b['status'] == 4) { ?>
                                            <td>Sedang diantar</td>
                                        <?php } elseif ($b['status'] == 5) { ?>
                                            <td>Selesai diantar</td>
                                        <?php } ?>
                                        <?php echo form_open('Koki/status', array('name' => 'status'))?>
                                            <input type="hidden" name="id_transaksi" value="<?php echo $b['id_transaksi']?>" class="qty"/>
                                            <input type="hidden" name="status" value="<?php echo $b['status']?>" class="qty"/>
                                            <?php if ($b['status'] == 0) { ?>
                                                <td><input type="submit" class="btn btn-primary" name="batal" value="Batalkan"/><br><input type="submit" class="btn btn-primary" name="siap" value="Siap Dimasak"/></td>
                                            <?php } elseif ($b['status'] == 1) { ?>
                                                <td><input type="submit" class="btn btn-primary" name="sedang" value="Sedang Dimasak"/></td>
                                            <?php } elseif ($b['status'] == 2) { ?>
                                                <td><input type="submit" class="btn btn-primary" name="selesai" value="Selesai"/></td>
                                            <?php } ?>
                                        <?php echo form_close(); ?>
                                    </tr>
                                    <?php $no_urut+=1;
                                } ?>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; SMTI-08 2016</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
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
