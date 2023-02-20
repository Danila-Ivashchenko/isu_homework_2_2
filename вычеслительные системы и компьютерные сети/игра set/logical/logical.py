from database import Session
from .database_operator import Database_operator

db = Database_operator(Session)

def register(username):
    response: dict
    response = db.add_user(username)
    if list(response.keys())[0] != "detail":
        return {"status": 200, "user": response}
    else:
        return {"status": 201, "log": response}
