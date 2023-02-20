import matplotlib.pyplot as plt


data = input().split()

n = list(map(int, data[::2]))
real = list(map(int, data[1::2]))

expected_memory_size = [i * 4 for i in n]
real_memory_size = [i * 4 for i in real]
# delta = [real_memory_size[i] - expected_memory_size[i] for i in range(len(expected_memory_size))]
delta = [i - j for i, j in zip(real_memory_size, expected_memory_size)]

delta_d = [delta[i + 1] - delta[i] for i in range(len(delta) - 1)]

plt.figure()
plt.subplot(121)
plt.plot(n, expected_memory_size, label="expected")
plt.plot(n, real_memory_size, "--", label="real")
plt.xlabel("elements")
plt.ylabel("dites")

# plt.subplot(122)
# plt.plot(n, delta, label="delta")

plt.subplot(122)
plt.plot(n[:-1], delta_d, label="delta")
plt.show()