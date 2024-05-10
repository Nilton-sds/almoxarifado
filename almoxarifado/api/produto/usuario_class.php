<?php


class Usuario {
    private $codigo;
    private $nome;
    private $email;
    private $data;
    private $situacao;
    private $senha1;
    private $senha2;

    public function valor_usuario($dados_usuario) {
        $this->codigo = isset($dados_usuario["codigo"]) ? $dados_usuario["codigo"] : null;
        $this->nome = $dados_usuario["nome"];
        $this->email = $dados_usuario["email"];
        $this->senha1= $senha1['senha1'];
        $this->data = $dados_usuario["data_registro"];
        $this->situacao = $dados_usuario["situacao"];
    }

    public function inserir($dados_usuario) {

        $this->valor_usuario($dados_usuario);
        $resultado = array();

        try {
            include("conexao_bd.php");

            $sql = "INSERT INTO usuario (codigo, nome,senha1,senha2, email, data_registro, situacao) VALUES (?, ?, ?, ?, ?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->codigo, $this->nome,$this->senha1,this->senha2, $this->email, $this->data, $this->situacao]);

            $resultado["msg"] = "Usuário inserido com sucesso";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {
            echo "Inserção no banco de dados falhou: " . $e->getMessage();
            $resultado["msg"] = "Usuário não inserido";
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;

        return $resultado;
    }
}

public function result($valores)

$result = $statement->execute($valores);

if($_POST) {
    $senha          = $_POST['senha1'];
    $senha2  = $_POST['csenha2'];
    if ($senha == "") {
        $mensagem = "<span class='aviso'><b>Aviso</b>: Senha não foi alterada!</span>";
    } else if ($senha == $confirma_senha) {
        $mensagem = "<span class='sucesso'><b>Sucesso</b>: As senhas são iguais: ".$senha."</span>";
    } else {
        $mensagem = "<span class='erro'><b>Erro</b>: As senhas não conferem!:".$confirma_senha."</span>";
    }
    echo "<p id='mensagem'>".$mensagem."</p>";
}

?>
