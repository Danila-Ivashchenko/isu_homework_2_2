#include <iostream>
#include <map>
#include <vector>

int main(){
    std::vector<int> vec{1, 2, 3, 1, 2, 1, 5, 3, 2, 4, 5, 1, 2};
    std::map<int, int> counter {};

    for (auto value: vec){
        counter[value] += 1;
    }

    for (std::pair<int, int> count: counter){
        std::cout << count.first << " = " << count.second << std::endl;
    }

    return 1;
}