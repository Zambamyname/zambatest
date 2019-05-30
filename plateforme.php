<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8"> 
        <!-- Required meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Material Admin</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="node_modules/mdi/css/materialdesignicons.min.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="images/favicon.png" />
    </head>
    <body>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div id='error msg'>" . $_SESSION['messsage'] . "</div>";
            unset($_SESSION['messqge']);
        }
        ?>   
        <?php
        require_once './connection.php';

        if (isset($_GET['id'])) {
            $Idclient = $_GET['id'];
            $sql_query_select = "SELECT * FROM comptes_3 WHERE ID_client='$Idclient'";
            $result = mysqli_query($link, $sql_query_select);
            if ($result_query = mysqli_fetch_assoc($result)) {

                $sql_query_balance = "SELECT * FROM balance_generale WHERE ID_client='$Idclient'";
                $result_balance = mysqli_query($link, $sql_query_balance);
                if ($result_query_balance = mysqli_fetch_assoc($result_balance)) {


                    $sql_query_transition_dash = "SELECT SUM(Retrait),SUM(Depot) FROM transaction WHERE ID_client='$Idclient'";
                    $result_transition_dash = mysqli_query($link, $sql_query_transition_dash);
                    if ($result_query_transition_dash = mysqli_fetch_assoc($result_transition_dash)) {

                        $sql_query_transition_count = "SELECT COUNT(Retrait) FROM transaction WHERE ID_client='$Idclient'";
                        $result_transition_count = mysqli_query($link, $sql_query_transition_count);
                        if ($result_query_transition_count = mysqli_fetch_assoc($result_transition_count)) {
                            ?>
                            <div class="body-wrapper">
                                <!-- partial:partials/_sidebar.html -->
                                <aside class="mdc-persistent-drawer mdc-persistent-drawer--open">
                                    <nav class="mdc-persistent-drawer__drawer">
                                        <div class="mdc-persistent-drawer__toolbar-spacer">
                                            <a href="plateforme.php?id=<?php echo $result_query['ID_client']; ?>" class="brand-logo">
                                                <img src="images/zambalogo.png" alt="logo">
                                            </a>
                                        </div>
                                        <div class="mdc-list-group">
                                            <nav class="mdc-list mdc-drawer-menu">
                                                <div class="mdc-list-item mdc-drawer-item">
                                                    <a class="mdc-drawer-link" href="plateforme.php?id=<?php echo $result_query['ID_client']; ?>">
                                                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">desktop_mac</i>
                                                        Tableau de bord
                                                    </a>
                                                </div>
                                                <div class="mdc-list-item mdc-drawer-item">
                                                    <a class="mdc-drawer-link" href="pages/forms/mon_profil.php?id=<?php echo $result_query['ID_client']; ?>">
                                                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">track_changes</i>
                                                        Mon Profil
                                                    </a>
                                                </div>
                                                <div class="mdc-list-item mdc-drawer-item" href="#" data-toggle="expansionPanel" target-panel="ui-sub-menu">
                                                    <a class="mdc-drawer-link" href="#">
                                                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">dashboard</i>
                                                        Mes échanges 
                                                        <i class="mdc-drawer-arrow material-icons">arrow_drop_down</i>
                                                    </a>
                                                    <div class="mdc-expansion-panel" id="ui-sub-menu">
                                                        <nav class="mdc-list mdc-drawer-submenu">
                                                            <div class="mdc-list-item mdc-drawer-item">
                                                                <a class="mdc-drawer-link" href="pages/ui-features/Virement_recu.php?id=<?php echo $result_query['Compte']; ?>">
                                                                    Récus
                                                                </a>
                                                            </div>
                                                            <div class="mdc-list-item mdc-drawer-item">
                                                                <a class="mdc-drawer-link" href="pages/ui-features/Virement_envoyer.php?id=<?php echo $result_query['Compte']; ?>">
                                                                    Envoyés
                                                                </a>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <div class="mdc-list-item mdc-drawer-item">
                                                    <a class="mdc-drawer-link" href="pages/ui-features/historiques.php?id=<?php echo $result_query['ID_client']; ?>">
                                                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">grid_on</i>
                                                        Mes opérations
                                                    </a>
                                                </div>
                                                <div class="mdc-list-item mdc-drawer-item">
                                                    <a class="mdc-drawer-link" href="pages/charts/Objets.php?id=<?php echo $result_query['ID_client']; ?>">
                                                        <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">pie_chart_outlined</i>
                                                        Mes contrats
                                                    </a>
                                                </div>

                                                <div class="mdc-list-item mdc-drawer-item purchase-link">
                                                    <a href="" target="_blank" class="mdc-button mdc-button--raised mdc-button--dense mdc-drawer-link" data-mdc-auto-init="MDCRipple">
                                                        DEMANDER 
                                                    </a>
                                                </div>
                                            </nav>
                                        </div>
                                    </nav>
                                </aside>
                                <!-- partial -->
                                <!-- partial:partials/_navbar.html -->
                                <header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
                                    <div class="mdc-toolbar__row">
                                        <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                                            <a href="#" class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>
                                            <span class="mdc-toolbar__input">
                                                <div class="mdc-text-field">
                                                    <input type="text" class="mdc-text-field__input" id="css-only-text-field-box" placeholder="Search anything...">
                                                </div>
                                            </span>
                                        </section>
                                        <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
                                            <div class="mdc-menu-anchor">
                                                <a href="" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="notification-menu" data-mdc-auto-init="MDCRipple">
                                                    <i class="material-icons">notifications</i>
                                                    <span class="dropdown-count"><?php echo $result_query_transition_count['COUNT(Retrait)']; ?></span>
                                                </a>
                                                <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="notification-menu">
                                                    <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                                                        <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                            <a class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="notification-menu" data-mdc-auto-init="MDCRipple" href="pages/ui-features/historiques.php?id=<?php echo $result_query['ID_client']; ?>">  
                                                                <i class="material-icons mdc-theme--primary mr-1">email</i>
                                                                Messages
                                                            </a>
                                                        </li>
                                                       
                                                        <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                            <i class="material-icons mdc-theme--primary mr-1">group</i>
                                                            Contacter votre Banque
                                                        </li>
                                                        <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                            <i class="material-icons mdc-theme--primary mr-1">cake</i>
                                                            Vérifier une opération
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="mdc-menu-anchor">
                                                <a href="#" class="mdc-toolbar__icon mdc-ripple-surface" data-mdc-auto-init="MDCRipple">
                                                    <i class="material-icons">widgets</i>
                                                </a>
                                            </div>
                                            <div class="mdc-menu-anchor mr-1">
                                                <a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="logout-menu" data-mdc-auto-init="MDCRipple">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu">
                                                    <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                                                        <li class="mdc-list-item" role="menuitem" tabindex="0">
                                                            <i class="material-icons mdc-theme--primary mr-1">settings</i>
                                                            Settings
                                                        </li>
                                                        <form action="pages/samples/logout.php" method="POST">
                                                            <li id="seconnecter" class="mdc-list-item" role="menuitem" tabindex="0">
                                                                <a href="pages/samples/logout.php">   <i id="seconnecter" class="material-icons mdc-theme--primary mr-1">power_settings_new</i></a>
                                                                Se deconnecter
                                                            </li>
                                                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </header>
                                <!-- partial -->
                                <div class="page-wrapper mdc-toolbar-fixed-adjust">
                                    <main class="content-wrapper">
                                        <div class="mdc-layout-grid">
                                            <div class="mdc-layout-grid__inner">
                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                    <div class="mdc-card">
                                                        <div class="mdc-layout-grid__inner">
                                                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-7">
                                                                <section class="purchase__card_section">

                                                                    <p> Salut <?php echo $result_query['Prenom'] ?></p>
                                                                    <p>Vous avez peut-être des nouvelles de la Banque, veuillez commencer par vérifier le mouvement de votre compte.</p>
                                                                </section>
                                                            </div>
                                                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-5">

                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8">
                                                    <div class="mdc-layout-grid__inner">
                                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                                            <div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
                                                                <div class="mdc--tile mdc--tile-danger rounded">
                                                                    <i class="mdi mdi-account-settings text-white icon-md"></i>
                                                                </div>
                                                                <div class="text-wrapper pl-1">
                                                                    <h3 class="mdc-typography--display1 font-weight-bold mb-1"><?php echo $result_query['ID_client']; ?></h3>
                                                                    <p class="font-weight-bold mb-1 mt-1">Mon numéro de compte</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                                            <div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
                                                                <div class="mdc--tile mdc--tile-success rounded">
                                                                    <button class="bg-red" type="submit">
                                                                        <i class="mdi mdi-autorenew text-white icon-md"><a href="index.php?id=<?php echo $result_query['ID_client']; ?>"></a></i>
                                                                    </button>
                                                                </div>

                                                                <div class="text-wrapper pl-1">
                                                                    <h3 class="mdc-typography--display1 font-weight-bold mb-1"><?php echo $result_query_balance['Solde']; ?> <?php echo $result_query_balance['Konto_currency']; ?></h3>
                                                                    <p class="font-weight-bold mb-1 mt-1"><h4>Solde du compte</h4></p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                                            <div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
                                                                <div class="mdc--tile mdc--tile-warning rounded">
                                                                    <i class="mdi mdi-ticket text-white icon-md"></i>
                                                                </div>
                                                                <div class="text-wrapper pl-1">
                                                                    <h3 class="mdc-typography--display1 font-weight-bold mb-1"><?php echo $result_query_transition_dash['SUM(Retrait)']; ?> <?php echo $result_query_balance['Konto_currency']; ?></h3>
                                                                    <p class="font-weight-normal mb-0 mt-0">Dépenses</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                                            <div class="mdc-card py-3 pl-2 d-flex flex-row align-item-center">
                                                                <div class="mdc--tile mdc--tile-primary rounded">
                                                                    <i class="mdi mdi-forum text-white icon-md"></i>
                                                                </div>
                                                                <div class="text-wrapper pl-1">
                                                                    <h3 class="mdc-typography--display1 font-weight-bold mb-1"><?php echo $result_query_transition_dash['SUM(Depot)']; ?> <?php echo $result_query_balance['Konto_currency']; ?></h3>
                                                                    <p class="font-weight-normal mb-0 mt-0">Les entrées</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                                                    <div class="mdc-card d-flex flex-column">
                                                        <div class="mdc-layout-grid__inner flex-grow-1">
                                                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3"></div>
                                                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 d-flex align-item-center flex-column">
                                                                <h2 class="mdc-card__title mdc-card__title--large text-center mt-2 mb-2">Time, Practice</h2>
                                                                <!--   
                                                                <?php
                                                                ?><div id="currentBalanceCircle" class="w-100"></div>-->
                                                                <img src=" <?php echo $result_query['Rout_e']; ?>" alt=""/>
                                                            </div>
                                                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3"></div>
                                                        </div>
                                                        <div class="mdc-layout-grid__inner">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8">
                                                    <div class="mdc-card px-2 py-2">
                                                        <div id="js-legend" class="chartjs-legend mb-2"></div>
                                                        <canvas id="dashboard-monthly-analytics" height="205"></canvas>
                                                    </div>
                                                </div>
                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                                    <div class="mdc-card table-responsive">
                                                        <div class="table-heading px-2 px-1 border-bottom">
                                                            <h1 class="mdc-card__title mdc-card__title--large">Mes opérations</h1>
                                                        </div>
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">Date</th>
                                                                    <th class="text-center">Ordre</th>
                                                                    <th class="text-center">Balance</th>
                                                                    <th class="text-center">Dépôt</th>
                                                                    <th class="text-center">Retrait</th>
                                                                    <th class="text-center">Entrées</th>
                                                                    <th class="text-center">Sorties</th>
                                                                    <th class="text-center">Solde</th>
                                                                    <th class="text-center">Heure</th>
                                                                    <th class="text-center">Détails</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                    <?php
                    if (isset($_GET['id'])) {
                        $Idclient = $_GET['id'];
                        $sql_query_transition = "SELECT * FROM transaction WHERE ID_client='$Idclient'";
                        $result_transition = mysqli_query($link, $sql_query_transition);
                        while ($row = mysqli_fetch_assoc($result_transition)) {
                            ?>
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $row['Date_jour']; ?></td>
                                                                            <td class="text-center"><?php echo $row['Operation']; ?></td>
                                                                            <td class="text-center"><?php echo $row['Balance_auxiliaire']; ?></td>
                                                                            <td class="text-center"><?php echo $row['Depot']; ?></td>
                                                                            <td class="text-center"><?php echo $row['Retrait']; ?></td>
                                                                            <td class="text-center"><?php echo $row['Virement_entrant']; ?></td>
                                                                            <td class="text-center"><?php echo $row['Virement_sortant']; ?></td>
                                                                            <td class="text-center"><?php echo $row['Solde']; ?></td>
                                                                            <td class="text-center"><?php echo $row['Heure']; ?></td>
                                                                            <td class="text-center"><div class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-heart text-blue"></i></div><div class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-forum text-yellow"></i></div><div class="col mdc-button" data-mdc-auto-init="MDCRipple"><i class="mdi mdi-delete text-red"></i></div></td>
                                                                        </tr>
                        <?php } ?>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </main>
                                    <!-- partial:partials/_footer.html -->
                                    <footer>
                                        <div class="mdc-layout-grid">
                                            <div class="mdc-layout-grid__inner">
                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                                                    <span class="text-muted">Copyright © 2019 <a class="text-green" href="" target="_blank">ZAMBA APP</a>. All rights reserved.</span>
                                                </div>
                                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 d-flex justify-content-end">
                                                    <span class="mt-0 text-right">   <i class="mdi mdi-heart text-red"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </footer>
                                    <!-- partial -->
                                </div>
                            </div>
                            <!-- body wrapper -->
                            <!-- plugins:js -->
                            <script src="node_modules/material-components-web/dist/material-components-web.min.js"></script>
                            <script src="node_modules/jquery/dist/jquery.min.js"></script>
                            <!-- endinject -->
                            <!-- Plugin js for this page-->
                            <script src="node_modules/chart.js/dist/Chart.min.js"></script>
                            <script src="node_modules/progressbar.js/dist/progressbar.min.js"></script>
                            <!-- End plugin js for this page-->
                            <!-- inject:js -->
                            <script src="js/misc.js"></script>
                            <script src="js/material.js"></script>
                            <!-- endinject -->
                            <!-- Custom js for this page-->
                            <script src="js/dashboard.js"></script>
                            <!-- End custom js for this page-->
                <?php } ?>  
                    <?php } ?>   
                <?php } ?>   
            <?php } ?>  
        <?php } ?>   
    </body>

</html>