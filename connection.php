<?php
 $link = mysqli_connect("rdsrdcnewinstance.c1vj83ko4fcl.us-east-1.rds.amazonaws.com", "root", "Diakanua12", "entreprise_des_administrateurs");

        if (!$link) {
            echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
            echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
            echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
      
        echo "Succès : Une connexion correcte à MySQL a été faite! La base de donnée my_db est génial." . PHP_EOL;
        echo "Information d'hôte : " . mysqli_get_host_info($link) . PHP_EOL;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

