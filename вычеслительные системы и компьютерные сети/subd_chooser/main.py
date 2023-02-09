def clean_str(line):
    if line[-1] == '\n':
        return line[:-1]
    else:
        return line

class Question_node:
    pass


# класс вершины в графу
class Question_node:
    id: int
    value: str
    yes_option: int
    no_option: int
    is_end: bool

    def __init__(self, value, id, is_end=False):
        self.value = value
        self.id = id
        self.is_end = is_end

    def set_yes_option(self, id):
        self.yes_option = id

    def set_no_option(self, id):
        self.no_option = id

    def print_info(self):
        print(self.value, self.id)
        if not(self.is_end):
            print(self.yes_option, self.no_option)
        else:
            print('Is end')

    def get_options(self, option_value):
        if option_value == 'y':
            return self.yes_option
        elif option_value == 'n':
            return self.no_option
        else:
            return -1

    def __str__(self):
        return self.value

class Question_graph:
    nodes = []
    current_node: Question_node

    def set_current_node(self, node_id):
        self.current_node = self.nodes[node_id]

    def get_current_node(self):
        return self.current_node

    def add_node(self, node: Question_node):
        self.nodes.append(node)

    def fill_from_file(self, filename):
        with open('questions.txt', 'r', encoding='UTF-8') as file:
            for line in file.readlines():
                data = line.split("-")
                node = Question_node(clean_str(data[1]), int(data[0]))
                if len(data) == 4:
                    node.set_yes_option(int(data[2]))
                    node.set_no_option(int(data[3]))
                    node.is_end = False
                else:
                    node.is_end = True
                self.add_node(node)
        self.set_current_node(0)


graph = Question_graph()
graph.fill_from_file("questions.txt")
node = graph.get_current_node()

while not(node.is_end):
    print(node)
    print("y - да")
    print("n - нет")
    option = node.get_options(input())

    if option == -1:
        continue
    else:
        graph.set_current_node(option)
        node = graph.get_current_node()

print()
print("Под ваши запросы подходит: " + str(node))


