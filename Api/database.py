import mysql.connector



def connectDb():
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="vincent",
            password="Vincent07$",
            database="LifeHealth",
            )
        print("Database Connected")
        return conn
    except mysql.connector.Error as e:
        print("Mysql Error:{0}".format(e))
        return False


    
