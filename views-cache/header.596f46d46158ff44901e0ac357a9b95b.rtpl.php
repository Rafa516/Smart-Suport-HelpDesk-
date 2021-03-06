<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Suport - ADM</title>
  <link href="/../res/admin/img/icon.png" rel="icon">
   <!--style--> 
  <link rel="stylesheet" href="/../res/admin/css/style.css">
  <!--font-awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

  <!--bootstrap-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <!--magnific-popup-->
  <link rel="stylesheet" href="/../res/admin/css/magnific-popup.css">

  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />

</head>

<body>

  <input type="checkbox" id="check">
  <!--header area start-->
  <header>
    <label for="check">
      <i style="margin-top: -5px;" class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
      <h3 style="font-size: 18px;">Suporte Técnico- ADM</h3>
    </div>
    <div class="right_area">
      <a href="/admin/logout" class="logout_btn">Sair</a>
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
       <a href="/admin"><i class="fas fa-desktop"></i><span>Painel de Controle</span></a>
       <a href="/admin/usuarios"><i class="fas fa-users"></i><span>Usuários</span></a>
      <a href="/admin/chamados"><i class="fa fa-table"></i><span>Todos Chamados</span></a>
      <a href="/admin/chamados-capturados"><i class="fa fa-check"></i><span>Chamados capturados</span></a>
      <a href="/admin/perfil"><i class="fas fa-info-circle"></i><span>Meu Perfil</span></a>
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

      <h5 style="font-size: 18px;color: white;"><?php echo getUsuarioNome(); ?></h5>
    </div>
   <a href="/admin"><i class="fas fa-desktop"></i><span>Painel de Controle</span></a>
    <a href="/admin/usuarios"><i class="fas fa-users"></i><span>Usuários</span></a>
      <a href="/admin/chamados"><i class="fa fa-table"></i><span>Todos Chamados</span></a>
      <a href="/admin/chamados-lcapturados"><i class="fa fa-check"></i><span>Chamados capturados</span></a>
      <a href="/admin/perfil"><i class="fas fa-info-circle"></i><span>Meu Perfil</span></a>
  </div>
  <!--sidebar end-->

