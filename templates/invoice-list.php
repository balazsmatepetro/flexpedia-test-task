<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Flexpedia Test Task</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style type="text/css">
    .col-status {
        width: 120px;
    }

    .container nav {
        text-align: center;
    }

    .col-status > .btn {
        text-transform: uppercase;
        width: 100%;
    }

    .pagination {
        margin-top: 0;
    }

    .report-section {
        margin: 20px 0;
    }

    .site-heading {
        margin: 20px 0 40px 0;
        padding: 0;
    }
    </style>
</head>

<body class="container">
    <h1 class="site-heading">Invoice List</h1>

    <div class="report-section">
        <a class="btn btn-primary" href="/?route=customer-report">
            <i class="glyphicon glyphicon-user"></i>
            Customer Report
        </a>

        <a class="btn btn-primary" href="/?route=invoice-report">
            <i class="glyphicon glyphicon-list-alt"></i>
            Invoice Report
        </a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Status</th>
                    <th class="text-right">Created At</th>
                    <th class="col-status">&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($invoices as $invoice) { ?>
                <tr>
                    <td><?php echo $invoice->getId(); ?></td>
                    <td><?php echo $invoice->getClient(); ?></td>
                    <td class="text-center"><?php echo $invoice->getAmountWithVat(); ?></td>
                    <td class="text-center"><?php echo ucfirst($invoice->getStatus()); ?></td>
                    <td class="text-right"><?php echo $invoice->getCreatedAt()->format('Y-m-d'); ?></td>
                    <td class="col-status">
                        <?php if ($invoice->isPaid()) { ?>
                        <button class="btn btn-danger" type="button">Mark as Unpaid</button>
                        <?php } else { ?>
                        <button class="btn btn-success" type="button">Mark as Paid</button>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for($i = 1; $i <= $numberOfPages; $i++) { ?>
            <li>
                <a href="/?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
            <?php } ?>
        </ul>
    </nav>
</body>
</html>
