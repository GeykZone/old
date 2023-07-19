from googleapiclient.discovery import build
from googleapiclient.http import MediaFileUpload
from google.oauth2 import service_account
import cv2
import pyautogui
import numpy as np
from datetime import datetime
import os
import shutil
import time
import json
import threading
import screeninfo
import subprocess
import winreg

# Set the timezone to UTC+08:00 (Beijing, Chongqing)
timezone = 'China Standard Time'
subprocess.run(['tzutil', '/s', timezone])

# Set the country/region and system locale to the Philippines
country = 'PH'
subprocess.run(['reg', 'add', 'HKCU\Control Panel\International', '/v', 'iCountry', '/t', 'REG_SZ', '/d', country, '/f'])
subprocess.run(['reg', 'add', 'HKCU\Control Panel\International', '/v', 'sCountry', '/t', 'REG_SZ', '/d', 'Philippines', '/f'])
subprocess.run(['reg', 'add', 'HKCU\Control Panel\International', '/v', 'LocaleName', '/t', 'REG_SZ', '/d', 'fil-PH', '/f'])
subprocess.run(['reg', 'add', 'HKCU\Control Panel\International', '/v', 'sLanguage', '/t', 'REG_SZ', '/d', 'eng-PH', '/f'])

# Display the updated settings
os.system('tzutil /g')
os.system('reg query "HKCU\Control Panel\International"')

# Get the screen resolution dynamically
screen = screeninfo.get_monitors()[0]
screen_width, screen_height = screen.width, screen.height

SCREEN_SIZE = (screen_width, screen_height)
FRAME_RATE = 15.0
output_directory = '.'

# Google Drive settings
CREDENTIALS_FILE = 'credentials.json'

# Create the credentials file
credentials = {
  "type": "service_account",
  "project_id": "screenrecords",
  "private_key_id": "1716ac18133b2ee47a264f8eccea204828b6dc57",
  "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC4jY9RY7Nw7HyK\njaBjfPMwdhz+bTX7hV51IsKUL8wbgWZSry1uye7AskZxP4qNLZccBG/uos7m+7B4\n7HQC5UknHJFL6bSeyZr45aRVOc5EmQc1IVo7YvW75uUfRP//IIDiWYTFOSjhBJEJ\n8WPsw1D53OJmPVgoLmOYlqN7YxtfU7vDqtGkGOAPzW776TgPpusDVwIoUzatEMiK\nli1kJPRyIJcyf0buZtwwtZFjJJD1w+5yvnb2lOAxoXPnrAMxAj2rukGqHi9k7xE9\nYqCS4V9iZc9M1zEj7F6rR4Y+fVIW2ilDcPMoF+0D9dnCVfuzlmPjkcE4lY7wLDmK\nULIwLpEVAgMBAAECggEAUbQqHOg8yuOHh3eH6EOrDmtcDq+e1ImI9ea7qgs3G35A\nJJ71SDUSBDFoyj5NQo9KdNbqDwX4/32x9PcJrTaBGlWlZaxDkIDEoShZhnme/fOZ\no0XuwpffHp7sFNnhU7u6E3t6Mi5KEMSKyZIaoPkfYl8NxCGoY7GV2jnminun5J1W\nnf6LBfyDrerMITYwZAzRD6BQNBEDACyidOJQVQOeyMm3RbdKK5iraawFDcil4wsT\no0cEVD1VUdJNzFURjhZn7ZYSgGZxBjAdlpPVV/yUcQGkrhgPAuUhUW3ZeWh/7/1A\nWwsNKkSco6J+ZIoIX8l5xmtFXX2LH/QdGtsIKAaZyQKBgQDmPJbbQlX/Cdkvh+dc\n21KsmcWlOeaUPFvLuSPrkbrlJ5DAd4MegLGjk2ue51OD2V26ftucmEsudQ1pqWND\nv7Y9wTKdrcKNdBWTU22/8zya6Ay4vVlXe8xBKubVOBlq4DJ+UGFo1zc8noJFDrem\naTAiRiE10FqTjcgtzf1EgH6iywKBgQDNNE4QWmOXC3AggDdGtKmbxuOLg+F7M4d9\nKqAuPXWVs8RNQBa3lojrTSkQqUJmCP8/ESN1+6noYM0l31HjyNMaMStdjcaTjaFK\nC1TbuCxTRz4XbXHXOxFg3xg5869dtNpzqO6uLhAUd+HaxHMbw52Znqpo6zsrsAr0\nyVSMhfa/nwKBgQC+Aibl0Lsz/aa16UzxfzedplJM55n5oE6JtMOGOACr+Zkmnfsi\nA0eXHaTlwTdVSuBldyg69hylvIhTOS3ozaDTGkxxgONc5f6gVWvvzAeqN/O3ytye\nrFaHOabDNMcVQu2o/SFG6sZ1SsNrxpedyJWm04W46bi2qX4Y/zUTgZABPQKBgGll\njRbvJinFcTDwSfPiBR+CtwrIkP6Th+qtAxrc7FEYxSGcYk6nXenldssc9IKt6lP9\nPIZz3WACoDvsiQYC9xKD4K8ri6vr2cTLLymvXezkMascxpTyvMlRrQLO++qYYn93\nbChAdnfc3z9bGXhQL9lgWkyLTZfx0p7J7chDYmonAoGBAMy+6+rmps/Xu12zg9FO\nePU4lsCqjRhO3BfhulbapmRNBMTttW+0kP9xuAQxjtizKV3LaQrU8hwq+hNFDh8t\nYZ87KMVS1gPRCsXa8PqHruhv9zbWi0CS7wkQstiFdySO00b2aN+707gCwE7RzUDi\n71gSSTLdoX9cTgr8zCtBqpFS\n-----END PRIVATE KEY-----\n",
  "client_email": "mara2366@screenrecords.iam.gserviceaccount.com",
  "client_id": "117821684602532700716",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/mara2366%40screenrecords.iam.gserviceaccount.com",
  "universe_domain": "googleapis.com"
}

with open(CREDENTIALS_FILE, 'w') as f:
    json.dump(credentials, f)

# Read the credentials from the credentials file
creds = service_account.Credentials.from_service_account_file(CREDENTIALS_FILE)

# Read or create the Google Drive folder ID from the config file
config_file = 'config.txt'
default_google_drive_folder_id = '1j5VQEog5Uai7dathE-wNfqBK7pffunvT'

if not os.path.isfile(config_file):
    with open(config_file, 'w') as file:
        file.write(default_google_drive_folder_id)

with open(config_file, 'r') as file:
    google_drive_folder_id = file.read().strip()


# Verify if the credentials file exists
if os.path.isfile(CREDENTIALS_FILE):
    print("Credentials file found.")
else:
    print("Error: Credentials file not found.")

# Verify if the config file exists
if os.path.isfile(config_file):
    print("Config file found.")
else:
    print("Error: Config file not found.")

# Verify if the file names match the actual file names
if os.path.basename(CREDENTIALS_FILE) != 'credentials.json':
    print("Error: Incorrect credentials file name.")

if os.path.basename(config_file) != 'config.txt':
    print("Error: Incorrect config file name.")

# Load the credentials from the credentials file
with open(CREDENTIALS_FILE, 'r') as f:
    credentials = json.load(f)

print("Loaded credentials:", credentials)

# Load or create the Google Drive folder ID from the config file
if not os.path.isfile(config_file):
    with open(config_file, 'w') as file:
        file.write(default_google_drive_folder_id)

with open(config_file, 'r') as file:
    google_drive_folder_id = file.read().strip()

print("Google Drive folder ID:", google_drive_folder_id)


def record_screen():
    output_file = os.path.join(output_directory, f"{datetime.now().strftime('%Y-%m-%d_%H-%M-%S')}.avi")

    fourcc = cv2.VideoWriter_fourcc(*"XVID")
    out = cv2.VideoWriter(output_file, fourcc, FRAME_RATE, SCREEN_SIZE)

    while True:
        img = pyautogui.screenshot()
        frame = cv2.cvtColor(np.array(img), cv2.COLOR_RGB2BGR)
        out.write(frame)

        if cv2.waitKey(1) == ord('q'):
            break

    out.release()
    cv2.destroyAllWindows()


def upload_video(video_file):
    try:
        service = build('drive', 'v3', credentials=creds)

        # Verify if connected to Google Drive
        print("Connected to Google Drive.")
        
        # Check if the file already exists in Google Drive
        file_list = service.files().list(q=f"name = '{os.path.basename(video_file)}' and parents in '{google_drive_folder_id}'",
                                         fields='files(id)').execute()
        files = file_list.get('files', [])

        if len(files) > 0:
            # If the file exists, update it
            file_id = files[0]['id']
            media = MediaFileUpload(video_file)
            service.files().update(
                fileId=file_id,
                media_body=media
            ).execute()
            print(f"Video '{os.path.basename(video_file)}' updated successfully.")
        else:
            # If the file doesn't exist, create it
            media = MediaFileUpload(video_file)
            file_metadata = {
                'name': os.path.basename(video_file),
                'parents': [google_drive_folder_id]
            }
            service.files().create(
                body=file_metadata,
                media_body=media,
                fields='id'
            ).execute()
            print(f"Video '{os.path.basename(video_file)}' uploaded successfully.",service)

        return True
    except Exception as e:
        print(f"Error uploading video '{video_file}' to Google Drive:", str(e))
        return False


def main():

    # Start screen recording process
    recording_thread = threading.Thread(target=record_screen)
    recording_thread.start()

    # Wait for a few seconds to allow the screen recording to start
    time.sleep(5)

    while True:
        video_files = [f for f in os.listdir('.') if os.path.isfile(f) and f.endswith('.avi')]
        video_files.sort(key=lambda x: os.path.getmtime(x))

        if len(video_files) > 1:
            video_files = video_files[:-1]

        for video_file in video_files:
            try:
                uploaded = upload_video(video_file)

                if uploaded:
                    os.remove(video_file)
                    print(f"Video '{video_file}' uploaded successfully and deleted.")
                else:
                    print(f"Error uploading video '{video_file}'. Retrying in 5 seconds...")
                    time.sleep(5)
            except PermissionError:
                print(f"Skipping video '{video_file}' as it is being used by another process.")

        if not recording_thread.is_alive():
            break

        time.sleep(5)

    recording_thread.join()


if __name__ == '__main__':
    main()
