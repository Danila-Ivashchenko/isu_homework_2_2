#include <iostream>
#include <fstream>
#include <filesystem>
#include <string>
#include <vector>

//g++ -std=c++17 .\main.cpp



void read_from_file(std::vector <int> &arr, std::string filename){
    std::ifstream file(filename);
    int a;
    file >> a;
    while (file){
        arr.push_back(a);
        file >> a;
    }
}

void read_from_dir(std::vector <int> &arr, std::string path){
    for (const auto &entry: std::filesystem::directory_iterator(path)){
        std::cout << entry.path().string() << std::endl;

        if (entry.is_regular_file()){
            read_from_file(arr, entry.path().string());
        } else {
            read_from_dir(arr, entry.path().string());
        }
    }
}

int main(){

    std::string path = "data";
    std::vector <int> arr;

    read_from_dir(arr, path);

    int sum = 0;

    for (auto value : arr){
        std:: cout << value << std::endl;
        sum += value;
    }
    std::cout << "Summ: " << sum;

    return 0;
}