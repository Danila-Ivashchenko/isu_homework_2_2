import random
import networkx as nx
from networkx.drawing.nx_pydot import graphviz_layout
import matplotlib.pyplot as plt

node_id = 0


def get_binary_tree(n):
    nodes = []
    edges = []
    level = 0
    global node_id
    nodes.append(node_id)
    _gen_tree(nodes, edges, node_id, level, n)
    return nodes, edges

def _gen_tree(nodes, edges, parent_id, level, n):
    level += 1
    if level >= n:
        return

    global node_id

    if random.random() > 0.25:
        node_id += 1
        edges.append((parent_id, node_id))
        nodes.append(node_id)
        _gen_tree(nodes, edges, node_id, level, n)
    if random.random() > 0.25:
        node_id += 1
        edges.append((parent_id, node_id))
        nodes.append(node_id)
        _gen_tree(nodes, edges, node_id, level, n)

def is_full(node):
    if node.left and node.right is None:
        return

nodes, edges = get_binary_tree(5)

tree = nx.Graph()
tree.add_nodes_from(nodes)
tree.add_edges_from(edges)

tree = nx.Graph()
tree.add_nodes_from(nodes)
tree.add_edges_from(edges)

pos = graphviz_layout(tree, prog="dot")
nx.draw(tree, pos, with_labels=True, font_size=22)
plt.show()



