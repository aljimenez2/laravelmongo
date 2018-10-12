#!/bin/bash
mongo --eval "mongo users; db.createCollection('new_collection');"