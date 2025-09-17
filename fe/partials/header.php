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
    <link href="assets/css/custom.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/neptune.png" />
    <style>
        .app-header .navbar {
            min-height:70px;
            height:auto !important;
        }

        @media (max-width: 991.98px) {
            .horizontal-menu .app-header .navbar .navbar-nav {
                flex-direction: column !important; /* susun ke bawah */
            }
        }

        table td, table th {white-space: nowrap;}
        /* Card style untuk wrapper */
        .dataTables_wrapper {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
        background: #fdfdfd;
        }

        table.dataTable tbody tr:hover {
        background: #f1f5f9;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }

        /* Table cells */
        table.dataTable tbody td {
        padding: 10px;
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
        }

        /* Highlight kolom tertentu */
        table.dataTable tbody td:nth-child(2) { /* No Ticket */
        font-weight: 600;
        color: #1e40af;
        }
        table.dataTable tbody td:nth-child(5) { /* No Kendaraan */
        font-weight: 600;
        color: #047857;
        }

        .dataTables_paginate {
        display: flex;
        overflow-x: auto;
        gap: 4px;
        }

        .dataTables_paginate .paginate_button {
        flex: 0 0 auto; /* biar ukuran tetap */
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
    </style>
</head>
<body>
    <div class="app horizontal-menu align-content-stretch d-flex flex-wrap">
        <div class="app-container">
            <div class="search container">
                <form>
                    <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
                </form>
                <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
            </div>
            <div class="app-header">
                <nav class="navbar navbar-light navbar-expand-lg container">
                    <div class="container-fluid">
                        <!-- Logo -->
                        <div class="logo">
                        <a href="/dashboard" class="navbar-brand">Neptune</a>
                        </div>

                        <!-- Toggler button -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar items -->
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Applications</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="/reports">Reports</a>
                            </li>
                            <?php if(auth()['level'] == 'admin'): ?>
                            <li class="nav-item">
                            <a class="nav-link" href="/users">Users</a>
                            </li>
                            <?php endif ?>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="languageDropDown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="material-icons-outlined">person</i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropDown">
                                <li><a class="dropdown-item" href="#">Hai, <?= auth()['name']?></a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>

            </div>