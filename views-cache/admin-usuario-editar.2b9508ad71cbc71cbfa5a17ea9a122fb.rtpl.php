<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color:#01A9DB;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Alterar Dados - Usuário <b><?php echo $usuario["nome"]; ?></b></a>
                </li>
            </ul>

             <?php if( $profileMsg != '' ){ ?>

            <div class="alert alert-success">
                <b><?php echo $profileMsg; ?></b>
            </div>
            <?php } ?>


            <?php if( $errorRegister != '' ){ ?>

            <div class="alert alert-danger">
               <b> <?php echo $errorRegister; ?></b>
            </div>
            <?php } ?>

              <form class="form-group" action="/admin/usuarios/editar/<?php echo $usuario["id_usuario"]; ?>" method="post"><br>


          <div class="form-group"><label class="small mb-1"><b>Nome</b></label>
            <input class="form-control py-1" value='<?php echo $usuario["nome"]; ?>' type="text" name="nome" />
          </div>


           <?php if( $usuario["inadmin"] == 1 ){ ?>

           <div class="form-group"><label class="small mb-1"><b>Administrador</b></label>
            <select class="form-control py-1" name="inadmin" id="inadmin">
               <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
          </div>  

          <?php }elseif( $usuario["inadmin"] == 0 ){ ?>

          <div class="form-group"><label class="small mb-1"><b>Administrador</b></label>
            <select class="form-control py-1" name="inadmin" id="inadmin">
              <option value="0">Não</option>
               <option value="1">Sim</option>
                
            </select>
          </div>  

          <?php } ?>


           <div class="form-group"><label class="small mb-1"><b>E-mail</b></label>
            <input class="form-control py-1" value='<?php echo $usuario["email"]; ?>' type="text" name="email"  />
          </div>

           <div class="form-group"><label class="small mb-1"><b>Cargo</b></label>
          <select class="form-control py-1" name="cargo" id="cargo">
            <option value="<?php echo $usuario["cargo"]; ?>"><?php echo $usuario["cargo"]; ?></option>
            <option value="Suporte Técnico">Suporte Técnico</option>
           <option value="Recursos Humanos">Recursos Humanos</option>
            <option value="Contabilidade">Contabilidade</option>
            <option value="Financeiro">Financeiro</option>
            <option value="Telemarketing">Telemarketing</option>
            <option value="Marketing">Marketing</option>
            <option value="Gerente">Gerente</option>
            <option value="Vendendor">Vendendor</option>
            <option value="Caixa">Caixa</option>
            <option value="Estoque">Estoque</option>
            <option value="Motorista">Motorista</option>
          </select>
        </div>


           <?php if( $usuario["loja"] == 'Loja/Empresa 1' ){ ?>

             <div class="form-group"><label class="small mb-1"><b>Loja</b></label>
            <select class="form-control py-1" name="loja" id="loja">
           <option value="Loja/Empresa 1">Loja/Empresa 1</option>
            <option value="Loja/Empresa 2">Loja/Empresa 2</option>
            <option value="Loja/Empresa 3">Loja/Empresa 3</option>
           
            </select>
          </div>

          <?php }elseif( $usuario["loja"] == 'Loja/Empresa 2' ){ ?>

             <div class="form-group"><label class="small mb-1"><b>Loja</b></label>
            <select class="form-control py-1" name="loja" id="loja">
            <option value="Loja/Empresa 2">Loja/Empresa 2</option>
            <option value="Loja/Empresa 1">Loja/Empresa 1</option>
            <option value="Loja/Empresa 3">Loja/Empresa 3</option>
           
            </select>
          </div>

            <?php }elseif( $usuario["loja"] == 'Loja/Empresa 3' ){ ?>

             <div class="form-group"><label class="small mb-1"><b>Loja</b></label>
            <select class="form-control py-1" name="loja" id="loja">
            <option value="Loja/Empresa 3">Loja/Empresa 3</option>
            <option value="Loja/Empresa 2">Loja/Empresa 2</option>
            <option value="Loja/Empresa 1">Loja/Empresa 1</option>
           
            </select>
          </div>

          <?php } ?>


         


          <input class="btn btn-success btn btn-block" type="submit" value="Alterar">


        </form>

       
   

            <hr class="my-4" />

             <a href="javascript:history.back()" class="btn btn-info btn-xs">voltar</a>


        </div>
    </div>
</div>

