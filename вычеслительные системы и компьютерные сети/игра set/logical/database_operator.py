import secrets
from sqlalchemy.orm import sessionmaker
from models import User
from models import User
from database import Session


class Database_operator:
    session: Session

    def __init__(self, session: Session):
        self.session = session

    def add_user(self, username: str) -> User:
        user = User(username, secrets.token_hex(8))
        self.session.add(user)
        self.session.commit()
        return user.to_json()
