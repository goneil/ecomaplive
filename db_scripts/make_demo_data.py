import _mysql

HOST = 'localhost'
USER = 'root'
PASSWORD = '141991g'
DB_NAME = 'tmpdb'

db = _mysql.connect(HOST, USER, PASSWORD, DB_NAME)
out_file = open("./tmp.dat", 'w')

db.query("""select * from point where project=36""")
results = db.store_result()
row_tup = results.fetch_row()

time = 1366938060000
while row_tup:
    row = row_tup[0]
    id = row[0]
    project = row[1]
    lng = row[2]
    lat = row[3]
    ran = row[4]
    val = row[5]
    row_tup = results.fetch_row()
    line = lng + " " + lat + " " + ran + " " + val + " " + str(time) + "\n";
    out_file.write(line)
    time += 60000
