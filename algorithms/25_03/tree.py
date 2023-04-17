import json


class SuperNode:
    
    node_id = 0

    def __init__(self, name, value1, value2 = ""):
        self.name = name
        self.value1 = value1
        self.value2 = value2
        self._id = self.node_id
        self.children = []
        SuperNode.node_id += 1
    
    def add_child(self, node):
        self.children.append(node)

    def get_children(self):
        return self.children
    
    def get_id(self):
        return self._id
    
    def print_all(self, deep = 0):
        print("\t" * deep, self)
        for child in self.children:
            child.print_all(deep + 1)

    
    def __str__(self):
        return f"Node_{self._id}, Name = {self.name}, Value1 = {self.value1}, Value2 = {self.value2}"
    
    def to_dict(self):
        return {"name": self.name, "value1": self.value1, "value2": self.value2, "nodes": [node.to_dict() for node in self.children]}

    @classmethod
    def from_dict(cls, d):
        root = cls(d["name"], d["value1"], d["value2"])
        for node_d in d["nodes"]:
            root.add_child(cls.from_dict(node_d))
        return root


root = SuperNode("root", 123, "lol")

node1 = SuperNode("A", 222, "kek")
node2 = SuperNode("B", 123, "che")

root.add_child(node1)
root.add_child(node2)

node2.add_child(SuperNode("C", 231313, "dadad"))
root.add_child(SuperNode("D", 131313, "dad"))

root.print_all()

# with open("tree.json", "w") as f:
#     json.dump(root.to_dict(), f)

data = {}

with open('tree.json', "r") as json_file:
    data = json.load(json_file)

new_root = SuperNode.from_dict(data)
new_root.print_all()
