<?php
// Registering Globals
define("dbhost", "mysql");
define("dbuser", "admin");
define("dbpass", "redhat@123");
define("dbname", "workshop");
// 
class Db {
	public $hostname =  dbhost;
	public $usuario = dbuser;
	public $senha = dbpass;
	public $database = dbname;
	
	
	public $idcon;
	public $rs;
	public $matriz_associativa;
	
	public function Db(){
		$this->m_connect();	
	}
	
	public function m_connect() {
			$this->idcon = mysql_pconnect($this->hostname, $this->usuario, $this->senha) or die(mysql_error());
			mysql_select_db($this->database, $this->idcon);
			// Set timezone
			$qr = "set time_zone = 'America/Sao_Paulo'";
			$this->m_query($qr);
	}
	
	public function m_query($qr) {
			if(!$this->idcon) {
				$this->m_connect();
			}
                        
			$rs=mysql_query($qr, $this->idcon);
			$this->rs = $rs;
			return $rs;
			
	}
	
	public function m_fetch_array($rs) {
		return mysql_fetch_array($rs);
	}

	public function m_result($rs, $campo) {
		return mysql_result($rs, 0, $campo);
	}

	public function SetPassword($password) {
			$this->senha = $password;
	}

	public function m_num_rows($rs) {
		return mysql_num_rows($rs);
	}

	public function m_affected_rows() {
		return mysql_affected_rows($this->idcon);
	}

	public function m_close() {
		return mysql_close($this->idcon);	
	}
	
	public function m_error() {
		return mysql_error();	
	}
        
        public function escape($string) {
            return mysql_real_escape_string($string, $this->idcon);
        }

	// ======================= Funcoes Especificas para Instructor ================

	public function CreateSchema() {
		$qr = "
create table if not exists student ( 
	id_student int primary key auto_increment not null,
	nome varchar(255),
	dthr_registro datetime,
	id_area int,
	email varchar(255),
	empresa varchar(255)
)
";
		$rs = $this->m_query($qr);
		$qr = "create table if not exists area (
        id_area int primary key auto_increment not null,
        area varchar(255)
)
";
		$rs = $this->m_query($qr);
		$qr = "create table config (config text)";
		$rs = $this->m_query($qr);
	}
	public function PopulateAreas() {
		$qr = "delete from area";
		$rs = $this->m_query($qr);
		$qr = "insert into area (id_area, area) values ('1', 'Arquitetura'), ('2','Infraestrutura'), ('3', 'Desenvolvimento'), ('4', 'Gestao'), ('5', 'DevOps')"; 
		$rs = $this->m_query($qr);
	}
	
}

