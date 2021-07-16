<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #01A9DB;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Usúários -
                         <?php if( totalUsuarios() == 0 ){ ?>

                          Nenhum cadastrado
                          <?php }elseif( totalUsuarios() == 1 ){ ?>

                          <?php echo totalUsuarios(); ?> 1 cadastrado 
                          <?php }else{ ?>

                          <?php echo totalUsuarios(); ?> cadastrados 
                          <?php } ?> 
                          </b></a>
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



        
            <button data-toggle="modal"  data-target="#registerModal"class="btn btn-primary"><b>Cadastrar Usuário</b> </button>
           <div class="search" style="float: right">
                  <form  action="/admin/usuarios" method="get" >
                        <div class="input-group">
                          <input   type="text" name="search"  class="form-control" placeholder="Digite sua pesquisa...">
                              <span  class="input-group-btn">
                                <button  class="btn btn" style="background-color: #01A9DB;color: white" type="submit"  id="search-btn"  ><i class="fa fa-search"style="font-size:13px;" > PESQUISAR</i>
                                </button>
                              </span>
                        </div>
                      </form>
                 </div><br><br>

            <div class="table-responsive">
            <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr style="font-size: 16px; font-weight: bold; " >
                
                     <th ><center>Foto<b></th>
                    <th  ><center>Nome<b></th>
                    <th ><center>E-mail</th>
                    <th><center>Login</th>
                    <th><center>Cargo</th>
                    <th><center>Loja</th> 
                    <th ><center>Administrador</th>
                    <th ><center>Data de Registro</th>
                    <th ><center>Editar ou Excluir</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($usuarios) && ( is_array($usuarios) || $usuarios instanceof Traversable ) && sizeof($usuarios) ) foreach( $usuarios as $key1 => $value1 ){ $counter1++; ?>

                  <tr style="font-size: 15px;font-weight: normal;">
                    
                    <td><br><center> 


                     <?php if( $value1["foto"] == 0 ){ ?>

                      <img src="/../res/ft_perfil/ft_male.png" style="height: 50px;width: 50px;border-radius: 30px;">
                       <?php }else{ ?>

                      <img src="/../res/ft_perfil/<?php echo $value1["foto"]; ?>" style="height: 50px;width: 50px;border-radius: 30px;">
                      <?php } ?>


                    
                    </td>
                    <td><br><center><?php echo $value1["nome"]; ?></td>
                    <td><br><center><?php echo $value1["email"]; ?></td>
                    <td><br><center><?php echo $value1["login"]; ?></td/>
                    <td><br><center><?php echo $value1["cargo"]; ?></td>
                    <td><br><center><?php echo $value1["loja"]; ?></td/>
                    <td><br><center><?php if( $value1["inadmin"] == 1 ){ ?>Sim<?php }else{ ?>Não<?php } ?></td>
                    <td><br><center><?php echo formatDate($value1["data_registro"]); ?></td>
                    <td><br>
                      <center>
                   
                   <div class="button">   
                  <a style="width: 80px;" href="/admin/usuarios/editar/<?php echo $value1["id_usuario"]; ?>"  class="btn btn-success btn-sm"> Editar</a>
                </div>
                   
                    <a style="width: 80px;" href="/admin/usuarios/delete/<?php echo $value1["id_usuario"]; ?>"  onclick="return confirm('Deseja realmente excluir o usuário <?php echo $value1["nome"]; ?>?')" class="btn btn-danger btn-sm"> Excluir</a>
                     

                      

                    </td>
                  </tr>
                  <?php } ?>

                </tbody>
              </table><br>
              </div>
              <center>


            <div class="box-footer clearfix">
              <ul class="pagination">
               <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                          <?php if( $pages == $value1["link"] ){ ?> 
                       <li> <a class="active"href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
                        <?php }else{ ?>

                        <li><a href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
                          <?php } ?>

                        <?php } ?>

            </div>
          </center>
          </div>

          <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>
            <hr class="my-4" />
             

        
    </div>
</div>


<!-- Modal cadastro -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModal">Cadastrar novo Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="/admin/usuarios/registro" method="post"><br>


          <div class="form-group"><label class="small mb-1"><b>Nome</b></label>
            <input class="form-control py-1" type="text" name="nome" placeholder="Digite o nome do usuário" required />
          </div>

          <div class="form-group"><label class="small mb-1"><b>Administrador</b></label>
            <select class="form-control py-1" name="inadmin" id="inadmin">
               <option value="1">Sim</option>
                <option value="0">Não</option>

            </select>
          </div>   

          <div class="form-group"><label class="small mb-1"><b>Login</b></label>
            <input class="form-control py-1"  type="text" name="login" placeholder="Digite o login do usuário"required>
          </div>

          <div class="form-group"><label class="small mb-1"><b>E-mail</b></label>
            <input class="form-control py-1"  type="email" name="email" placeholder="Digite o e-mail do usuário"required>
          </div>

        <div class="form-group"><label class="small mb-1"><b>Cargo</b></label>
          <select class="form-control py-1" name="cargo" id="cargo">
            <option value="Recursos Humanos">Suporte Técnico</option>
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

              <div class="form-group"><label class="small mb-1"><b>Loja</b></label>
            <select class="form-control py-1" name="loja" id="loja">
             <option value="Loja/Empresa 1">Loja/Empresa 1</option>
            <option value="Loja/Empresa 2">Loja/Empresa 2</option>
            <option value="Loja/Empresa 3">Loja/Empresa 3</option>
            </select>
          
          </div>

          <div class="form-group"><label class="small mb-1"><b>Senha</b></label>
            <input class="form-control py-1"  type="password" name="senha" placeholder="Digite a senha do usuário"required>
          </div>

          <input class="btn btn-success btn btn-block" type="submit" value="Cadastrar">


        </form>
      </div>
    </div>
  </div>
</div>