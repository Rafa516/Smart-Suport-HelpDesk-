<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #01A9DB;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Solução chamado <?php echo $id_chamado["value_id"]; ?> </b></a>
                </li>
            </ul>

           
           <form class="form-group" action="/admin/chamado/atualizar-solucao/<?php echo $id_chamado["value_id"]; ?>" method="post">

            <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Solução</b></label>
                  <textarea class="form-control py-1" value="" type="text" name="solucao" height="10"><?php echo $solucao["value_solucao"]; ?> </textarea>
                </div>

      

              <input class="btn btn-primary btn btn-block" type="submit" value="Adicionar">
           </form>

        


            <hr class="my-4" />

            <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>

        </div>
    </div>
</div>