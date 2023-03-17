
# class NDArray():
#
#     values: []
#     size: int
#     sub_size: int
#
#     def __init__(self, size: int, sub_size: int = 0, x = 0):
#         if sub_size == 0:
#             self.values = [x for i in range(size)]
#         else:
#             self.values = [[x for j in range(sub_size)] for i in range(size)]
#             self.sub_size = sub_size
#         self.size = size
#
#     def resize(self, new_size: int):
#         ...
#
#     @classmethod
#     def make_and_fill_by(cls, size: int, sub_size: int = 0, x = 0):
#         return cls(size, sub_size, x)
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
#     @property
#     def lens(self):
#         return self.size, self.sub_size
#     def __repr__(self):
#         return f'''{self.values}'''
#
#
#
# ar = NDArray(5, 3, 1)
#
# print(ar.lens, ar)
