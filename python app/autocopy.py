import os
import shutil
import winshell
import win32api
import win32con

def copy_folder_contents(source_folder, destination_folder):
    # Check if the destination folder exists, and create it if it doesn't
    if not os.path.exists(destination_folder):
        os.makedirs(destination_folder)

    # Copy the files from the source folder to the destination folder
    for file_name in os.listdir(source_folder):
        source_file = os.path.join(source_folder, file_name)
        destination_file = os.path.join(destination_folder, file_name)
        shutil.copy2(source_file, destination_file)

def create_shortcuts(destination_folder, shorts_folder):
    # Check if the shorts folder exists, and create it if it doesn't
    if not os.path.exists(shorts_folder):
        os.makedirs(shorts_folder)

    # Create shortcuts for each file in the destination folder
    for file_name in os.listdir(destination_folder):
        file_path = os.path.join(destination_folder, file_name)
        if os.path.isfile(file_path):
            shortcut_name = f"{file_name}-Shortcut"
            shortcut_file = os.path.join(shorts_folder, shortcut_name + ".lnk")
            with winshell.shortcut(shortcut_file) as shortcut:
                shortcut.path = file_path
                shortcut.working_directory = destination_folder


    # Print a message indicating the operation is completed
    print("Shortcuts created in the shorts folder.")


# Check if src_dst_con.txt exists, and create it with default values if it doesn't
config_file = "src_dst_con.txt"
if not os.path.exists(config_file):
    source_folder = "G:\\DriveDefender"
    destination_folder = "D:\\Defender"
    with open(config_file, "w") as file:
        file.write("# Source folder\n")
        file.write(f"source_folder = {source_folder}\n\n")
        file.write("# Destination folder\n")
        file.write(f"destination_folder = {destination_folder}\n")
else:
    # Read source_folder and destination_folder from src_dst_con.txt file
    with open(config_file, "r") as file:
        lines = file.readlines()
        source_folder = "G:\\DriveDefender"
        destination_folder = "D:\\Defender"
        for line in lines:
            if line.startswith("source_folder"):
                source_folder = line.strip().split(" = ")[1]
            elif line.startswith("destination_folder"):
                destination_folder = line.strip().split(" = ")[1]

copy_folder_contents(source_folder, destination_folder)

# Hide the destination folder
win32api.SetFileAttributes(destination_folder, win32con.FILE_ATTRIBUTE_HIDDEN)

shorts_folder = os.path.join(destination_folder, "shorts")
create_shortcuts(destination_folder, shorts_folder)

startup_folder = winshell.shell.SHGetFolderPath(0, winshell.shellcon.CSIDL_STARTUP, None, 0)

# Remove existing shortcuts in the startup folder
for shortcut_name in os.listdir(startup_folder):
    shortcut_file = os.path.join(startup_folder, shortcut_name)
    if os.path.isfile(shortcut_file) and shortcut_name.endswith("-Shortcut.lnk"):
        os.remove(shortcut_file)

# Copy the shortcuts from the shorts folder to the shell:startup folder
for shortcut_name in os.listdir(shorts_folder):
    shortcut_file = os.path.join(shorts_folder, shortcut_name)
    destination_file = os.path.join(startup_folder, shortcut_name)
    shutil.copy2(shortcut_file, destination_file)

# Print a message indicating the operation is completed
print("Shortcuts copied to the startup folder.")
