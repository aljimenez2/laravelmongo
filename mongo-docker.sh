# connect to local mongo
# bash into the container
docker exec -it mongodbs bash

# connect to local mongo
use users
db.createCollection(users)