<html>
<head>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />

  <title>Dashboard - Admin | POLTEKKES SURABAYA</title>

  <meta name="description" content="" />
  <meta name="csrf_token" content="{{ csrf_token() }}" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset ('assets2/img/icons/Logo Poltekkes Surabaya.png') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
  />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset ('assets2/vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset ('assets2/css/loading.css') }}">
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset ('assets2/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset ('assets2/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset ('assets2/css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset ('assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

  <link rel="stylesheet" href="{{ asset ('assets2/vendor/libs/apex-charts/apex-charts.css') }}" />

  <!-- Page CSS -->

  <style type="text/css">
    #customers {
      border-collapse: collapse;
  }

  #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 12px 8px 12px 8px;
      font-size: 12px;
  }


  #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #696cff;
      color: white;
  }

  .btn-block {
      display: block;
      width: 100%;
  }

  .btn-block+.btn-block {
   margin-top: 0.5rem;
}

input[type="submit"].btn-block,
input[type="reset"].btn-block,
input[type="button"].btn-block {
   width: 100%;
}
</style>

<!-- Helpers -->
<script src="{{ asset ('assets2/vendor/js/helpers.js') }}"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset ('assets2/js/config.js') }}"></script>
</head>
<div class="loading" style="display: none;">Loading&#8230;</div>
<body>
  {{ csrf_field() }}
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <input type="hidden" id="rolex" value="{{ Auth::user()->role_id }}">
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="/home" class="app-brand-link">

            <img src="/assets2/img/icons/Logo Poltekkes Surabaya.png" width="20%">

            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="padding-left: -20px;">POLKESBAYA</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>