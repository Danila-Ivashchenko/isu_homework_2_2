from logical import Enum, Optional, BaseModel


class ActionType(Enum):
    register = "register"
    get_users = "get_users"


class Action(BaseModel):
    action: ActionType
    username: Optional[str]


class Register_action(BaseModel):
    username: str