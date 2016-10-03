<?php
	class insert_model extends CI_Model{
		function process() {

            //memanggil method getkodeunik() dari /model/insert_model.php
			$id_transaksi = $this->insert_model->getkodeunik();
            $waktu = $this->insert_model->getJam();
            $no_meja = '01';

            //memanggil nilai yang dikandung elemen bernama 'kd_menu' dan 'quantity' pada form yang memanggil method process ini. Dalam kasus ini elemennya adalah input text yang mengandung nilai kode menu dan jumlah menu yang dipesan

			$id_menu = $this->input->post('kd_menu');
			$jumlah = $this->input->post('quantity');

            //array penampung
			$data = array (

                //sebelah kiri itu field-field database yang mau diinsert
				'id_transaksi'=>$id_transaksi,
                'waktu'=>$waktu,
                'no_meja'=>$no_meja,
				'id_menu'=>$id_menu,
				'jumlah'=>$jumlah
				);

            //sintaks CI untuk insert data ke tabel 'pembeli'
			$this->db->insert('pembeli', $data);
		}

		function getkodeunik() { 
            //ambil 4 karakter terkanan id_transaksi yang bernilai paling tinggi, lalu ditambah 1 sebagai idmax, misal paling tinggi 201630090003, maka yang diambil 0003+ditambah 1, jadi idmax=0004
			$q = $this->db->query("SELECT MAX(RIGHT(id_transaksi,4))+1 AS idmax FROM pembeli");
        	$NomOt = ""; //kode awal
        	if($q->num_rows()>0){ //jika data paling tinggi itu ada
            	foreach($q->result() as $k){ //hasil kueri dimasukkan ke variabel array $k
            		$nomor1 = $k->idmax; //dari kasus di atas, $nomor1=idmax=0004

                    //ambil id_transaksi bernilai paling tinggi sebagai nomax
            		$q2 = $this->db->query("SELECT MAX(id_transaksi) AS nomax FROM pembeli");
            		if($q2->num_rows()>0){ //jika data paling tinggi itu ada
            			foreach($q2->result() as $kk){ //hasil kueri dimasukkan ke variabel array $kk
            				$nomor2 = $kk->nomax; //$nomor2=nomax
            				$tanggal = date("Ymd"); //$tanggal=tanggal hari ini

            				//ngambil tanggal dari id_transaksi terkini (latest id_transaksi), kalau beda hari sama hari ini..
                            if(substr($nomor2,0,8) != $tanggal){ 
            					$NomOt = $tanggal.'0001'; //restart id_transaksinya jadi hari ini+0001
            				} else { //selainnya..

                                //kalau $nomor1 masih satuan, penulisannya 000angka
            					if($nomor1 <= 9){
            						$NomOt = $tanggal.'000'.$nomor1;

                                //kalau $nomor1 puluhan, penulisannya 00angka
            					} elseif ($nomor1 <= 99) {
            						$NomOt = $tanggal.'00'.$nomor1;

                                //kalau $nomor1 ratusan, penulisannya 0angka    
            					} elseif ($nomor1 <= 999) {
            						$NomOt = $tanggal.'0'.$nomor1;

                                //selain itu $NomOt=angka itu sendiri
            					} else {
            						$NomOt = $tanggal.$nomor1;
            					}
            				}
            			}
            		}
            	}
        	}else{ //jika data kosong diset ke kode awal
	            $NomOt = $tanggal.'0001';
    	    }
            //kembalikan id_transaksi yang baru digenerate
        	return $NomOt;
   		}

        function getJam() {
            return date("H:i:s");
        }

        function row_delete($id) {
            $this->db->where('id_transaksi', $id);
            $this->db->delete('pembeli'); 
        }
	}
?>