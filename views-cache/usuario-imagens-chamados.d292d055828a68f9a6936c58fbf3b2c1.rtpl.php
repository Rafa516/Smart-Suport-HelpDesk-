<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #01A9DB;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Fotos - Chamado 
                           <?php echo $chamado["value"]; ?><b></a>
                        
                </li>
            </ul>

            <div class="box box-widget">
                <div id="myWorkContent">



                    <?php $counter1=-1;  if( isset($imagens) && ( is_array($imagens) || $imagens instanceof Traversable ) && sizeof($imagens) ) foreach( $imagens as $key1 => $value1 ){ $counter1++; ?>


                    <a class="image-link" href="<?php echo $value1["foto"]; ?>"> <img style="height: 15em;width: 15em" class="photo"
                            id="image-preview" src="<?php echo $value1["foto"]; ?>"></a>

                    <?php } ?>


                </div>
            </div>

            <hr class="my-4" />

            <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>


        </div>
    </div>
</div>