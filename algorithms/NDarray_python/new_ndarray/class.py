import array
import operator
from typing import TypeVar, Generic, Sequence, Type
import math

T = TypeVar("T", int, float)
Tshape = TypeVar("Tshape", int, Sequence)
class NDArray:

    def __init__(self, shape: Tshape):
        if isinstance(shape, int):
            shape = (shape, )
        self._shape = shape
        self._len = math.prod(self._shape)
        self._array: list[T] = [0] * self._len

    def __len__(self):
        return self._len

    @property
    def shape(self):
        return self._shape

    @shape.setter
    def shape(self, new_shape):
        assert self._len == math.prod(new_shape)
        self._shape = new_shape

    def __nindex_to_index(self, nindex):
        index: int = 0
        if isinstance(nindex, int):
            nindex = (nindex, )
        for i in range(len(nindex)):
            part_index = nindex[i]
            for j in range(i + 1, len(self._shape) - 1):
                part_index *= self._shape[j]
            index += part_index
        return index

    def __getitem__(self, index: Tshape):
        if isinstance(index, slice):
            pass
        elif len(index) == len(self.shape):
            if isinstance(index[0], int) and isinstance(index[1], int):
                return self._array[self.__nindex_to_index(index)]
            elif isinstance(index[0], int) and isinstance(index[1], slice):
                pass
            elif isinstance(index[0], slice) and isinstance(index[1], int):
                pass
            elif isinstance(index[0], slice) and isinstance(index[1], slice):
                pass
            else:
                raise ValueError("Index is not supported")

    def __setitem__(self, index: Tshape, value):
        linear_index: int = self.__nindex_to_index(index)
        self._array[linear_index] = value

    def __iter__(self):
        if len(self.shape) == 1:
            for value in self._array:
                yield value
        elif len(self.shape) == 2:
            for i in range(self.shape[0]):
                values = []
                for j in range(self.shape[1]):
                    values += [self[i, j]]
                yield values
    def __element_wise_operation(self, operator, other):
        if isinstance(other, (int, float)):
            result: NDArray = NDArray(len(self))
            for i in range(len(result)):
                result[i] = operator(self[i], other)
            result.shape = self.shape
            return result
        elif isinstance(other, NDArray):
            assert self.shape == other.shape
            result: NDArray = NDArray(len(self))
            for i in range(len(result)):
                result[i] = operator(self[i], other[i])
            result.shape = self.shape
            return result
        raise ValueError("Not supported")

    def __add__(self, other):
        return self.__element_wise_operation(operator.add, other)

    def __mul__(self, other):
        return self.__element_wise_operation(operator.mul, other)

    def __sub__(self, other):
        return self.__element_wise_operation(operator.sub, other)

    def __truediv__(self, other):
        return self.__element_wise_operation(operator.truediv, other)

    def __floordiv__(self, other):
        return self.__element_wise_operation(operator.floordiv, other)

    def print(self):
        print(self._array)


arr: NDArray = NDArray((3, 2))
arr += 2
print(arr[:, 1:])