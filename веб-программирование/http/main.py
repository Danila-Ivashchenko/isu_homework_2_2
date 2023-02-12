out = open("http_responses.txt", "w", encoding="UTF-8")

with open("sourece_responses.txt", "r", encoding="UTF-8") as file:
    for line in file.readlines():
        data = line.split("\t")
        print(data, len(data))
        out.write(data[0] + "\n")
        out.write("\tСинтаксис: " + data[1] + "\n")
        out.write("\tПример: " + data[2] + "\n")
        out.write("\tОписание: " + data[3])

out.close()