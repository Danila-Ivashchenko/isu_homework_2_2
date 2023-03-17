CC = g++
CFLAGS = -std=c++11 -Wall -pedantic
SOURCE_1 = main.cpp
SOURCE_2 = operate.cpp

ifeq ($(OS), Windows_NT)
	RM = del
	TARGET_1 = main.exe
	TARGET_2 = operate.exe
else
	RM = rm
	TARGET_1 = main
	TARGET_2 = operate
endif

all:
	$(CC) $(CFLAGS) -o $(TARGET_1) $(SOURCE_1)
	$(CC) $(CFLAGS) -o $(TARGET_2) $(SOURCE_2)

clean:
	echo $(OS)
	$(RM) $(TARGET)

run: all
	$(TARGET_1) 10 file.txt
	$(TARGET_2) file.txt