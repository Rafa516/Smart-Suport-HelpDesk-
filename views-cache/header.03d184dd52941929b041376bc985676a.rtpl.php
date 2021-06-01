<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Smart Suport</title>
 
  <link href="/res/user/img/icon.png" rel="icon">
    <!--style-->
  <link rel="stylesheet" href="/res/user/css/style.css">
  <!--font-awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
   <!--bootstrap-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <!--magnific-popup-->
  <link rel="stylesheet" href="/res/user/css/magnific-popup.css">

  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />

   

</head>

<body>

  <input type="checkbox" id="check">
  <!--header area start-->
  <header>
    <label for="check">
      <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
      
      <h3>Suporte Técnico</h3>
   
    </div>
    <div class="right_area">
      <a href="/usuario/logout" class="logout_btn">Sair</a>
    </div>
  </header>
  <!--header area end-->

  <!--mobile navigation bar start-->
  <div class="mobile_nav">
    <div class="nav_bar">
    <?php if( $usuario["foto"] == 0 ){ ?>

      <img src="/res/ft_perfil/ft_male.png" class="mobile_profile_image" alt="">
      <?php }else{ ?>

       <img src="/res/ft_perfil/<?php echo $usuario["foto"]; ?>" class="mobile_profile_image" alt="">
      <?php } ?>

      <b style="font-size: 17px;color: white;"><?php echo getUsuarioNome(); ?></b>

      <i class="fa fa-bars nav_btn"></i>
    </div>
    <div class="mobile_nav_items">
      <a href="/usuario"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="/usuario/abertura-chamado"><i class="fa fa-plus-circle"></i><span>Registrar Chamado</span></a>
      <a href="/usuario/meus-chamados"><i class="fa fa-table"></i><span>Meus Chamados</span></a>
      <a href="/usuario/perfil"><i class="fas fa-info-circle"></i><span>Meu Perfil</span></a>
    </div>
  </div>
  <!--mobile navigation bar end-->

  <!--sidebar start-->
  <div class="sidebar">
    <div class="profile_info">
     
      <?php if( $usuario["foto"] == 0 ){ ?>

      <img src="/res/ft_perfil/ft_male.png" class="profile_image" alt="">
      <?php }else{ ?>

      <img src="/res/ft_perfil/<?php echo $usuario["foto"]; ?>" class="profile_image" alt="">
      <?php } ?>

      <b style="font-size: 17px;color: white;"><?php echo getUsuarioNome(); ?></b>
     
  
    </div>
    <a href="/usuario"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="/usuario/abertura-chamado"><i class="fa fa-plus-circle"></i><span>Registrar Chamado</span></a>
       <a href="/usuario/meus-chamados"><i class="fa fa-table"></i><span>Meus Chamados</span></a>
      <a href="/usuario/perfil"><i class="fas fa-info-circle"></i><span>Meu Perfil</span></a>
  </div>
  <!--sidebar end-->

