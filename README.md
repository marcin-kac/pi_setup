Objective
  This script will automate the upgrade of a Juniper , DMC-12 and Accton 4610  device to a final software  version and fully configure them without need for access to corporate network.
  Benefits
  Juniper devices are configured automatically with minimum human intervention, DMC-12 and Acctons will be configured with configuration scripts running from dedicated micro server.
  Requirements:
  •	server with httpd/tftpd/dhcpd installed and configured
  •	serial numbers of all devices required for upgrade and configuration
  •	configuration files, firmware and scripts  
  •	access switch for device interconnection 

Server preparation:

1. Download Raspberry Pi Imager https://www.raspberrypi.com/software/
2. Download Raspberry Pi OS Lite https://www.raspberrypi.com/software/operating-systems/#raspberry-pi-os-32-bit
3. Download MSB using the commands below in a terminal:

   Windows
   Download and setup MSB using the commands below in Cmd, Powershell, or Git bash prompt:
   mwinit -o -s
   
   cd C:\Users\marcinxk
   git ssh://git.amazon.com/pkg/Project_PiJ
   cd Project_PiJ/pi_setup
   python -m pip install -r requirements.txt
   
   MacOS/Ubuntu
   
   mwinit -o -s
   kinit -f
   cd ~/
   git clone ssh://git.amazon.com/pkg/Project_PiJ
   cd Project_PiJ/pi_setup
   sudo python3 -m pip install -r requirements.txt


4. Create Raspberry pi image, use advanced option to create user/password , enable ssh and connect to local wifi - best is to create hotspot on your phone (make sure your SSID does not contain special characters )

5. Connect your laptop to the same wi-fi as you set for Pi
6. Once image is created insert SD card to Pi and power it up
7. Verify your IP (ipconfig/ifconfig) and find IP of the PI connected to your phone hot-spot, usually it will be +1 or +2 then your laptop 
8. Setup  MSB using the commands below in a terminal:

   Windows
   Setup MSB using the commands below in Cmd, Powershell, or Git bash prompt:
   
   python pi_setup.py -u {user} -a {IP_ADDRESS} -f pi_file -c pi_env
   
   MacOS/Ubuntu
   
   python3 pi_setup.py -u {user} -a {IP_ADDRESS} -f pi_file -c pi_env

9 . [Juniper prep] Copy the fallowing to /var/www/html/  
 
  •	create network configuration files and  copy them to your local laptop and then to server  (/var/www/html/cfg/)
  
  •	open your web browser to IP the same IP as you use to run pi_setup and upload files one by one 
  


10. [Juniper prep] Create inventory file where you assign all devices serial numbers to device names and upload to server using web browser. 
inventory
	serial,hostname 



Deployment:
	[Juniper deployment]
	1.Connect access switch to all Juniper devices mgmt. port 
	2.Connect server to access switch 
	3.power on devices
	4. connect with console to one of the Juniper devices to monitor the process.
	•	each device will start requesting IP and configuration file from the server approximately 1 minute after the mgmt. interface turn UP.
	•	each device will pull software according to the hardware and current standards 
	•	after the install reboot device will pull the configuration file based on its serial number and inventory file set in preparation stage
	
	at this stage device is fully configured and can be access via console with local user
	The whole process should not take more then 30 minutes from the moment devices are connected to the mobile SwitchBuilder server 
