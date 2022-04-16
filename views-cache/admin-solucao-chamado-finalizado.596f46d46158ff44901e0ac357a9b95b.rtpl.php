<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #01A9DB;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Solução chamado <?php echo $id_chamado["value_id"]; ?> </b></a>
                </li>
            </ul>

                     <div class="card text-center">
                          <div class="card-header">
                            <b><?php echo $problema["value_problema"]; ?></b>
                          </div>
                          <div>
                           
                            <p class="card-text"><?php echo $solucao["value_solucao"]; ?></p>
                            
                          </div>
                          <div class="card-footer text-muted">
                          <b><?php echo formatDate($data_registro["value_data_registro"]); ?></b>
                          </div>
                        </div>
          

        


            <hr class="my-4" />

            <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>

        </div>
    </div>
</div>