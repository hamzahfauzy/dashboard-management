<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Neptune - Dashboard Management</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="assets/plugins/datatables/datatables.min.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="assets/css/main.min.css" rel="stylesheet">
    <link href="assets/css/horizontal-menu/horizontal-menu.css" rel="stylesheet">
    <link href="assets/css/custom.css?v=1" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/neptune.png" />
    <style>
        body {
            background-color: #e7ecf8;
        }

        .app-header .navbar {
            min-height: 70px;
            height: auto !important;
        }

        @media (max-width: 991.98px) {
            .horizontal-menu .app-header .navbar .navbar-nav {
                flex-direction: column !important;
                /* susun ke bawah */
            }
        }

        table td,
        table th {
            white-space: nowrap;
        }

        /* Card style untuk wrapper */
        .dataTables_wrapper {
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            font-family: 'Inter', 'Poppins', sans-serif;
            font-size: 14px;
            color: #333;
        }

        /* Table header */
        table.dataTable thead th {
            background: #f9fafb;
            font-weight: 600;
            padding: 12px 10px;
            border-bottom: 2px solid #e5e7eb;
        }

        /* Table rows */
        table.dataTable tbody tr {
            background: #fff;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
        }

        table.dataTable tbody tr:nth-child(even) {
            background: #D3F3F5;
        }

        table.dataTable tbody tr:hover {
            background: #f1f5f9;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        }

        /* Table cells */
        table.dataTable tbody td {
            padding: 10px;
            vertical-align: middle;
            border-top: 1px solid #f1f5f9;
        }

        /* Highlight kolom tertentu */
        table.dataTable tbody td:nth-child(2) {
            /* No Ticket */
            font-weight: 600;
            color: #1e40af;
        }

        table.dataTable tbody td:nth-child(5) {
            /* No Kendaraan */
            font-weight: 600;
            color: #047857;
        }

        .dataTables_paginate {
            display: flex;
            overflow-x: auto;
            gap: 4px;
        }

        .dataTables_paginate .paginate_button {
            flex: 0 0 auto;
            /* biar ukuran tetap */
        }

        /* Length & Search box */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 6px 10px;
            outline: none;
            transition: border 0.2s;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 1px #2563eb;
        }

        #sidebar {
            z-index: 1000;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="collapse show sidebar h-100 border border-right border-top-0 col-md-3 col-lg-2 p-0 bg-white position-fixed" id="sidebar">

                <div class="bg-dark-primary py-4 mb-3 text-center">
                    <a class="text-white text-decoration-none" href="#">
                        Dashboard Management
                    </a>
                </div>

                <ul class="nav flex-column gap-2">
                    <li class="nav-item" v-for="menu in menus">
                        <a href="/dashboard" class="nav-link d-flex align-items-center gap-2 py-3 <?= basename($_SERVER['REQUEST_URI']) == 'dashboard' ? 'bg-primary text-white' : 'text-dark' ?>" aria-current="page">
                            <i class="material-icons-outlined">dashboard</i>
                            Applications
                        </a>
                    </li>
                    <li class="nav-item" v-for="menu in menus">
                        <a href="/reports" class="nav-link d-flex align-items-center gap-2 py-3 <?= basename($_SERVER['REQUEST_URI']) == 'reports' ? 'bg-primary text-white' : 'text-dark' ?>" aria-current="page">
                            <i class="material-icons-outlined">article</i>
                            Reports
                        </a>
                    </li>
                    <?php if (auth()['level'] == 'admin'): ?>
                        <li class="nav-item" v-for="menu in menus">
                            <a href="/users" class="nav-link d-flex align-items-center gap-2 py-3 <?= basename($_SERVER['REQUEST_URI']) == 'users' ? 'bg-primary text-white' : 'text-dark' ?>" aria-current="page">
                                <i class="material-icons-outlined">people</i>
                                Users
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>

            <header class="navbar sticky-top flex-md-nowrap p-3 bg-primary col-md-9 ms-sm-auto col-lg-10">
                <div class="d-flex gap-3 text-white align-items-center">
                    <i class="material-icons-outlined" id="sidebar-btn">menu</i>
                    <ol class="breadcrumb text-white m-0 p-0">
                        <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
                        <li class="breadcrumb-item text-capitalize">Dashboard Management</li>
                    </ol>
                </div>
                <ul class="navbar-nav flex-row px-3" style="gap: 20px">
                    <li class="nav-item text-nowrap">
                        <button class="btn px-0 d-flex gap-2 align-items-center text-white">
                            <i class="material-icons-outlined">person</i>
                            <span>
                                Hai, <?= auth()['name'] ?>
                            </span>
                        </button>
                    </li>
                    <li class="nav-item text-nowrap d-flex">
                        <a href="/logout" class="btn btn-danger btn-sm d-flex gap-2 align-items-center">
                            <span>
                                Log Out
                            </span>
                        </a>
                    </li>
                </ul>
            </header>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-5">