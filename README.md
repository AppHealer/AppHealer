# About
Apphealer is webapps Uptime Monitor, written in Laravel (PHP). 
It is fully dockerized - that means it runs fully in docker, 
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



