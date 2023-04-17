import matplotlib.pyplot as plt
import json
import shapely

with open("base.json", "r") as f:
    sites = json.load(f)
    print(sites[0])
    lons = []
    lats = []
    for site in sites:
        lons.append(site["location"]["lon"])
        lats.append(site["location"]["lat"])


plt.scatter(lons, lats)
plt.show()