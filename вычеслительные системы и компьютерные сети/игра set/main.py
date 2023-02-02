from inits import *
from logical import Action, register, get_users
from user.users import UsersDb

users_db = UsersDb()

app = FastAPI(
    title="Example"
)

@app.post('/')
def do_action(request_body: Action):
    action = request_body.action.value
    response: str
    if (action == "register"):
        username = request_body.username
        response = register(users_db, username)
    elif (action == "get_users"):
        response = get_users(users_db)
    else:
        response = {"status": 200}
    return response



