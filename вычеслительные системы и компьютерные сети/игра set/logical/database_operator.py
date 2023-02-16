import secrets
from sqlalchemy.orm import sessionmaker
from models import User
from models import User
from database import Session


class Database_operator:
    session_maker: sessionmaker

    def __init__(self, session_maker: sessionmaker):
        self.session_maker = session_maker

    def add_user(self, username: str) -> User:
        session = self.session_maker()
        user = User(username, secrets.token_hex(8))
        session.add(user)
        user = session.new
        session.commit()
        print(list(user)[0], type(user))
        return list(user)[0].to_json()

    def cheek_user_user_registered(self, username: str) -> bool:
        flag = False

