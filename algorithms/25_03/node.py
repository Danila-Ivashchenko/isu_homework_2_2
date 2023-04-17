import json
import networkx as nx
from networkx.drawing.nx_pydot import graphviz_layout
import matplotlib.pyplot as plt


class Node():
    node_id = 0

    def __init__(self):
        self._id = Node.node_id
        self.left = None
        self.right = None
        Node.node_id += 1

    def get_id(self):
        return self._id

    def __str__(self):
        return f"Node_{self._id}"

def count_nodes(node):
    if node is None:
        return 0
    return 1 + count_nodes(node.left) + count_nodes(node.right)

def is_full(node):
    if node.left is not None and node.right is not None:
        return is_full(node.left) and is_full(node.right)
    return node.left is None and node.right is None

def is_complete(node, index = 0, nnodes = 0):
    if node is None:
        return True
    if index >= nnodes:
        return False
    return is_complete(node.left, 2 * index + 1, nnodes) and is_complete(node.right, 2 * index + 2, nnodes)


def preored(node):
    if node is not None:
        print(node, end=" ")
        preored(node.left)
        preored(node.right)

def inored(node):
    if node is not None:
        inored(node.left)
        print(node, end=" ")
        inored(node.right)

def postored(node):
    if node is not None:
        postored(node.left)
        postored(node.right)
        print(node, end=" ")
        
def level(node):
    q = []
    print(node, end=" ")
    q.append(node)
    while q:
        p = q.pop(0)
        if p.left:
            print(p.left, end=" ")
            q.append(p.left)
        if p.right:
            print(p.right, end=" ")
            q.append(p.right)

def height(node):
    l, r = 0, 0
    if node is None:
        return 0
    l = height(node.left)
    r = height(node.right)
    if l > r:
        return l + 1
    return r + 1

def iter_preorder(node):
    stack = []
    stack.append(node)
    while node is not None or len(stack) != 0:
        if node:
            print(node, end=" ")
            stack.append(node)
            node = node.left
        else:
            node = stack.pop()
            node = node.right
    print()

def iter_inorder(node):
    stack = []
    stack.append(node)
    while node is not None or len(stack) != 0:
        if node:
            stack.append(node)
            node = node.left
        else:
            node = stack.pop()
            print(node, end=" ")
            node = node.right
    print()

def peek(stack):
    if stack:
        return stack[-1]
    return 0

def iter_postorder(node):
    stack = []
    while True:
        while node:
            if node.right is not None:
                stack.append(node.right)
            stack.append(node)
            node = node.left
        node = stack.pop()
        if node.right is not None and peek(stack) == node.right:
            stack.pop()
            stack.append(node)
            node = node.right
        else:
            print(node, end=" ")
            node = None
        if len(stack) == 0:
            break

def leaf_count(node):
    if node is not None:
        l = leaf_count(node.left)
        r = leaf_count(node.right)
        if node.left is None and node.right is None:
            return l + r + 1
        else:
            return l + r
    return 0

def tree_to_nx(node):
    nodes = []
    edges = [] # [(A, B), (A, C), ...]
    stack = []
    while node is not None or len(stack) != 0:
        if node:
            nodes.append(node.get_id())
            stack.append(node)
            if node.left is not None:
                edges.append((node.get_id(), node.left.get_id()))
            node = node.left
            
        else:
            node = stack.pop()
            if node.right is not None:
                edges.append((node.get_id(), node.right.get_id()))
            node = node.right
    
    return nodes, edges

class MiniTree:
    
    def __init__(self, nodes, edges) -> None:
        self.nodes = nodes
        self.edges = edges
        pass


    def to_json(self, filename="tree.json"):
        tree_dict = {"nodes": self.nodes, "edges": self.edges}
        file = open(filename, "w")
        json.dump(tree_dict, file)
        file.close()

root = Node()
root.left = Node()
root.right = Node()
root.left.left = Node()
root.left.right = Node()
root.right.left = Node()
root.right.right = Node()

#print(count_nodes(root))
#print(is_full(root))
#print(is_complete(root, 0, count_nodes(root)))

# preored(root)
# print()
# inored(root)
# print()
# postored(root)
# print()
# level(root)
# print()
# print(height(root))
# iter_preorder(root)
# iter_inorder(root)
# iter_postorder(root)
# print()
# print(leaf_count(root))
# print(tree_to_nx(root))
# print

def tree_to_json(nodes, edges, filename="tree.json"):
        tree_dict = {"nodes": nodes, "edges": edges}
        file = open(filename, "w")
        json.dump(tree_dict, file)
        file.close()

nodes, edges = tree_to_nx(root)
tree_to_json(nodes, edges, "data.json")

tree = nx.Graph()
tree.add_nodes_from(nodes)
tree.add_edges_from(edges)

pos = graphviz_layout(tree, prog="dot")
nx.draw(tree, pos, with_labels=True, font_size=22)
plt.show()
