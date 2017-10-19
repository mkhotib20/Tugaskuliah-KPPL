<?php 
/**
* 
*/
class models extends CI_Model
{
	
	public function read($tabel){
		return $this->db->get_where($tabel);
	}
	public function readWH($tabel, $where, $id){
		return $this->db->get_where($tabel, array($where => $id));
	}
	public function input($tabel, $data){
		return $this->db->insert($tabel, $data);
	}
	public function update($tabel, $data, $where, $id){
		return $this->db->update($tabel, $data, array($where => $id));
	}
	public function readPeminjaman(){
		return $this->db->query("
				SELECT * FROM 
					`peminjaman`, `peminjam`, `mobil`, `supir` 
				WHERE 
					`peminjaman`.`no_pol` = `mobil`.`no_polisi`
				AND 
					`peminjaman`.`no_ktp_spr`=`supir`.`no_ktp` 
				AND 
					`peminjaman`.`no_ktp_pjm`=`peminjam`.`no_ktp_peminjam`

			");
	}
	
}
 ?>