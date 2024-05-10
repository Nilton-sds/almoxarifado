<?php

class Produto {
    private $codigo;
    private $nome;
    private $categoria;
    private $valor;
    private $foto;
    private $info;
    private $qtd_produto;
    private $codigo_usuario;


   
     // Método para pegar valores do POST e atribuir às propriedades
     public function pegar_valores_post($valores) {
        $this->codigo = isset($valores["codigo"]) ? $valores["codigo"] : null;
        $this->nome = $valores["nome_produto"];
        $this->categoria = $valores["categoria_produto"];
        $this->valor = $valores["valor_produto"];
        $this->qtd_produto = $valores["qtd_produto"];
        $this->foto = $valores["foto_produto"];
        $this->info = $valores["info"];
        
    }

 // Método para inserir um produto no banco de dados
 public function inserir($valores) {
    $this->pegar_valores_post($valores);
    $resultado = array();

    try {
        include("conexao_bd.php");

        $sql = "INSERT INTO produto 
                (nome_produto, categoria_produto, valor_produto,qtd_produto, foto_produto, info, codigo_usuario, codigo)
                VALUES (?, ?, ?, ?, ?, ?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$this->nome, $this->categoria, $this->valor,$this->qtd_produto, $this->foto, $this->info, $this->codigo_usuario, $this->codigo]);

        $resultado["msg"] = "Produto inserido";
        $resultado["cod"] = 1;
        $resultado["style"] = "alert-success";
    } catch (PDOException $e) {
        echo "Inserção no banco de dados falhou: " . $e->getMessage();
        $resultado["msg"] = "Produto não inserido";
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    }

    $conn = null;

    return $resultado;
}


public function atualizar($produto) {
    $this->pegar_valores_post($produto);
    $resultado = array();

    try {
        include("conexao_bd.php");

        $sql = "UPDATE produto SET nome_produto=?, categoria_produto=?, valor_produto=?, qtd_produto=?, foto_produto=?, info=?, data_hora=now() WHERE codigo=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$this->nome, $this->categoria, $this->valor,$this->qtd_produto,$this->foto, $this->info, $this->codigo]);

        $resultado["msg"] = "Item alterado com sucesso";
        $resultado["cod"] = 1;
        $resultado["style"] = "alert-success";
    } catch (PDOException $e) {
        echo "Atualização no banco de dados falhou: " . $e->getMessage();
        $resultado["msg"] = "Erro ao alterar item";
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    }

    $conn = null;

    return $resultado;
}

    public function remover($codigo) {
        $resultado = array();

        try {
            include("conexao_bd.php");

            $sql = "UPDATE produto SET situacao = 'DESABILITADO' WHERE codigo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$codigo]);

            $resultado["msg"] = "Item removido com sucesso";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {
            echo "Remoção no banco de dados falhou: " . $e->getMessage();
            $resultado["msg"] = "Erro ao remover item";
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;

        return $resultado;
    }
}

?>
