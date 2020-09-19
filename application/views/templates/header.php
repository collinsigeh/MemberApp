<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $page_title; ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">

</head>

<body <?php if($this->session->userlogged_in !== '*#loggedin@Yes'){ echo 'class="bg-light"'; } ?>>

  <!-- Navigation -->
  <?php
    if($this->session->userlogged_in == '*#loggedin@Yes')
    { // When logged-in
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-white static-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/img/NUSA_logo.png" alt="NUSA Member Portal" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">DASHBOARD</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" target="_blank">MAIN WEBSITE</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">JOHN OKORO <img src="<?php echo base_url(); ?>assets/img/profile_images/profile_default.png" class="user-image-navbar" /></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">My profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php
    }
    else
    { // When NOT logged-in
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/img/NUSA_logo.png" alt="NUSA Member Portal" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <?php
              if($page_title == 'Reset password' OR $page_title == 'New registration')
              {
              ?>
                <li class="nav-item"><a class="nav-link" href="https://nusa.ng"><< BACK TO MAIN WEBSITE</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard/login/'; ?>">LOGIN</a>
              <?php
              }
              else
              {
              ?>
                <li class="nav-item"><a class="nav-link" href="https://nusa.ng"><< BACK TO MAIN WEBSITE</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard/register/'; ?>">JOIN NUSA</a>
              <?php
              }
            ?>
            
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php
    }
  ?>