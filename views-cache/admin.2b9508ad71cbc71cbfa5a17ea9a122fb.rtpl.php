<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color:#01A9DB;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Painel de Controle</b></a>
                </li>
            </ul>
             <center><img src="res/user/img/logo.png" class="logo"  alt="">

          <center>
            <!--Widget Start-->
             <a href=""><div class="card-body color" style="background-color:#FF4000">
                <div class="float-left">
                    <h3>
                        <h3>
                            <center><span class="count">Chamados Pendentes</span></center>
                        </h3><b>
                        <br><center> <i class="fas fa-exclamation-triangle" aria-hidden="true"></i></center>
                       
                </div>

            </div></a>
            <!--Widget End-->
            
            <!--Widget Start-->
             <a href=""><div class="card-body color" style="background-color:#3ADF00">
                <div class="float-left">
                    <h3>
                        <h3><b>
                            <center><span class="count">Chamados Finalizados</span></center>
                        </h3>
                        <br><center> <i class="fas fa-check-square" aria-hidden="true"></i></center>
                       
                </div>

            </div></a>
            <!--Widget End-->
            <!--Widget Start-->
            <a href="admin/usuarios"> <div class="card-body color" style="background-color:#0431B4">
                <div class="float-left">
                    <h3>
                        <h3><b>
                            <center><span class="count">Usuários Cadastrados</span></center>
                        </h3>
                        <br><center> <i class="fas fa-users" aria-hidden="true"></i></center>
                        <?php if( totalUsuarios() == 0 ){ ?>

                         <center><p style="font-size: 20px;">Nenhum usuário</p></center>
                        
                        <?php }elseif( totalUsuarios() == 1 ){ ?>

                         <center><p style="font-size: 20px;"><?php echo totalUsuarios(); ?> Usuário</p></center>
                        
                        <?php }else{ ?>

                         <center><p style="font-size: 20px;"><?php echo totalUsuarios(); ?> Usuários</p></center></b>
                        
                        <?php } ?>

                       
                </div>

            </div></a>
            <!--Widget End-->
        </center>

            <hr class="my-4" />


        </div>
    </div>
</div>