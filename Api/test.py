from datetime import datetime, timedelta
import database

conn = database.connectDb()

cursor = conn.cursor()



query = "SELECT id,open_availability, close_availability FROM doctors"
cursor.execute(query)
rows = cursor.fetchall()

for row in rows:
    id = row[0]
    open_availability = row[1] 
    close_availability = row[2] 

    if close_availability is not None and close_availability <= datetime.now():
        new_open_availability = open_availability + timedelta(hours=24)
        new_close_availability = close_availability + timedelta(hours=24)

        update_query = "UPDATE doctors SET open_availability = %s, close_availability = %s WHERE id = %s"
        update_data = (new_open_availability, new_close_availability, id)
        cursor.execute(update_query, update_data)
        conn.commit()

    print(f"Updated row with ID: {id}")
conn.close()
