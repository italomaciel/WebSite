<?php

/**
 * Configuration for database connection
 *
 */

$host       = "sql110.epizy.com";
$username   = "epiz_23877650";
$password   = "rpUw8uhlU1";
$dbname     = "epiz_23877650_users";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );