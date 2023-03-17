#
#
# class NDArray():
#
#     values: []
#     size: int
#
#     def __init__(self, size: int, x = 0):
#         self.values = [x for i in range(size)]
#         self.size = size
#
#     def resize(self, new_size: int):
#         ...
#
#     def make_and_fill_by(self, size: int = 10, x = 0):
#         self.resize(size)
#         self.fill_by(x)
#
#     def fill_by(self, x):
#         ...
#
#     def fill_rand(self):
#         ...
#
#     def matrix_add(self, x):
#         ...
#
#     def matrix_sub(self, x):
#         ...
#
#     def matrix_mul(self, x):
#         ...
#
#     def matrix_div(self, x):
#         ...
#
#     def matrix_transponir(self):
#         ...
#
#     def matrix_mul(self):
#         ...
#
#     def max(self):
#         ...
#
#     def min(self):
#         ...
#
#     def average(self):
#         ...
#
#     def __len__(self):
#         return self.size
#
#     def __repr__(self):
#         return f'''{self.values}'''
#
#
#
# ar = NDArray(10, 2)
#
# print(ar)