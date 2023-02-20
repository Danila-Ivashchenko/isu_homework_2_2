import secrets
from sqlalchemy.orm import sessionmaker
from models import User
from models import User
from database import Session


class Database_operator:
    session_maker: sessionmaker

    def __init__(self, session_maker: sessionmaker):
        self.session_maker = session_maker

    def add_user(self, username: str) -> dict:
        response: dict
        if not (self.cheek_user_user_registered(username)):
            with self.session_maker() as session:
                session.begin()
                try:
                    user = User(username, secrets.token_hex(8))
                    session.add(user)
                    user = list(session.new)[0]
                    response = user.to_json()
                except:
                    session.rollback()
                    response = {"detail": "Something bad"}
                else:
                    session.commit()
        else:
            response = {"detail": "This username is already registered"}
        return response

    def cheek_user_user_registered(self, username: str) -> bool:
        with self.session_maker() as session:
            user_count = session.query(User).filter(User.username == username).count()
            return user_count != 0
