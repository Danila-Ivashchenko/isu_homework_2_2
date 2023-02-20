#include <fstream>
#include <iostream>
#include <cmath>
#include <time.h>
#include <stdlib.h>


int main(int argc, char* argv[]){
    srand((unsigned)time(0));

    double PI = acos(-1.0);

    std::ofstream out_file(argv[2]);
    int n = std::stoi(argv[1]);

    for (int i = 0; i < n; i++){
        for (int i = 0; i < 3; i++)
            out_file << (rand() % 360 - 180) * PI / 180. << " "; 
        out_file << std::endl;
    }
    out_file.close();
    return 0;
}