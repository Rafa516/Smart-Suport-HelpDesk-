<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #01A9DB;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Chamados Pendentes -   
                          <?php if( totalChamadosPendentes() == 0 ){ ?>

                          Nenhum Registrado
                          <?php }elseif( totalChamadosPendentes() == 1 ){ ?>

                          <?php echo totalChamadosPendentes(); ?> Registrado
                          <?php }else{ ?>

                          <?php echo totalChamadosPendentes(); ?> Registrados
                          <?php } ?>  </b></a>

                </li>
            </ul>


            <?php if( $profileMsg != '' ){ ?>

            <div class="alert alert-success">
                <b><?php echo $profileMsg; ?></b>
            </div>
            <?php } ?>


             <?php if( totalChamadosPendentes() != 0 ){ ?>

             <div class="table-responsive">
                <div style="float: right">
                  <form  action="/admin/calls-pendings" method="get" >
                        <div class="input-group">
                          <input   type="text" name="search"  class="form-control" placeholder="Digite sua pesquisa...">
                              <span  class="input-group-btn">
                                <button  class="btn btn" style="background-color: #01A9DB;color: white" type="submit"  id="search-btn"  ><i class="fa fa-search"style="font-size:13px;" > PESQUISAR</i>
                                </button>
                              </span>
                        </div>
                      </form>
                 </div><br><br>
            <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr style="font-size: 16px; font-weight: bold; " >
                    
                    <th  ><center>N° Chamado<b></th>
                    <th  ><center>Usuário<b></th>
                    <th  ><center>Cargo<b></th>
                    <th><center>Loja</th>
                    <th  ><center>Problema<b></th>
                    <th ><center>Observação</th>
                    <th><center>Fotos</th>
                     <th><center>Situação</th>
                    <th><center>Data de Registro</th>
                    <th><center>Excluir</th>

                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($chamadosPendentes) && ( is_array($chamadosPendentes) || $chamadosPendentes instanceof Traversable ) && sizeof($chamadosPendentes) ) foreach( $chamadosPendentes as $key1 => $value1 ){ $counter1++; ?>

                  <tr style="font-size: 15px;font-weight: normal;">
                     <td><br><center><?php echo $value1["id_chamado"]; ?></td>
                    <td><br><center><?php echo $value1["nome"]; ?></td>
                     <td><br><center><?php echo $value1["cargo"]; ?></td>
                    <td><br><center><?php echo $value1["loja"]; ?></td>
                    <td><br><center><?php echo $value1["problema"]; ?></td>

                    <td><br><center><?php echo $value1["observacao"]; ?></td>
                   
                   <?php if( nomeFotos($value1["id_chamado"]) == '' ){ ?>

                       <td><br><center><b>Sem Fotos</b></td>
                        <?php }else{ ?>

                    <td><br><center>   <a href="/admin/calls/images/<?php echo $value1["id_chamado"]; ?>" style="width: 100px;" class="btn btn-info btn-sm" >
                      <?php if( numFotos($value1["id_chamado"]) == 1 ){ ?>

                      <b><?php echo numFotos($value1["id_chamado"]); ?> Foto</b></a>
                      <?php }else{ ?>

                      <b><?php echo numFotos($value1["id_chamado"]); ?> Fotos</b></a>
                      <?php } ?>

                   </td/>
                      <?php } ?>

                   </td/>
                     <td><br><center>
                     

                          <a style="width: 80px;" href="/admin/chamado-situacao/<?php echo $value1["id_chamado"]; ?>" onclick="return confirm('Deseja alterar a situação do chamado nº <?php echo $value1["id_chamado"]; ?>?')" type="button" class="btn btn-outline-danger btn-sm ">Pendente</a></td>
                     
                      </td>
                 

                    <td><br><center><?php echo formatDate($value1["data_registro"]); ?></td>
                    <td><br><center> <a style="width: 80px;" href="/admin/chamados/delete/<?php echo $value1["id_chamado"]; ?>"  onclick="return confirm('Deseja realmente excluir o chamado nº <?php echo $value1["id_chamado"]; ?>?')" class="btn btn-danger btn-sm"> Excluir</a></td>
                   
                   
                  </tr>
                  
                  <?php } ?>

                </tbody>
              </table>
              <br>
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

              </ul>
            </div>
          </center>

          </div>
           <?php } ?>

          <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>


            <hr class="my-4" />


        </div>
    </div>
</div>



      