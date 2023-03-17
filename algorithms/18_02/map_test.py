from collections import defaultdict

vec = [1, 2, 3, 1, 2, 1, 5, 3, 2, 4, 5, 1, 2]


counter = defaultdict(lambda: 0)

for v in vec:
    counter[v] += 1

for key in counter.keys():
    print(key, '=', counter[key])