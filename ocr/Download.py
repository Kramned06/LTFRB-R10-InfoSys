import os
import subprocess

import cv2
import numpy as np

import DetectChars
import DetectPlates
import PossiblePlate

import mysql.connector
import datetime
from mysql.connector import Error

import base64
import io
import PIL.Image


while True:
        
    try:
        subprocess.check_output('gsutil -m cp -R gs://informationsystem-926ad.appspot.com/ "C:/xampp/htdocs/Projects/land-transportation-franchising-and-regulatory-board/ltfrbr10infosystem/public/storage/"', shell=True) 

    except:
        pass
    print('download complete')

    try:
        subprocess.check_output('gsutil -m rm -r gs://informationsystem-926ad.appspot.com/images/*', shell=True)

        
        showSteps = False

        path, dirs, files = next(os.walk("../public/storage/informationsystem-926ad.appspot.com/images/"))

        for i in files:
            print(i)
            try:
                mysql_connection = mysql.connector.connect(
                    host="localhost",
                    user="root",
                    passwd="",
                    database="ltfrbr10infosystem"
                )
                
                blnKNNTrainingSuccessful = DetectChars.loadKNNDataAndTrainKNN()         

                if blnKNNTrainingSuccessful == False:                               
                    print("\nerror: KNN traning was not successful\n")  
                                                                            
                imgOriginalScene = cv2.imread(path + i)
                
                listOfPossiblePlates = DetectPlates.detectPlatesInScene(imgOriginalScene)        

                listOfPossiblePlates = DetectChars.detectCharsInPlates(listOfPossiblePlates)        

                if len(listOfPossiblePlates) == 0:
                    print("No license plates were detected!\n")
                    print('############################')

                else:           
                            
                    listOfPossiblePlates.sort(key = lambda possiblePlate: len(possiblePlate.strChars), reverse = True)
                            
                    licPlate = listOfPossiblePlates[0]

                    # cv2.imshow("imgPlate", licPlate.imgPlate)        

                    if len(licPlate.strChars) == 0:                 
                        print("No characters were detected! \n")

                    print("Possible license plate: " + licPlate.strChars)
                    print('############################')

                    lp = licPlate.strChars
                    print(lp)
                    query1 = mysql_connection.cursor()
                    query1.execute("SELECT * FROM units WHERE plate_number = '%s'" % (lp))
                    # query1.execute("SELECT * FROM units WHERE plate_number")
                    plate_number = query1.fetchone()
                    
                    if plate_number[5] == lp and plate_number[5] != '':
                        
                        print('******** F O U N D ********')

                        query2 = mysql_connection.cursor()
                        query2.execute("SELECT franchises.id, franchises.expiry_date, units.franchise_id, units.plate_number, units.id FROM units INNER JOIN franchises ON units.franchise_id = franchises.id WHERE units.plate_number = '%s'" % (lp))
                        
                        match = query2.fetchone()

                        if match[2] == match[0] and match[1] != '':

                            print('******** T R Y T R Y ********')
                            
                            expiryDate = match[1]
                            current_date = datetime.datetime.now()

                            if expiryDate.year > current_date.year:
                                print('')

                            elif expiryDate.year < current_date.year:
                                # print('notified')
                                try:

                                    write_name = 'capture'+str(current_date.year)+str(current_date.month)+str(current_date.day)+str(current_date.hour)+str(current_date.minute)+str(current_date.second)+'.jpg'
                                    
                                    cv2.imwrite('../public/storage/PlatePicture/' + write_name, licPlate.imgPlate)

                                    mysql_connection = mysql.connector.connect(
                                        host="localhost",
                                        user="root",
                                        passwd="",
                                        database="ltfrbr10infosystem"
                                    )

                                    # cursor = mysql_connection.cursor(prepared=True)
                                    # sql_select_query = """SELECT * FROM notifications WHERE unit_id = %s"""
                                    # cursor.execute(sql_select_query, (match[4], ))
                                    # record = cursor.fetchall()

                                    # count = 0
                                    # for row in record:
                                    #     print(str(row[5].year)+'-'+str(row[5].month)+'-'+str(row[5].day))
                                    #     count = count + 1
                                    
                                    # print(count)
                                    # print(str(current_date.year)+'-'+str(current_date.month)+'-'+str(current_date.day))

                                    query3 = mysql_connection.cursor()
                                    insert_notif = ("INSERT INTO notifications (franchise_id, unit_id, plate_picture, created_at) VALUES (%s,%s,%s,%s)")
                                    notif_data = (match[0], match[4], write_name, current_date)
                                    query3.execute(insert_notif, notif_data)
                                    mysql_connection.commit()
                                    
                                except:
                                    pass
                                    
                                finally:
                                    mysql_connection.close()

                                
                            elif expiryDate.year == current_date.year:

                                if expiryDate.month > current_date.month:
                                    print('')

                                elif expiryDate.month < current_date.month:
                                    print('notified')
                                    
                                elif expiryDate.month == current_date.month:

                                    if expiryDate.day > current_date.day:
                                        print('')

                                    elif expiryDate.day < current_date.day:
                                        print('notified')

                                    elif expiryDate.day == current_date.day:
                                        print('notified')

                                    else:
                                        print('')
                                else:
                                    print('')
                            else:
                                print('')

                        else:
                            break
                            
            except:
                pass

            finally:
                mysql_connection.close()       
            
            os.remove(path+i)


        
    except:
        pass
    print('delete complete')

