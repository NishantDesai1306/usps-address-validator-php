
This is a small app which performs address validation (powered by USPS) and saves the address into database.

  
## Prerequisite software

1. PHP - Install PHP from https://www.php.net/manual/en/install.php

2. MySQL server - download and install MySQL server from https://dev.mysql.com/downloads/mysql/

3. MySQL client - Any GUI client helps in viewing the database (personal I prefer DBeaver which you can download from https://dbeaver.io/) 
  

## Getting Started
1. Clone the repo.
2. Update `$server`, `$username`, `$password` in `helper/database.php` according to your local MySQL setup.
3. run php server in the directory by doing `php -S localhost:4000`
4. Open http://localhost:4000 in the browser.

Dummy address for testing
```
Address Line 1: Suite 6100
Address Line 2: 185 Berry St
City: San Francisco
State: California
Zip: 94556
```

## Screenshots
Home page
![address-form](https://raw.githubusercontent.com/NishantDesai1306/usps-address-validator-php/images/home.png)

Verify page
![verify-page](https://raw.githubusercontent.com/NishantDesai1306/usps-address-validator-php/images/verify.png)

Saved page
![saved](https://raw.githubusercontent.com/NishantDesai1306/usps-address-validator-php/images/saved.png)

Validate record insertion in database
![database-client](https://raw.githubusercontent.com/NishantDesai1306/usps-address-validator-php/images/dbeaver.png)
