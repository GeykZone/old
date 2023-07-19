import os
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
