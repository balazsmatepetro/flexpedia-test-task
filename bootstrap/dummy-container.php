<?php

use Flexpedia\CustomerReport;
use Flexpedia\Invoice\InvoiceList;
use Flexpedia\Invoice\InvoiceReport;
use Flexpedia\Invoice\Repository\InvoiceRepository;
use Flexpedia\InvoiceItem\Repository\InvoiceItemRepository;

$container = [];
$container['pdo'] = new PDO('mysql:host=localhost;dbname=scotchbox', 'root', 'root');
$container['invoice_item_repository'] = new InvoiceItemRepository($container['pdo']);
$container['invoice_repository'] = new InvoiceRepository($container['pdo'], $container['invoice_item_repository']);
$container['invoice_list'] = new InvoiceList($container['invoice_repository']);
$container['invoice_report'] = new InvoiceReport($container['invoice_repository']);
$container['customer_report'] = new CustomerReport($container['invoice_repository']);

return $container;
