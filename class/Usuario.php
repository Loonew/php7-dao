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

			$this->setData($results[0]);

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

			$this->setData($results[0]);

		} else {

			throw new Exception("Login e/ou senha invalidos");
		
		}
	}

	public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setLogin($data['login']);
		$this->setSenha($data['senha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){

		$sql = new Sql();
//sp storage procedure da tabela usuarios na função insert
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getlogin(),
			':PASSWORD'=>$this->getsenha()
		));

		if(count($results) > 0) {
			$this->setData($results[0]);
		}

	}

	public function update($login, $password) {

		$this->setlogin($login);
		$this->setsenha($password);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET login = :LOGIN, senha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getLogin(),
			':PASSWORD'=>$this->getSenha(),
			':ID'=>$this->getIdusuario()

		));

	}

	public function __construct($login = "", $password = ""){

		$this->setLogin($login);
		$this->setSenha($password);

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