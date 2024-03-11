from datetime import datetime, timedelta
import mysql.connector

try:
    conn = mysql.connector.connect(
        host="mysql2.serv00.com",
        user="m5708_Vincent",
        password="User007",
        database="m5708_VincentNdegwa",
    )

    if conn.is_connected():
        print("Connected to the database")

        cursor = conn.cursor()

        query = "SELECT id, open_availability, close_availability FROM doctors"
        cursor.execute(query)
        rows = cursor.fetchall()

        for row in rows:
            id, open_availability, close_availability = row

            if close_availability is not None and close_availability < datetime.now():
                new_open_availability = open_availability + timedelta(hours=24)
                new_close_availability = close_availability + timedelta(hours=24)

                update_query = "UPDATE doctors SET open_availability = %s, close_availability = %s WHERE id = %s"
                update_data = (new_open_availability, new_close_availability, id)
                cursor.execute(update_query, update_data)
                print(f"Updated row with ID: {id}")

        conn.commit()
        conn.close()
        print("SQL command executed successfully")

    else:
        print("Failed to connect to the database")

except mysql.connector.Error as e:
    print(f"Error: {e}")
