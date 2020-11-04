<?php  

class Usuario {

	private $idusuario;
	private $login;
	private $senha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($value){
		$this->login = $value;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($value){
		$this->senha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if (count($results) > 0) {

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
	}

//por nao usar "$this", podemos fazer dessa função algo estatico
//a vantagem seria que não seria necessário instanciar um objeto da classe usuário
//só usar um Usuario::getList para chamar essa função
//Nisso, não usando um $this usando a memória dentro do escopo, podemos
//usar a função fora do próprio escopo, pois ela é apenas um comando quen não requisita valores anteriores.
	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY login;");
	}

	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
				':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login, $password){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN and senha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		if (count($results) > 0) {

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		} else {

			throw new Exception("Login e/ou senha invalidos");
		
		}
	}

	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));

	}



}






?>