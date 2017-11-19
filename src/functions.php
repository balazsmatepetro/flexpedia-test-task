<?php

declare(strict_types=1);

function redirectToHome()
{
    header('Location: /');
    exit;
}

function sendCsvOutput(string $fileName, string $output)
{
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename=' . $fileName . '.csv');
    header('Content-Length: ' . strlen($output));
    header('Connection: close');

    echo $output;
}
