<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

  <div class="content-inside">

    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #01A9DB;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Registrar Chamado</b></a>
        </li>
      </ul>
      <?php if( $CallOpenMsg != '' ){ ?>

            <div class="alert alert-success">
                <b><?php echo $CallOpenMsg; ?></b>
            </div>
            <?php } ?>


       <?php if( $errorRegister != '' ){ ?>

            <div class="alert alert-danger">
                  <b><?php echo $errorRegister; ?></b>
            </div>
             <?php } ?>


     

        <div class="col">
          

          </div>
          <div class="row mb-7">
            <div class="col-md-12">
              <p class="text-muted">

              <form class="form-group" action="/usuario/registrar-chamado/enviar" method="post" enctype="multipart/form-data"><br>


           <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Problema</b></label>
            <select class="form-control py-1" name="problema" id="problema">
            <option value="Sistema">Sistema</option>
            <option value="Sistema Operacional do Computador">Sistema Operacional do Computador</option>
            <option value="Conexão com a Internet">Conexão com a Internet</option>
            <option value="Impressão de Documentos">Impressão de Documentos</option>
             <option value="Mouse ou Teclado ou Monitor">Mouse ou Teclado ou Monitor</option>
             <option value="Outros">Outros</option>
            </select>
          </div>

       


                <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Observação</b></label>
                  <textarea class="form-control py-1" value="" type="text" name="observacao" height="10"> </textarea>
                </div>

             

                <div class="form-group"><label class="small mb-1"><b b
                      style="font-size:20px;color: #585858">Fotos</b></label>
                  <input id="addPhoto" class="form-control py-1" type="file" id="" name="nome_foto[]" multiple="multiple"/>
                </div>

                <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">

                <input class="form-control py-1" value="Pendente" name="situacao" type="hidden">



                <center><input style="width: 100%;" class="btn btn-primary btn " type="submit" value="Enviar"></center>

            </div>

          </div>
        </div>

      </div>
      <hr class="my-4" />
      </form>
    </div>
  </div>


<script src="/res/admin/js/functions.js"></script>
<script type="text/javascript">observation()</script>  