#include <fstream>
#include <iostream>
#include <math.h>
#include <vector>

int main(int argc, char** argv){
    std::ifstream inp_file(argv[1]);
    std::vector<double> values;

    double value_1, value_2, value_3;
    inp_file >> value_1 >> value_2 >> value_3;
    double angular;
    while(!inp_file.fail()){
        angular = 0;
        angular = 2 * sin(value_1) * sin(value_2) + cos(value_3);
        std::cout << angular << std::endl;
        inp_file >> value_1 >> value_2 >> value_3;
    }

    return 0;
}