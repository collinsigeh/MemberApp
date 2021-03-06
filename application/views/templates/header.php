<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php if(isset($page_title)){ echo $page_title; } ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">

</head>

<body <?php if($this->session->userlogged_in !== '*#loggedin@Yes'){ echo 'class="bg-light"'; } ?>>

<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

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
            <a class="nav-link" href="<?php echo base_url().'dashboard/'; ?>">DASHBOARD</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://nusa.ng" target="_blank">MAIN WEBSITE</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->firstname.' '.$this->session->lastname; ?> <img src="<?php echo base_url().'assets/img/profile_images/'.$this->session->photo; ?>" class="user-image-navbar" /></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="<?php echo base_url().'dashboard/profile/'; ?>">My profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo base_url().'dashboard/logout/'; ?>">Logout</a>
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
              if($page_title == 'Reset password' OR $page_title == 'New registration' OR $page_title == 'New registration - Page 2'  OR $page_title == 'Registration Completed')
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