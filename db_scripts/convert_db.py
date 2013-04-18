################################################################################
#   This file converts the old database format to the new format.
#   Before running this file, you must run the db_scripts/convert.sql file
#   on the database.
################################################################################

import _mysql

class DataPoint:
    def __init__(self, lat, lng, map_id, uid, rang, val, time):
        self.lat = lat
        self.lng = lng
        self.map_id = map_id
        self.uid = uid
        self.rang = rang
        self.val = val
        self.time = time
class ProjMap:
    def __init__(self, project, map_id, privite, name):
        self.project = project
        self.map_id = map_id
        self.private = private
        self.name = name

HOST = 'db1935.perfora.net'
USER = 'dbo291061718'
PASSWORD = 'ZY.MygZm'
DB_NAME = 'db291061718'

db = _mysql.connect(HOST, USER, PASSWORD, DB_NAME)
insert_db = _mysql.connect(HOST, USER, PASSWORD, DB_NAME)

data_list = []
map_list = []

# create DataPoint objects from data
db.query("""select * from data""")
results = db.store_result()
row_tup = results.fetch_row()
while row_tup:
    row = row_tup[0]
    lat = row[0]
    lng = row[1]
    map_id = row[2]
    uid = row[3]
    ran = row[4]
    val = row[5]
    time = row[6]
    data_list.append(DataPoint(lat, lng, map_id, uid, ran, val, time))
    row_tup = results.fetch_row()

# create map objects from projmaps
# also change name of projmaps to maps
db.query("""select * from projmaps""")
results = db.store_result()
row_tup = results.fetch_row()
while row_tup:
    row = row_tup[0]
    project = row[0]
    map_id = row[1]
    private = row[2]
    name = row[3]
    map_list.append(ProjMap(project, map_id, private, name))

    row_tup = results.fetch_row()
    query = """insert into maps values("""
    query += str(map_id) + ", "
    query += "'" + str(name) + "'" + ", "
    query += str(project) + ", "
    query += str(private)
    query += ")"
    insert_db.query(query)

# find which points are associated with which projects and add them to db
point_id = 1
for data_point in data_list:
    for proj_map in map_list:
        if proj_map.map_id == data_point.map_id:
            project = proj_map.project
            query = """insert into point values("""
            query += str(point_id) + ", "
            query += str(project) + ", "
            query += str(data_point.lat) + ", "
            query += str(data_point.lng) + ", "
            query += str(data_point.rang) + ", "
            query += str(data_point.val) + ", "
            #query += str(data_point.time)
            query += str(0)
            query += ")"
            insert_db.query(query)
            point_id += 1
            data_point.point_id = point_id
            break;


#find  which maps are associated with which points and add to mappoints
for proj_map in map_list:
    for data_point in data_list:
        if data_point.map_id == proj_map.map_id:
            query = """insert into mappoints values("""
            query += str(proj_map.map_id) + ", "
            query += str(data_point.point_id)
            query += ")"
            insert_db.query(query)

# remove data table
insert_db.query("drop table data")
# remove projmaps table
insert_db.query("drop table projmaps")
