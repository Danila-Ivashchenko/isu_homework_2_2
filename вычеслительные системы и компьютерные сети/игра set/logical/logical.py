
def register(users_db, username):
    response: str
    response = users_db.register(username)
    return {"status": 200, response[0]: response[1]}

def get_users(users_db):
    return {"status": 200,
            "users": users_db.get_users()
            }
