<?php verificaPermissao(1); ?>
<div class="box-content">
    <i class="fa-solid fa-images"></i><h2> Cadastrar Slide</h2>

    <form method="post" enctype="multipart/form-data">

        <?php  
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];

                if($nome == ''){
                    Painel::alert('erro','O nome da imagem não pode estar vazio!');
                }else if($imagem['name'] == ''){
                    Painel::alert('erro','Selecione uma imagem para o slide!');
                }else{
                    if($imagem['name'] != '' && Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','O formato especificado não é válido!');
                    }else{
                        include('../classes/lib/WideImage.php');
                        $imagem = Painel::updateFile($imagem, 'uploads/slides');
                        //WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
                        //faz o resize da img em 100px
                        $arr = ['nome'=>$nome, 'slide'=>$imagem, 'order_id'=>'0', 'nome_tabela'=>'tb_site.slides'];
                        Painel::insert($arr);
                        Painel::alert('sucesso','A imagem '.$nome.' foi cadastrada com sucesso!');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome">
        </div><!-- form-group -->

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem"/>
        </div><!-- form-group -->

        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- form-group -->

    </form>
</div><!-- box-content edit-user -->