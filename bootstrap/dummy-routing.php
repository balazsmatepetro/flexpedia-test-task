<?php

$get = &$_GET;
$server = &$_SERVER;

$container = require 'dummy-container.php';

$route = isset($get['route']) ? $get['route'] : 'main';

switch ($route) {
    case 'main':
        try {
            $page = isset($get['page']) ? (int)$get['page'] : 1;

            if (0 === $page) {
                throw new Exception('Invalid page!');
            }
            
            echo $container['invoice_list']($page);
        } catch (Exception $ex) {
            redirectToHome();
        }

        break;

    case 'invoice-report':
        sendCsvOutput('invoice-report', $container['invoice_report']());
        break;

    case 'customer-report':
        sendCsvOutput('customer-report', $container['customer_report']());
        break;

    default:
        redirectToHome();
        break;
}

exit;
