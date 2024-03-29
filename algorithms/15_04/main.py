import random
import networkx as nx
from networkx.drawing.nx_pydot import graphviz_layout
import matplotlib.pyplot as plt

def draw_graph(graph):
    pos = nx.spring_layout(graph)
    plt.figure(figsize=(7, 6))
    nx.draw_networkx_nodes(graph, pos)
    nx.draw_networkx_edges(graph, pos, graph.edges)
    nx.draw_networkx_labels(graph, pos, font_size=20)
    labels = nx.get_edge_attributes(graph, "weight")
    nx.draw_networkx_edge_labels(graph, pos ,edge_labels=labels)
    plt.show()

def graph_weight(graph):
    weight = 0
    for edge in graph.edges:
        weight += graph.get_edge_data(*edge)["weight"]
    return weight

def get_spanning_trees(graph):
    edges, nodes = [], []

    for node in graph.nodes:
        nodes.append(node)
        connected_edges = graph.edges(node)
        min_edge = min(connected_edges, key=lambda e: graph.get_edge_data(*e)["weight"])
        edges.append(min_edge + (graph.get_edge_data(*min_edge)["weight"], ))
    result = nx.Graph()
    result.add_weighted_edges_from(edges)
    result.add_nodes_from(nodes)
    return result

def get_clusters(spanning_tree, n_clusters):
    clusters = []
    for i in range(n_clusters):
        ...
    return clusters

graph= nx.Graph()
nodes = ["A", "B", "C", "D", "E", "F"]
edges = [("A", "B", 7), ("A", "C", 2), 
         ("A", "D", 4), ("B", "C", 3), 
         ("C", "E", 6), ("C", "D", 2), 
         ("B", "D", 5), ("D", "E", 4)]
graph.add_weighted_edges_from(edges)
graph.add_nodes_from(nodes)

new_graph = get_spanning_trees(graph)
draw_graph(new_graph)
