<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Controller baru untuk menu pemesanan
class Pemesanan extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function index() {
        //ketika controller pemesanan diakses, yang dibuka adalah /view/pemesanan.php
        $this->load->view('Pemesanan');
    }

    //function untuk melakukan penyimpanan ke db dengan menggunakan /model/insert_model.php
    function save() {
        $this->load->model('insert_model');

        //sumber inputan adalah elemen bernama 'submit' pada form yang memanggil function 'save' ini, pada kasus ini elemennya adalah tombol input bernama submit (ada di /view/pemesanan.php)
        if ($this->input->post('submit')) {
            
            //menjalankan method process() pada /model/insert_model.php
            $this->insert_model->process();
        }

        //setelah input selesai, kembali ke controller Pemesanan (kembali meload halaman pemesanan)
        if ($this->db->affected_rows() == 1 && substr($this->input->post('kd_menu'),0,2) == 'MK') {
            echo "<script type='text/javascript'>alert('Pesanan sukses diinput!')</script>";
            redirect('Pemesanan?menu=Makanan');
        } elseif ($this->db->affected_rows() == 1 && substr($this->input->post('kd_menu'),0,2) == 'MN') {
            echo "<script type='text/javascript'>alert('Pesanan sukses diinput!')</script>";
            redirect('Pemesanan?menu=Minuman');
        } else {
            echo "<script type='text/javascript'>alert('Pesanan gagal diinput!')</script>";
        }
    }

    function batal() {
        $this->load->model('insert_model');

        //sumber inputan adalah elemen bernama 'submit' pada form yang memanggil function 'save' ini, pada kasus ini elemennya adalah tombol input bernama submit (ada di /view/pemesanan.php)
        if ($this->input->post('submit')) {
            
            //menjalankan method process() pada /model/insert_model.php
            $this->insert_model->row_delete($this->input->post('id_transaksi'));
        }

        //setelah input selesai, kembali ke controller Pemesanan (kembali meload halaman pemesanan)
        redirect('/#services');
    }
}
