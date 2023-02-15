from database import Base, Column, Integer, String

class User(Base):
    __tablename__ = "users"

    id = Column('id', Integer, autoincrement=True, primary_key=True)
    username = Column('username', String)
    token = Column('token', String)

    def __init__(self, username: str, token: str):
        self.username = username
        self.token = token

    def __repr__(self):
        info = f"""id = {self.id}, username = {self.username}, token = {self.token}"""
        return info

    def to_json(self):
        return {'id': self.id, 'username': self.username, 'token': self.token}
