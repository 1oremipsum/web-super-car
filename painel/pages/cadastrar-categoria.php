<div class="box-content">
    <i class="fa-solid fa-tag"></i><h2> Cadastrar Categoria</h2>

    <form method="post" enctype="multipart/form-data">

        <?php  
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                if($nome == ''){
                    Painel::alert('erro','O nome da categoria não pode estar vazio!');
                }else{
                    $slug = Painel::generateSlug($nome);
                    $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ?");
                    $verificar->execute(array($_POST['nome']));

                    if($verificar->rowCount() == 1){
                        Painel::alert("erro", 'Já existe uma categoria com nome "'.$nome.'".');
                    }else{
                        $arr = ['nome'=>$nome, 'slug'=>$slug, 'order_id'=>'0', 'nome_tabela'=>'tb_site.categorias'];
                        Painel::insert($arr);
                        Painel::alert('sucesso','A categoria foi cadastrada com sucesso!');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Nome da Categoria</label>
            <input type="text" name="nome">
        </div><!-- form-group -->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- form-group -->

    </form>
</div><!-- box-content -->