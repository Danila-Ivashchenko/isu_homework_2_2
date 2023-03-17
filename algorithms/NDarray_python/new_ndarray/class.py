from typing import TypeVar, Generic, Sequence, Type
import array
import math


T = TypeVar("T", int, float)

class NDArray(Generic[T]):

    def __init__(self, type_: Type[T], shape: Sequence):
        self._shape = shape
        self._type = type_.__name__[0]
        self._len = math.prod(self._shape)
        self._array = array.array(self._type)


arr: NDArray[int] = NDArray(int, (5, 3))

print(arr._array)