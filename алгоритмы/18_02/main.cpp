#include <iostream>
#include <cmath>
#include <vector>

int main()
{
    std::vector<float> vec;
    int n {};
    for (int i{}; i < 9; i++)
    {
        vec.clear();
        n = std::ceil(std::pow(10, i));
        for (int j{}; j < n; j++) {
            vec.push_back(j);
        }
        std::cout << n << " " <<  sizeof(float) * vec.capacity() << " ";
    }
    std::cout << std::endl;
}
