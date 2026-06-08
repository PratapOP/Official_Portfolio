<?php

require_once 'includes/config.php';

$data = getPortfolio();

echo $data['personal']['name'];