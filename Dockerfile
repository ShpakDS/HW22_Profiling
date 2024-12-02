FROM php:8.2-cli

WORKDIR /var/www/html

COPY ./src /var/www/html/src
COPY ./tests /var/www/html/tests
COPY ./results /var/www/html/results

CMD ["php", "tests/test_operations.php"]