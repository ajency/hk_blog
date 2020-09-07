# CMS Service
### Built With
* [PHP](https://www.php.net/)
* [Mysql](https://www.mysql.com/)
* [Wordpress](https://wordpress.org/)

<!-- GETTING STARTED -->
## Getting Started

Please make sure you have the following prerequisites. To get a local copy up and running follow these simple example steps.

### Prerequisites

* PHP

```sh
sudo apt-get install php7.2-cli php7.2-fpm php7.2-curl php7.2-gd php7.2-mysql php7.2-mbstring zip unzip
```
* MYSQL

```sh
sudo apt install mysql-server
```

### Installation

1. Clone the repo 
```sh
git clone https://github.com/The-Morning-Context/tmc-services.git
```
3. Copy the sample config file of wordpress to the base config file
```sh
cp wp-config-sample.php wp-config.php
```
4. Update the wp-config file with your database credentials  
5. Grab secure values from the WordPress secret key generator and paste them in the wp-config
```sh
curl -s https://api.wordpress.org/secret-key/1.1/salt/
```
