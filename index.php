<?php 

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");


echo json_encode($usuarios);

*/

/*esse carega um usuário apenas
$root = new Usuario();
$root->loadbyId(3);
echo $root;
*/

/*esse carrega uma lista de usuário
$lista = Usuario::getList();
echo json_encode($lista);
*/

/*esse carrega uma lista de usuário buscando pelo login
$search = Usuario::search("user");
echo json_encode($search);
*/

/*carrega um usuário usando o login e a senha
$usuario = new Usuario();
$usuario->login("JooJ", "esqueci");
echo $usuario;
*/

/*criando um novo usuário
$aluno = new Usuario("aluno", "senha");
$aluno->insert();
echo $aluno;
*/

/*alterar um usuario
$usuario = new Usuario();
$usuario->loadById(11);
$usuario->update("professor", "laal");
echo $usuario;
*/

$usuario = new Usuario();

$usuario->loadById(11);

$usuario->delete();

echo $usuario;
 ?>