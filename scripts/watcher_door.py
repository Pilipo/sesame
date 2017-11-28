import RPi.GPIO as GPIO
import time

#
# Watcher scripts need: 
# - an API URL for raising alerts
# - RPI GPIO pin designation (I'm using 17 for testing)

pin = 17
door_closed = True

GPIO.setmode(GPIO.BCM)

GPIO.setup(pin, GPIO.IN, pull_up_down=GPIO.PUD_UP)

while True:
    input_state = GPIO.input(pin)
    if input_state == False and door_closed == True:
        # In production, this should log to a file.
        print("Door was opened!")
        door_closed = False
        time.sleep(0.2)
    elif input_state == True and door_closed == False:
        # In production, this should log to a file.
        print("Door was closed.")
        door_closed = True
        time.sleep(0.2)
