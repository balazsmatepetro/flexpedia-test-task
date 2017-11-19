# PHP Invoicing System

## The goal
Without using a PHP framework or third party packages of any sort, build a PHP application that connects to the provided database and allows it's users to perform the following tasks:

- List the invoices from the database table into an HTML paginated table, having 5 records per page.
- Export the transactions as a CSV file. The export should be in the following format: (Invoice ID, Company Name, Invoice Amount)
- Export a CSV customer report. The export should be in the following format: (Company Name, Total Invoiced Amount, Total Amount Paid, Total Amount Outstanding)


## To run the application:
```shell
vagrant up
```

The application will be available on this URL: http://192.168.60.10/

## To run unit tests
```shell
vagrant ssh
cd /var/www
php vendor/bin/phpunit
```
