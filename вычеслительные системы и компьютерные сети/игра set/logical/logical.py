from database import Session
from .database_operator import Database_operator

db = Database_operator(Session())


def register(username):
    response: dict
    response = db.add_user(username)
    return {"status": 200, 'user': response}
