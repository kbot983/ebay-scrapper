

<h3 align="center">Ebay Scrapper</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
</div>

---

<p align="center"> Track price for your favourite products on ebay and get updated if price goes down
    <br> 
</p>

## 📝 Table of Contents

- [About](#about)
- [Getting Started](#getting_started)
- [Deployment](#deployment)
- [Built Using](#built_using)
- [Updates](#updates)
- [Acknowledgments](#acknowledgement)

## 🧐 About <a name = "about"></a>

I always wanted to track prices of products and try scraping the internet for good intentions. I saw this opportunity as a blend between things I wanted. Also additionally in theory if more people use this product we can have more data regarding people about their wants and can be used for targeted advertising.

It is a web based product hence it is very easy to use and built using docker since there are many different components needed to communicate with each other in order to do scrap prices from ebay, updating the database and also updating users.


## 🏁 Getting Started <a name = "getting_started"></a>

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See [deployment](#deployment) for notes on how to deploy the project on a live system.

### Prerequisites

You will need following installed on your system to run this project.

1. **Git**<br/>
    It is only needed to download your project from git. If not installed you can directly download project from Github.

2. ~~**dos2unix package**<br/>~~
    ~~It is requierd to change the line formating for Windows users because Github automatically converts files into `CRLF` format when you pull it. This comes with Git bash if you have it installed.~~

3. **Docker Desktop or docker bash**<br/>
    Docker provides the application environment and downloads require package to run everything on your system. Docker needs Windows Professional or Windows Education to install. Windows home users can use [Docker toolbox](https://docs.docker.com/toolbox/toolbox_install_windows/).

### What does each service do ?

If you see *[docker-compose.yml](https://github.com/kbot983/ebay-scrapper/blob/master/docker-compose.yml)*, there are 6 services that make the entire project run. Lets go and see what each services is and how it is used in project. 

- **db**<a name="db"></a><br/>

  ```yml
  image: mysql
  command: --default-authentication-plugin=mysql_native_password --innodb_use_native_aio=0
  volumes: 
      - ./init-sql:/docker-entrypoint-initdb.d
  environment:
      MYSQL_ROOT_PASSWORD: it635
  ```

  It uses [MySQL](https://hub.docker.com/_/mysql/) image and as the name suggest is a MySQL database image used for relational database storage retrival and management. I also have a entrypoint base SQL file to setup database and populate database with exisiting data. SQL file can be found [here](https://github.com/kbot983/ebay-scrapper/blob/master/init-sql/setup.sql)

- **php**<a name="php"></a><br/>

  ```yml
  build: php-apache-mysqli
  ports:
      - 8888:80
  volumes:
      - ./html:/var/www/html/
  ```
  This is a web server used to host HTML and PHP pages. Build specifies that I have a custom [build](https://github.com/kbot983/ebay-scrapper/blob/master/php-apache-mysqli/Dockerfile) for my PHP server. For PHP I took the base [php]() image and on top of that added `cURL` and added needed packages for mailhog to work. Since I dont have a SMTP server I had to simulate email for PHP. Hence a [mailhog](#mailhog) service acts as a SMTP server for php. and displays it on a webpage. I have also added port fowarding and mounted volumes of my html folder into the hosting folder inside container. 

- **adminer**<a name="adminer"></a><br/>

  ```yml
  image: adminer
  ports: 
      - 8080:8080
  ```

  Adminer is a lightweight database management web tool to handle mysql mangaement. Setup is also simple, I just took a [adminer]() image and buit it. Also I did portfowarding and it is setup and ready to use. 

- **python**<a name="python"></a><br/>

  ```yml
  build: py
  ports:
      - 5000:5000
  volumes: 
      - ./py:/py
  ```
  Python actually does the web scraping part it just finds price and title of the product when a url is provided. There is internal `REST` API calls going on with [python](#python), [php](#php) and [cron](#cron) services. Python is run as a flask server and also to develop python enviornment I have a docker file that setups environment for python. I used base [python]() iamge and installed required packages that my [app.py](https://github.com/kbot983/ebay-scrapper/blob/master/py/app.py) needs, also I did some additional configuration to set timezone to `EST` since the `HTTPS` request goes to ebay servers and sometimes `HTTPS` does not work properly because of time errors such as [this](https://support.mozilla.org/en-US/kb/troubleshoot-time-errors-secure-websites)

- **mailhog**<a name="mailhog"></a><br/>

  ```yml
  image: mailhog/mailhog:v1.0.0
  ports:
    - "1025:1025"
    - "8025:8025"
  ```

  Mailhog just simulates mailsender in php and provides with a webpage where you can see all the emails that [php](#php) server sent. It requires two ports `1025` port number is used for SMTP simulation and `8025` port number is used for accessing web pages.

- **cron_simulate**<a name="cron"></a><br/>

  ```yml
  build: cron
  ```
  I initially thought for docker to not include `cron job` and do cron externally. But the requirement of project was to `docker-compose up` and everything should be setup and Windows does not have cron. I tried putting `cron job` with PHP server since I just need to invoke [`scrapper.php`](https://github.com/kbot983/ebay-scrapper/blob/master/html/scrapper.php) that also communicates with python but it didnt seem to work additionally by standards one docker container should perform only single job. Therefore I created a cron service by using [ubuntu]() image, added needed packages and a [cron file](https://github.com/kbot983/ebay-scrapper/blob/master/cron/hello-cron) that invokes [`scrapper.php`](https://github.com/kbot983/ebay-scrapper/blob/master/html/scrapper.php).  

## 🚀 Deployment <a name = "deployment"></a>

Since application environment is developed by docker and automated scripts. There is only little to do before you can start the project running. 
1. Downloading files fromn git
```shell
git clone https://github.com/kbot983/ebay-scrapper.git
```
2.  ~~Converting cron file to `LF` format for Linux container to understand. Cron fails silently if this step is not done and in turn entire web scraping fails since prices are not updated.~~
```shell
dos2unix cron/hello-cron 
```
>I will make sure I remove this additional command and hence entire project can be deployed by one command.

3. Create and start docker
```shell
docker-compose up
```

Docker will build containers, download all applications needed and setup a seperate environment for each services. Project is successfully deployed. 

All services can be accessed at following url:

- Website: <localhost:8888>
- Adminer: <localhost:8080>
- Mailhog: <localhost:8025>

## ⛏️ Built Using <a name = "built_using"></a>

- [Docker](https://www.docker.com/) - Server Environment
- [MySQL](https://www.mysql.com/) - Database
- [PHP](https://www.php.net/) - Web Framework
- [Python](https://www.python.org/) - Web Scrapper

## 🆕 Updates <a name = "updates"></a>

- `dos2unix` is now not needed as dependency. I change file formatting inside cron service before enabling `cronjob`.

## 🎉 Acknowledgements <a name = "acknowledgement"></a>

- Shoutout to my professor [@rxt1077](https://github.com/rxt1077) for teaching me Docker and being the best professor in my life.

