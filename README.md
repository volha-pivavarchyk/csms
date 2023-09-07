# CSMS task

## Installation
1. Download the repository zip then extract the zip or clone the repository
2. Make a copy of the `.env.dist` file `cp .env.dist .env`. Add needed credentials
3. Optional. Set up access rights for the directories (`var`, `vendor`, `public`) if it is necessary. 
4. `docker-compose up -d` (setup and launch docker containers) or `start.sh` script
5. `docker exec -it bs-php bash` (enter docker php container)

All the following commands are executed inside the docker php container:
1. `composer install` (install php dependencies)
2. `php bin/console doctrine:migrations:migrate` run database migrations. If you get an error, please restart docker: `docker-compose down` > `docker-compose up -d` > `docker exec -it bs-php bash`  

The application can be available via http://localhost:8080/

Send the api request:
POST http://localhost:8080/api/rate

Use `Postman` or any tools to test


## Improvements to the API design

1. Rest API. Create different endpoints for rates and charge records. E.g.,


`GET \rates`


`GET \rates\ID`


`POST \rates` Parameters: energy, time, transaction


`PATCH \rates\ID`


`PUT \rates\ID`

`GET \charge-records`


`GET \charge-records\ID`


`POST \charge-records` Parameters: meterStart, timestampStart, meterStop, timestampStop


`PATCH \charge-records\ID`


`PUT \charge-records\ID`


2. Graph QL. Create separate queries and mutations for rates and charge records. E.g.

`RateQuery`

`CreateRateMutation`


`UpdateRateMutation`


`CdrQuery`


`CreateCdrMutation`


`UpdateCdrMutation`

3. Add detailed documentation explaining the structure and format of the data required for each field in the query