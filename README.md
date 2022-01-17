# Friends

Steps to follow :
Run project :
1. `docker-compose up -d --build`

Import migrations / fixtures (Random generated)

2. `docker exec -it php bin/console doctrine:migrations:migrate`

3. `docker exec -it php bin/console doctrine:fixtures:load`

Example url :
User list :
`http://localhost/users/list`

Handshake ->
User A (user_id) User B (user_id)

`http://localhost/?userA=6043&userB=7502`
