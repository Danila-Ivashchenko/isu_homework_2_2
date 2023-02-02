from inits import BaseModel, secrets


class User(BaseModel):
    user_id: int
    username: str
    token: str


class UsersDb:
    users: list
    users_count: int

    def __init__(self):
        self.users_count = 0
        self.users = []

    def register(self, username):
        registered = False
        for user in self.users:
            if (username == user.username) :
                registered = True
                break
        if (registered):
            return ("response_body", "This user already registered")
        else:
            self.users_count += 1
            token = secrets.token_hex(8)
            self.users.append(User(user_id = self.users_count, username = username, token = token))
            return ("token", token)

    def get_users(self):
        return self.users

