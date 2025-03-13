![img](public/images/logo.png)

![license](https://img.shields.io/github/license/AppHealer/AppHealer?style=for-the-badge)
![Last commit](https://img.shields.io/github/last-commit/AppHealer/Apphealer?style=for-the-badge)
![activity](https://img.shields.io/github/commit-activity/m/AppHealer/AppHealer?style=for-the-badge)
![github stars](https://img.shields.io/github/stars/AppHealer/Apphealer?style=for-the-badge)

[https://apphealer.io](https://apphealer.io)

[Facebook](https://www.facebook.com/apphealer/) \
[LinkedIn](https://www.linkedin.com/company/apphealer)

# About
Apphealer is webapps Uptime Monitor, written in Laravel (PHP). 
It's fully dockerized - that means it runs fully in docker, 
so there is no need to install & configure webserver, php etc...

# Installation

## Prerequisites
 - downloaded or cloned this repo
 - installed docker compose

## Installation steps
 - build & run docker container with this command
```shell
docker compose up
```

 - open browser and type address (host or ip) of server with your running AppHealer
container, port 8081 (e.g. https:/apphealer.yourserver.com:8081)
 - set up correct timezone, SMTP settings (for sending emails) and click save
 - create first user!

   [more at](https://apphealer.io/documentation/installation)



