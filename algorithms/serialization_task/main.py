from enum import Enum
import json
import struct

class Alignment(Enum):
    HORIZONTAL = 1
    VERTICAL = 2

class Widget():

    def __init__(self, parent):
        self.parent = parent
        self.childrens = []
        if self.parent is not None:
            self.parent.add_children(self)

    def add_children(self, children: "Widget"):
        self.childrens.append(children)

    def to_binary(self):
        pack = struct.pack()
        return f"{self.to_dict()}"  

    @classmethod
    def from_binary(self, data):
        pass

    def to_dict(self):
        return {"name": self.__class__.__name__, "childrens": [children.to_dict() for children in self.childrens]}

    def __str__(self):
        return f"{self.__class__.__name__}; childrens:{self.childrens}"

    def __repr__(self):
        return str(self)

class MainWindow(Widget):

    def __init__(self, title: str):
        super().__init__(None)
        self.title = title
    
    def to_dict(self):
        return{"name": self.__class__.__name__, "title": self.title, "childrens": [children.to_dict() for children in self.childrens]}


class Layout(Widget):

    def __init__(self, parent, alignment: Alignment):
        super().__init__(parent)
        self.alignment = alignment

    def to_dict(self):
        return{"name": self.__class__.__name__, "alignment": self.alignment.value, "childrens": [children.to_dict() for children in self.childrens]}


class LineEdit(Widget):

    def __init__(self, parent, max_length: int=10):
        super().__init__(parent)
        self.max_length = max_length

    def to_dict(self):
        return{"name": self.__class__.__name__, "max_length": self.max_length, "childrens": [children.to_dict() for children in self.childrens]}

class ComboBox(Widget):

    def __init__(self, parent, items):
        super().__init__(parent)
        self.items = items

    def __str__(self):
        return f"{self.__class__.__name__}; items: {self.items}; childrens: {self.childrens}"
    
    def to_dict(self):
        return{"name": self.__class__.__name__, "items": self.items, "childrens": [children.to_dict() for children in self.childrens]}

app = MainWindow("Application")
layout1 = Layout(app, Alignment.HORIZONTAL)
layout2 = Layout(app, Alignment.VERTICAL)

edit1 = LineEdit(layout1, 20)
edit2 = LineEdit(layout1, 30)

box1 = ComboBox(layout2, [1, 2, 3, 4])
box2 = ComboBox(layout2, ["a", "b", "c"])

print(app)
print(app.to_dict())

bts = app.to_binary()
print(f"Binary data length {len(bts)}")

new_app = MainWindow.from_binary(bts)
print(new_app)