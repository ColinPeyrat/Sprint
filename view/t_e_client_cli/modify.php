<?php
$client = new T_E_CLIENT_CLI($_SESSION['user']->cli_id);
$client->displayModifyInfo();