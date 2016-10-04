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
                <a class="navbar-brand page-scroll" href="<?php echo base_url(); ?>">SMTI-08 RESTO</a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Portfolio Grid Section -->
    <section id="pemesanan" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
					<label style="font-family:Montserrat">Terima kasih, transaksi Anda sedang kami proses. Pelayan kami akan mengantarkan bill ke meja Anda.</label><br>
                </div>
            </div>
            <div class="row">
				<?php
					if (!defined('BASEPATH')) {
						exit('No direct script access allowed');
					}
                    //kalau nilai dropdown listnya berasal dari pilihan2 yang disediakan, bukan lainnya
					if(isset($_GET['menu'])){

                        //$menu=nilai yg terkandung di dropdown list
						$menu = $_GET['menu'];

                        //kalau yg terpilih 'Makanan'
						if($menu == 'Makanan'){

                            //ambil semua daftar makanan, input ke variabel array $b
							$a = $this->db->query("SELECT * FROM menu WHERE id_menu LIKE 'MK%'");
							foreach($a->result_array() as $b){
								?>
								<div class="col-md-4 col-sm-6 portfolio-item">

                                <!--ambil popup yang idnya sesuai dengan menu yang dipilih -->
								<a href="#<?php echo $b['id_menu'] ?>" class="portfolio-link" data-toggle="modal">
									<div class="portfolio-hover">
										<div class="portfolio-hover-content">
											<i class="fa fa-plus fa-3x"></i>
										</div>
									</div>
									<img src="<?php echo base_url(); ?>assets/gambar/thumbnail/<?php echo $b['gambar'] ?>" class="img-responsive" alt="">
								</a>
								<div class="portfolio-caption">
                                    <!--kalau nilai harga di dbnya 0 tulis gratis-->
                                    <?php if ($b['harga'] == 0) { ?>
                                        <h4><?php echo $b['nama_menu'] ?></h4>
                                        <p class="text-muted">GRATIS</p>
                                    <?php } else { ?>
                                        <h4><?php echo $b['nama_menu'] ?></h4>
                                        <p class="text-muted">Rp <?php echo $b['harga'] ?></p>
                                    <?php } ?>
								</div>
								</div>
													
								<?php
							}
						}

                        //kalau yang terpilih minuman
						elseif($menu == 'Minuman'){

                            //ambil semua minuman, input ke variabel array $b
							$a = $this->db->query("SELECT * FROM menu WHERE id_menu LIKE 'MN%'");
							foreach($a->result_array() as $b){
								?>
								<div class="col-md-4 col-sm-6 portfolio-item">

                                <!--ambil popup yang idnya sesuai dengan menu yang dipilih -->
								<a href="#<?php echo $b['id_menu'] ?>" class="portfolio-link" data-toggle="modal">
									<div class="portfolio-hover">
										<div class="portfolio-hover-content">
											<i class="fa fa-plus fa-3x"></i>
										</div>
									</div>
									<img src="<?php echo base_url(); ?>assets/gambar/thumbnail/<?php echo $b['gambar'] ?>" class="img-responsive" alt="">
								</a>
								<div class="portfolio-caption">
                                    <!--kalau nilai harga di dbnya 0 tulis gratis-->
									<?php if ($b['harga'] == 0) { ?>
                                        <h4><?php echo $b['nama_menu'] ?></h4>
                                        <p class="text-muted">GRATIS</p>
                                    <?php } else { ?>
                                        <h4><?php echo $b['nama_menu'] ?></h4>
                                        <p class="text-muted">Rp <?php echo $b['harga'] ?></p>
                                    <?php } ?>
								</div>
								</div>
													
								<?php
							}
						}
					}
					?>
            </div>
        </div>
    </section>

    <footer>
        <?php include 'footer.html';?>
    </footer>

    <?php
    if (!defined('BASEPATH')) {
        exit('No direct script access allowed');
    }

    //selain narik daftar menu, sekalian generate popup buat masing2 menu
    if(isset($_GET['menu'])){
        //import SEMUA menu, karena makanan minuman semuanya dibikinin popup yang sama
        $a = $this->db->query("SELECT * FROM menu");
        //input ke variabel array $b
        foreach($a->result_array() as $b){
        ?>
        <!--id popup sebuah menu=id_menu menu tersebut-->
        <div class="portfolio-modal modal fade" id="<?php echo $b['id_menu'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <!--tulis2 yang dibutuhkan-->
                                <h2><?php echo $b['nama_menu'] ?></h2>
                                <?php if ($b['harga'] == 0) { ?>
                                    <p class="item-intro text-muted">GRATIS</p>
                                <?php } else { ?>
                                    <p class="item-intro text-muted">Rp <?php echo $b['harga'] ?></p>
                                <?php } ?>
                                <img class="img-responsive img-centered" src="<?php echo base_url(); ?>assets/gambar/ori/<?php echo $b['gambar'] ?>" alt="">
                                <p><?php echo $b['deskripsi'] ?></p>

                                <!--kumpulan button di popup jadi 1 form u/ memudahkan input ke db pake controller+model, disini bikin form bernama 'myform'+pake function save() dari /controllers/Pemesanan.php-->
                                <?php echo form_open('Pemesanan/save', array('name' => 'myform'))?>
                                    <!--tombol minus-->
                                    <button type="button" class="btn btn-primary qtyminus" field="quantity"> - </button>
                                    <!--input tersembunyi untuk menampung nilai id_menu-->
                                    <input type="hidden" name="kd_menu" value="<?php echo $b['id_menu']?>" class="qty"/>
                                    <!--input text untuk menyimpan jumlah menu yang dipesan-->
                                    <input type="text" name="quantity" style="width:30px; text-align:center" value="0" class="qty"/>
                                    <!--tombol plus-->
                                    <button type="button" class="btn btn-primary qtyplus" field="quantity"> + </button><br><br>
                                    <!--tombol submit untuk nginput ke DB, perhatikan namanya 'submit', sama seperti yang dibutuhkan di function save() di /controllers/Pemesanan.php-->
                                    <input type="submit" class="btn btn-primary" name="submit" value="PESAN"/>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
        }
    }
    ?> 

    

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
