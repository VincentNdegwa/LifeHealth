import database
import requests
import sys
import json

from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/schedule', methods=['POST'])


def schedule():
    try:
        time = request.json.get("time")
        results = None
        conn = database.connectDb()

        if conn:
            cursor = conn.cursor()
            query = "SELECT id, first_name, last_name, speciality, open_availability, close_availability FROM doctors WHERE %s >= open_availability AND %s < close_availability"
            cursor.execute(query, (time, time))
            results = cursor.fetchall()

            data_to_send = [{'id': row[0], 'first_name': row[1], 'last_name': row[2],
                             'speciality': row[3], 'open_availability': str(row[4]),
                             'close_availability': str(row[5])} for row in results]
            results = {
            "status": "success",
            "data": data_to_send
            }
        else:
            print("Failed to connect to the Database")
            
    except Exception as e:
        print(f"An error occurred: {e}")
   

    return jsonify(results)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)


