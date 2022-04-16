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
                          <div class="card-body">
                           
                            <p class="card-text"><?php echo $solucao["value_solucao"]; ?></p>
                            <button  data-target="#avaliactions" data-toggle="modal" class="btn btn-primary">Avaliar</button>

                          </div>
                          <div class="card-footer text-muted">
                          <b><?php echo formatDate($data_registro["value_data_registro"]); ?></b>
                          </div>
                        </div>


                        <div class="modal" id="avaliactions" tabindex="-1" role="dialog" >
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Avaliar Solução</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">


                         <div  class="rating" >
                                                        <input type="radio" name="rate" value="5" id="5"><label
                                                            for="5">☆</label>
                                                        <input type="radio" name="rate" value="4" id="4"><label
                                                            for="4">☆</label>
                                                        <input type="radio" name="rate" value="3" id="3"><label
                                                            for="3">☆</label>
                                                        <input type="radio" name="rate" value="2" id="2"><label
                                                            for="2">☆</label>
                                                        <input type="radio" name="rate" value="1" id="1" checked><label
                                                            for="1">☆</label>

                                                    </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Avaliar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                          </div>
                        </div>
                      </div>
                    </div>
          

        


            <hr class="my-4" />

            <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>

        </div>
    </div>
</div>