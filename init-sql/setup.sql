CREATE DATABASE scraping;
USE scraping;

CREATE TABLE prod_info ( 
    prod_id INTEGER AUTO_INCREMENT, 
    prod_title VARCHAR(255), 
    prod_price VARCHAR(255),
    prod_url VARCHAR(255), 
    PRIMARY KEY (prod_id)
);



ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'it635';
CREATE USER 'steve'@'%' IDENTIFIED BY 'it635';
GRANT SELECT ON scraping.prod_info TO 'steve'@'%';
GRANT INSERT ON scraping.prod_info TO 'steve'@'%';
FLUSH PRIVILEGES;